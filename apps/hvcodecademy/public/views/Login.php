<?php

    // First execute common code to connection to the database and start the session
    require("common.php");

	//Privates the page
    //require("private.php");

    // This variable is used to re-display the username in the login form if they fail to enter the correct password.
    $submitted_username = '';

    // This if statement determines whether the login form has been submitted otherwise the form is displayed
    if(!empty($_POST))
    {
        // This query retreives the user's information from the database using the provided username.


        $query = "
            SELECT
                UserID,
                UserName,
                AccountType
            FROM Users
            WHERE
                UserName = :UserName
        ";

         $query2 = "
            SELECT
                UserID,
                Password,
                salt
            FROM Passwords
            WHERE
                UserID = :UserID
        ";
        // The parameter values
        $query_params = array(
            ':UserName' => $_POST['username']
        );

        try
        {
            // Execute the query against the database
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            //display if failed to run
            die("Failed to run query: " . $ex->getMessage());
        }

        $getUserId = $stmt->fetch();
        if ($getUserId) {
            // verify that UserName is valid
            $query2_params = array(
                ':UserID' => $getUserId['UserID']
            );

            try
            {
                // Execute the query against the database
                $stmt2 = $db->prepare($query2);
                $result2 = $stmt2->execute($query2_params);
            }
            catch(PDOException $ex)
            {
                //display if failed to run
                die("Failed to run query2: " . $ex->getMessage());
            }


            // This variable tells us whether the user has successfully logged in or not.
            // We initialize it to false assuming they have not already logged in.
            // If we determine that they have entered the right details then we switch it to true.
            $login_ok = false;

            // Retrieve the user data from the database. If $row is false then the username they entered is not registered.
            $getPassword = $stmt2->fetch();
            if($getPassword)
            {
                // Using the password submitted by the user and the salt stored in the database,   // we now check to see whether the passwords     match by hashing the submitted password
                // and comparing it to the hashed version already stored in the database.
                $check_password = hash('sha256', $_POST['password'] . $getPassword['salt']);
                for($round = 0; $round < 65536; $round++)
                {
                    $check_password = hash('sha256', $check_password . $getPassword['salt']);
                }

                if($check_password == $getPassword['Password'])
                {
                    // If they do, then we flip this to true
                    $login_ok = true;
                }
            }
        }
        // Iflogin is successful then we send them to the private index/home page
        // Otherwise, we display a login failed message and show the login form again
        if($login_ok)
        {
            // Here I am preparing to store the $row array into the $_SESSION by
            // removing the salt and password values from it.  Although $_SESSION is
            // stored on the server-side, there is no reason to store sensitive values
            // in it unless you have to.  Thus, it is best practice to remove these
            // sensitive values first.
            // unset($getPassword['salt']);
            // unset($getPassword['password']);

            // This stores the user's data into the session at the index 'user'.
            // We will check this index on the private members-only page to determine whether
            // or not the user is logged in.  We can also use it to retrieve
            // the user's details.
            $_SESSION['user'] = $getUserId;

            // Redirect the user to the private members-only page.
            header("Location: /views/index.php");
            die("Redirecting to: index.php");
        }
        else
        {
            // Tell the user they failed
            print("Login Failed.");

            // Show them their username again so all they have to do is enter a new
            // password.  The use of htmlentities prevents XSS attacks.  You should
            // always use htmlentities on user submitted values before displaying them
            // to any users (including the user that submitted them).  For more information:
            // http://en.wikipedia.org/wiki/XSS_attack
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
        }
    }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Login</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <img src="\views\assets\img\Header.jpg" alt="LOGO" style="width:100%;height:10%"/>

    <div class="content-wrapper">
        <div class="container">

          <div class="main">
                <form action="Login.php" method="POST">


    <!-- Center everything within the from -->
    <center>

    <h1>Login</h1>

    <fieldset>

    <!-- Username Input -->
    <p><label for="username">Username:</label>
    <br>
    <input type="text" name="username" value="<?php echo $submitted_username; ?>" /> </p>

    <!-- Password Input -->
    <p><label for="password">Password:</label>
    <br>
    <input type="password" name="password" id="passwordInput" value=""></p>

    <!-- Select if used for more then one school -->
    <!-- note we made fake school names -->
    <!--
    <select name="School">
    <option value="Hardin Valley">Hardin Valley</option>
    <option value="SchoolA">SchoolA</option>
    <option value="SchoolB">SchoolB</option>
    <option value="SchoolC">SchoolC</option>
    </select>
    <br> <rt> Select School </rt> <br>
    -->
    <!-- Button used for Submitting to server side code -->
    <input type="submit" value="Login">

    <!-- Hyperlink to Signup page -->
    <rt><p>Click <a href="Register.php">Here</a> to Register</p></rt>

    <!-- end field -->
    </fieldset>

    </center>

    </form>
          </div>
            <div class="panel-body">

            </div>
            <?php require "social.php" ?>


    <!-- CONTENT-WRAPPER SECTION END-->
    <?php require "bottomBar.php" ?>

    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
