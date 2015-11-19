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
                    <h1><?php echo "Welcome, ".$_SESSION['user']['UserName']."!"; ?></h1>
                    <br />
		    <h2>Thank you for useing Hardin Valley ACODEmy's application.<h2>
		    <br />
                    <p>This is a school schedule appication. It is built to show you a Map schedule with a table that includes. One, where every Teacher is during each class period. Two, if that teacher has signed up to be in a different room then normal. Lastly, it provides information on where laptop carts are during each class period.</p>
                    <br />
		    <p> To Students: You are only allowed the permissions to look at the home, map, and edit pages once logged in to the site.
		    <br />
                    <p>To Teachers: You are allowed more permission then the adverage user (student). This allows you to sign up for rooms and for carts for different class periods as long as they haven't already been signout.</p>
		    <br />
		    <p>Also if you are in need of any help with the site please contact the email for the application at the bottom, the social media pages at the bottom, or talk to an admin at your school.(If you email or contact us via social media it should only take up to 24 hours for use to respond. This is a free service.).
		    <br />
		    <p>Lastly this website is to be used as an example for the concept of the use of this type of schedule around the world. It is to help be more efficient.
		    <br />
                </center>
            </div>
            <div class="panel-body">

            </div>

            <?php require "social.php" ?>

           </div>
            <!-- CONTENT-WRAPPER SECTION END-->
       </div>
    	<?php require "bottomBar.php" ?>


		<?php require "LinkScript.php" ?>

</body>
</html>
