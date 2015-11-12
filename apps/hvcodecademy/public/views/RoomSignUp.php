<?php
// connect to database, and make page private.
require("private.php");

require("roomProcessor.php");

if(!empty($_POST))
{
    //SignUp Request recived
    $teacher = $_POST['teacher'];
    $room = $_POST['room'];
    $period = $_POST['period'];
    $date = $_POST['date'];
    echo $teacher.$room.$period.$date;
} //else {
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
    <title>Room SignUp</title>
    <?php require 'Link.php'; ?>
</head>
<body>

    <?php require 'navHeader.php'; ?>

    <div class="content-wrapper">
        <div class="container">

            <div class="main" align="center">

                <!--Code for if select is wanted over datalist -->

                <form action="RoomSignUp.php" method="POST">
                    <fieldset>
                        <label for="">Teacher:</label>
                        <input id="" name="teacher" type="text" list="Teacher" value= <?php echo "\"$currentTeacher\"" ?>/>
                        <datalist id="Teacher" placeholder="Teacher" class="dropdown">
                            <!--Teachers-->
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
                    <br>
                    <fieldset>
                        <label for="">Room:</label>
                        <input id="" name="room" type="text" list="Room"/>
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
                    <br>
                    <fieldset>
                        <label for="">Period:</label>
                        <select id="" class="dropdown" name="period" type="text" list="Period" />
                        <!-- <datalist id="Period" placeholder="Period"> -->
                            <option value="0">7am Class</option>
                            <option value="1">First Period</option>
                            <option value="2">Second Period</option>
                            <option value="3">Third Period</option>
                            <option value="4">Fourth Period</option>
                        </select>
                    </fieldset>
                    <br />
                    <fieldset>
                    	<label for="">Date:</label>
                    	<div id="datetimepicker" class="input-append date">
							<input type="date" name="date"></input>
								<!-- <span class="add-on">
    								<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
								</span> -->
						</div>
					<!-- <script type="text/javascript"
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
                    </script> -->
                    </fieldset>
                    <br />
                    <!-- Button used for Submitting to server side code -->
                    <input type="submit" value="SignUp">
                </form>
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
