<?php

    // First execute common code to connection to the database and start the session
    require("common.php");

    // This if statement checks to determine whether the registration form has been submitted
    // If it has, then the registration code is run, otherwise the form is displayed
    if(!empty($_POST))
    {
        // Ensure that the user has entered a non-empty username
        if(empty($_POST['username']))
        {
            // Note that die() is generally a terrible way of handling user errors
            // like this.  It is much better to display the error with the form
            // and allow the user to correct their mistake.  However, that is an
            // exercise for you to implement yourself.
            die("Please enter a username.");
        }

        // Ensure that the user has entered a non-empty password
        if(empty($_POST['password']))
        {
            die("Please enter a password.");
        }

        // Make sure the user entered a valid E-Mail address
        // filter_var is a useful PHP function for validating form input, see:
        // http://us.php.net/manual/en/function.filter-var.php
        // http://us.php.net/manual/en/filter.filters.php
         if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
         {
             die("Invalid E-Mail Address");
         }

        // We will use this SQL query to see whether the username entered by the
        // user is already in use.  A SELECT query is used to retrieve data from the database.
        // :username is a special token, we will substitute a real value in its place when
        // we execute the query.
        $query = "
            SELECT
                1
            FROM Users
            WHERE
                UserName = :UserName
        ";

        // This contains the definitions for any special tokens that we place in
        // our SQL query.  In this case, we are defining a value for the token
        // :username.  It is possible to insert $_POST['username'] directly into
        // your $query string; however doing so is very insecure and opens your
        // code up to SQL injection exploits.  Using tokens prevents this.
        // For more information on SQL injections, see Wikipedia:
        // http://en.wikipedia.org/wiki/SQL_Injection
        $query_params = array(
            ':UserName' => $_POST['username']
        );

        try
        {
            // These two statements run the query against your database table.
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            die("Failed to run query1: " . $ex->getMessage());
        }

        // The fetch() method returns an array representing the "next" row from
        // the selected results, or false if there are no more rows to fetch.
        $getUserGet = $stmt->fetch();


        // If a row was returned, then we know a matching username was found in
        // the database already and we should not allow the user to continue.
        if($getUserGet)
        {
            die("This username is already in use");
        }

        $userIDUnique = false;
        while(!$userIDUnique)
        {
            $query2 = "
                SELECT
                    1
                FROM Users
                WHERE
                    UserID = :UserID
                ";

            $UserID = mt_rand();
            $query2_params = array(
                ':UserID' =>  $UserID
            );

            try
            {
                // These two statements run the query against your database table.
                $stmt2 = $db->prepare($query2);
                $result2 = $stmt2->execute($query2_params);
            }
            catch(PDOException $ex)
            {
                // TODO: On a production website, you should not output $ex->getMessage().
                // It may provide an attacker with helpful information about your code.
                die("Failed to run query2: " . $ex->getMessage());
            }
            if (!$stmt2->rowCount()) { // this returns 1 if the userID is found and already exists. If nothing is found, we should proceed
                // we didn't find any conflicts: go ahead and proceed
                $userIDUnique = true;
            }
        }

        // The fetch() method returns an array representing the "next" row from
        // the selected results, or false if there are no more rows to fetch.


        // Now we perform the same type of check for the email address, in order
        // to ensure that it is unique.
        /*
        $query = "
            SELECT
                1
            FROM Users
            WHERE
                email = :email
        ";

        $query_params = array(
            ':email' => $_POST['email']
        );

        try
        {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }

        catch(PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }

        $row = $stmt->fetch();

        if($row)
        {
            die("This email address is already registered");
        }
        */
        // An INSERT query is used to add new rows to a database table.
        // Again, we are using special tokens (technically called parameters) to
        // protect against SQL injection attacks.
        $query3 = "
            INSERT INTO Users (
                UserName,
                UserID,
                AccountType,
                Email,
                Activated,
                URLsalt
            ) VALUES (
                :UserName,
                :UserID,
                :AccountType,
                :email,
                :activated,
                :URLsalt
            ) ";

         $query4 = "
            INSERT INTO Passwords (
                UserID,
                Password,
                salt
            ) VALUES (
                :UserID,
                :Password,
                :salt
            )
        ";

        // A salt is randomly generated here to protect again brute force attacks
        // and rainbow table attacks.  The following statement generates a hex
        // representation of an 8 byte salt.  Representing this in hex provides
        // no additional security, but makes it easier for humans to read.
        // For more information:
        // http://en.wikipedia.org/wiki/Salt_%28cryptography%29
        // http://en.wikipedia.org/wiki/Brute-force_attack
        // http://en.wikipedia.org/wiki/Rainbow_table
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        $URLsalt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        // This hashes the password with the salt so that it can be stored securely
        // in your database.  The output of this next statement is a 64 byte hex
        // string representing the 32 byte sha256 hash of the password.  The original
        // password cannot be recovered from the hash.  For more information:
        // http://en.wikipedia.org/wiki/Cryptographic_hash_function
        $password = hash('sha256', $_POST['password'] . $salt);

        // Next we hash the hash value 65536 more times.  The purpose of this is to
        // protect against brute force attacks.  Now an attacker must compute the hash 65537
        // times for each guess they make against a password, whereas if the password
        // were hashed only once the attacker would have been able to make 65537 different
        // guesses in the same amount of time instead of only one.
        for($round = 0; $round < 65536; $round++)
        {
            $password = hash('sha256', $password . $salt);
        }
        $AccountType = 2; //AccountType 1 is Admin

        // Here we prepare our tokens for insertion into the SQL query.  We do not
        // store the original password; only the hashed version of it.  We do store
        // the salt (in its plaintext form; this is not a security risk).
        $query3_params = array(
            ':UserName' => $_POST['username'],
            ':UserID' => $UserID,
            ':AccountType' => $AccountType,
            ':email' => $_POST['email'],
            ':activated' => 0,
            ':URLsalt' => $URLsalt
        );

        $query4_params = array(
            ':UserID' => $UserID,
            ':Password' => $password,
            ':salt' => $salt
        );

        try
        {
            // Execute the query to create the user
            $stmt3 = $db->prepare($query3);
            $result3 = $stmt3->execute($query3_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
           die("Failed to run query3: " . $ex->getMessage());
        }
        $userCreated = false;
        try
        {
            // Execute the query to create the user
            $stmt4 = $db->prepare($query4);
            $result4 = $stmt4->execute($query4_params);
            $userCreated = true;
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            die("Failed to run query4: " . $ex->getMessage());
            $userCreated = false;
        }
        if($userCreated)
        {
                $email = $_POST['email'];
        		$message = 'Thanks for signing up!
                Your account has been created, you can login with the following credentials.
 
                ------------------------
                Username: '.$_POST['username'].'
                Password: '.$_POST['password'].'
                ------------------------
 
                Your account will be activated within 24 hours.';
                //http:www.hvcodecademy.projects.codetn.org/SuperRedButton/CodeRed/verify.php?email='.$email.'&hash='.$hash.'' Our message above including the link
                
                $message2 = 'A New account has been created, the following credentials were used. You have activated the account by pressing the url below.
 
                ------------------------
                Email:    '.$_POST['email'].'
                Username: '.$_POST['username'].'
                ------------------------
 
                http://hvcodecademy.projects.codetn.org/views/verify.php?hash='.$URLsalt.''; // Our message above including the link
                
                $headers = "From:noreply@hvcodecademy.projects.codetn.org" . "\r\n"; // Set from headers
				//include "dbConfig.php";   
                $subject = "Welcome to hvcodecademy!";
	            mail("HardinValleyACODEmy@gmail.com","New Account",$message2, $header);
	           if(@mail($email, $subject, $message, $headers))
	           {
                   header("Location: Login.php");
                   die("Account Creation Successful
                   Redirecting to Login.php");
  	               
	           }
               else
               {
                   header("Location: Login.php");
                   die("Account Creation Not Successful
                   Redirecting to Login.php");
               }
        }

        // This redirects the user back to the login page after they register
//        header("Location: Login.php");

        // Calling die or exit after performing a redirect using the header function
        // is critical.  The rest of your PHP script will continue to execute and
        // will be sent to the user if you do not die or exit.
        //die("Redirecting to Login.php");
    }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Register</title>
    <?php require 'Link.php'; ?>
</head>
<body>

    <img src="\views\assets\img\Header.jpg" alt="LOGO" style="width:100%;height:10%"/>

    <div class="content-wrapper">
        <div class="container">

            <div class="main">
                <center>

                    <h1>Register</h1>
                    <form action="Register.php" method="post">
                        Username:<br />
                        <input type="text" name="username" value="" />
                        <br /><br />
                        E-Mail:<br />
                        <input type="text" name="email" value="" />
                        <br /><br />
                        Password:<br />
                        <input type="password" name="password" value="" />
                        <br /><br />
                        <input type="submit" value="Register" />

                    </form>
                </center>
            </div>
            <div class="panel-body">

            </div>

            <!-- CONTENT-WRAPPER SECTION END-->
             </div>
            <?php require "social.php" ?>

            <!-- CONTENT-WRAPPER SECTION END-->
       </div>
    	<?php require "bottomBar.php" ?>


		<?php require "LinkScript.php" ?>

</body>
</html>
