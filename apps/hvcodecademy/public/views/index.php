<?php

//privates the page
require("private.php");

?>

<?php require 'Link.php'; ?>

<body>

    <?php require 'navHeader.php'; ?>
	
    <div class="content-wrapper">
        <div class="container">

            <div class="main">

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
