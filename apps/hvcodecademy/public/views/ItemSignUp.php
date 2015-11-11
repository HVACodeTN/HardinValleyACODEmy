<?php
// connect to database, and make page private.
require("private.php");

require("roomProcessor.php");

//Create Query
$query = "SELECT
UserName,
AccountType
FROM Users
WHERE
AccountType = 'Teacher'";

$num_results = 0;
try
{
    // Execute the query against the database
    $stmt = $db->prepare($query);
    $result = $stmt->execute();
    $num_results = $stmt->rowCount();
}
catch(PDOException $ex)
{
    //display if failed to run
    die("Failed to run query: " . $ex->getMessage());
}

//Create Query for Rooms
$query2 = "SELECT
RoomNumber,
RoomName
FROM Rooms
";

try
{
    // Execute the query against the database
    $stmt2 = $db->prepare($query2);
    $result = $stmt2->execute();

    $rooms = $stmt2->fetchAll();
}
catch(PDOException $ex)
{
    //display if failed to run
    die("Failed to run query2: " . $ex->getMessage());
}
//Create current teacher for later:
$currentTeacher = "";
if ($_SESSION['user']['AccountType']=='Teacher') {
    $currentTeacher = $_SESSION['user']['UserName'];
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
    <title>Access Item Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- DATA SELECTOR BOOTSTRAPS -->
    <!-- <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" media="screen" href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
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
            <!--Code for if select is wanted over datalist
            <form action="cartsignup.php" method="POST">
                <fieldset>
                    <label for="">Teacher:</label>
                    <select id="" name="select" type="text" list="Teacher"/>
                    <!--Teachers
                    <option value="">
                </fieldset>
                <br>
                <fieldset>
                    <label for="">Room:</label>
                    <select id="" name="select" type="text" list="Room"/>
                    <!--All A Rooms
                    <option value="A101">
                </fieldset>
                <br>
                <fieldset>
                    <label for="">Period:</label>
                    <select id="" name="" type="text" list="Period" />
                    <option value="First Period">
                    <option value="Second Period">
                    <option value="Third Period">
                    <option value="Forth Period">
                </fieldset>
                <br>
                <fieldset>
                    <label for="">Item:</label>
                    <select id="" name="" type="text" list="Item"/>
                    <optgroup label="GroupItem 1"
                    <option value="">
                    <optgroup label="GroupItem 2"
                    <option value="">
                    <optgroup label="GroupItem 3"
                    <option value="">
                    <optgroup label="GroupItem 4"
                    <option value="">
                    <optgroup label="GroupItem 5"
                    <option value="">
                </fieldset>
            </form> -->
                <center>
                <form action="cartsignup.php" method="POST">

                    <fieldset>
                        <label for="">Teacher:</label>
                        <input id="" name="" type="text" list="Teacher" value= <?php echo "\"$currentTeacher\"" ?>/>
                        <datalist id="Teacher" placeholder="Teacher" class="dropdown">
                            <!--Teachers-->
                            <option value="Mrs.West(TheDefault)">
                            <?php
                            // Iterate Results
                            for ($i=0; $i < $num_results; $i++) {
                                //Process Results
                                $row = $stmt->fetch();
                                echo '<option value="'. $row['UserName'] .'">';
                            }
                            ?>
                        </datalist>
                    </fieldset>
                    </br>
                    <fieldset>
                        <label for="">   Room:</label>
                        <input id="" name="" type="text" list="Room"/>
                        <datalist id="Room" placeholder="Room" class="dropdown">
                        <?php foreach ($rooms as $key => $row) {
                            echo "<option value='";
                            if ($row['RoomName']) {
                                echo htmlentities($row['RoomName'], ENT_QUOTES, 'UTF-8');
                            } else {
                                echo htmlentities(roomString($row['RoomNumber']), ENT_QUOTES, 'UTF-8');
                            }
                            echo "'>";
                            }
                        ?>
                        </datalist>
                    </fieldset>
                    </br>
                    <fieldset>
                        <label for="">Period:</label>
                        <input id="" name="" type="text" list="Period" />
                        <datalist id="Period" placeholder="Period">
                            <option value="First Period">
                            <option value="Second Period">
                            <option value="Third Period">
                            <option value="Forth Period">
                        </datalist>
                    </fieldset>
                    </br>
                    <fieldset>
                	       <label for="">Item:</label>
                           <input id="" name="select item" type="text" list="SignOutItems" />
                                <datalist id="SignOutItems" placeholder="select">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                </datalist>
                   </fieldset>
                   <fieldset>
                		<label for="">Date:</label>
                        	<div id="datetimepicker" class="input-append date">
    							<input type="text"></input>
    								<span class="add-on">
        								<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
    								</span>
            				</div>
                		<script type="text/javascript"
                            src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
                        </script>
                        <script type="text/javascript"
                            src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
                        </script>
                        <script type="text/javascript"
                            src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
                        </script>
                        <script type="text/javascript"
                            src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
                        </script>
                        <script type="text/javascript">
                            $('#datetimepicker').datetimepicker({
                              format: 'dd/MM/yyyy hh:mm:ss',
                              language: 'pt-BR'
                            });
                        </script>
                    </fieldset>
                </form>
                </center>
            </div>
            <div class="panel-body">

            </div>
            <?php require "social.php" ?>

        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php require "bottomBar.php" ?>
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
