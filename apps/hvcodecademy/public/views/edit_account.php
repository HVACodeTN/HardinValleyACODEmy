<?php

	//privates the page
    require("private.php");

    // At the top of the page we check to see whether the user is logged in or not
    if(empty($_SESSION['user']))
    {
        // If they are not, we redirect them to the login page.
        header("Location: Login.php");

        // Remember that this die statement is absolutely critical.  Without it,
        // people can view your members-only content without logging in.
        die("Redirecting to Login.php");
    }

    // This if statement checks to determine whether the edit form has been submitted
    // If it has, then the account updating code is run, otherwise the form is displayed
    if(!empty($_POST))
    {
        // If the user entered a new password, we need to hash it and generate a fresh salt
        // for good measure.
        if(!empty($_POST['password']))
        {
            $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
            $password = hash('sha256', $_POST['password'] . $salt);
            for($round = 0; $round < 65536; $round++)
            {
                $password = hash('sha256', $password . $salt);
            }
        }
        else
        {
            // If the user did not enter a new password we will not update their old one.
            $password = null;
            $salt = null;
        }

        // Initial query parameter values
        $query_params = array(
            ':user_id' => $_SESSION['user']['UserID'],
            ':password' => $password,
            ':salt' => $salt
        );

        $query = "
            UPDATE Passwords
            SET
                Password = :password,
                salt = :salt
            WHERE
                UserID = :user_id
        ";

        try
        {
            // Execute the query
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            die("Failed to run query: " . $ex->getMessage());
        }

        // This redirects the user back to the members-only page after they register
        header("Location: index.php");

        // Calling die or exit after performing a redirect using the header function
        // is critical.  The rest of your PHP script will continue to execute and
        // will be sent to the user if you do not die or exit.
        die("Redirecting to index.php");
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
    <title>Home</title>
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
    <?php require 'navHeader.php'; ?>

    <div class="content-wrapper">
        <div class="container">

            <div class="main">
                <center>
                    <h1>Edit Account</h1>

                    <form action="edit_account.php" method="post">
                        Username:<br />
                        <b><?php echo htmlentities($_SESSION['user']['UserName'], ENT_QUOTES, 'UTF-8'); ?></b>
                        <br /><br />
                        Password:<br />
                        <input type="password" name="password" value="" /><br /><br />
                        <input type="submit" value="Update Account" />
                    </form>
                </center>
            </div>
            <div class="panel-body">

            </div>
            <?php require "social.php" ?>

            <!-- CONTENT-WRAPPER SECTION END-->
            <?php require "bottomBar.php" ?>
        </div>
    </div>
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
