<?php

//privates the page
require("private.php");

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
                    <h1><?php echo "Welcome, ".$_SESSION['user']['UserName']; ?></h1>
                    <br />
                    <p>Thank you for useing Hardin Valley ACODEmy's application. This is a school schedule appication. It is built to show you a Map schedule with a table that includes. One where every Teacher is during each class period. Two if that teacher has signed up to be in a different room then normal. Lastly it provides info on where laptop carts are during each class period.</p>
                    <br />
                    <p>To teachers you are allowed more permission the the adverage student. This allows you to sign up for rooms and for carts for different class periods as long as they haven't already been signout.</p>
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
