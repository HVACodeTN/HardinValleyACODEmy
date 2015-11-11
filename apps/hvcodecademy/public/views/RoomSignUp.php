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

<?php require 'Link.php'; ?>

<body>

    <?php require 'navHeader.php'; ?>

    <div class="content-wrapper">
        <div class="container">

            <div class="main" align="center">

                <!--Code for if select is wanted over datalist -->

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
                    <br>
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
                    <br>
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
                    <br>
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
