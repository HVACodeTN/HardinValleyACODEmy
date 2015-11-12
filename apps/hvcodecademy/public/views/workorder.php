<?php

//privates the page
require("private.php");

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Work Order</title>
    <?php require "Link.php" ?>
</head>

<body>
    <?php require 'navHeader.php'; ?>

    <div class="content-wrapper">
        <div class="container">

            <div class="main">
                <form action="workorder.php" method="POST">
                    <!-- Center everything within the from -->
                    <center>
                        <h1>Work Order</h1>
                        <fieldset>
                            <!-- Work Order Input -->
                            <p>
                                <label for="">Problem:</label>
                                <br />
                                <input type="text" name="" value="" />
                            </p>

                            <input type="submit" value="WorkOrder">
                        </fieldset>
                    </center>
                </form>
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
