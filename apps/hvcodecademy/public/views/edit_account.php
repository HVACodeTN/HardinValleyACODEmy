<?php

	//privates the page
    require("private.php");

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

    }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Home</title>
    <?php require 'Link.php'; ?>
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
       </div>
    	<?php require "bottomBar.php" ?>


		<?php require "LinkScript.php" ?>

</body>
</html>
