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
    <title>Cart SignUp</title>
    <?php require 'Link.php'; ?>
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
                <form action="ItemSignUp.php" method="POST">
                    <fieldset style=" align-content:center;">
                        <label for="">Teacher:</label>
                        <br />
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
                        <label for="">Room:</label>
                        <br />
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
                        <br />
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
                           <br />
                           <input id="" name="select item" type="text" list="SignOutItems" />
                                <datalist id="SignOutItems" placeholder="select">
                                    <option value="A Cart" label="15 Labtops">
                                    <option value="B Cart" label="15 Labtops">
                                    <option value="C Cart" label="15 Labtops">
                                    <option value="D Cart" label="15 Labtops">
                                    <option value="E Cart" label="15 Labtops">
                                    <option value="F Cart" label="15 Labtops">
                                    <option value="G Cart" label="30 Labtops">
                                    <option value="H Cart" label="30 Labtops">
                                    <option value="I Cart" label="30 Labtops">
                                    <option value="Special Ed 1" label="15 Labtop">
                                    <option value="Special Ed 2" label="15 Labtop">
                                    <option value="Ipad Cart" Label="10 Ipads">
                                    <option value="Tv" label="example">
                                    <option value="Projector" label="example">
                                    <option value="Lab Equipment" label="example">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                    <option value="">
                                </datalist>
                   </fieldset>
                   <fieldset>
                		<label for="">Date:</label>
                        <br />
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
            </div>
            <div class="panel-body">

            </div>
            <?php require "social.php" ?>

      </div>
            <?php require "social.php" ?>

            <!-- CONTENT-WRAPPER SECTION END-->
       </div>
    	<?php require "bottomBar.php" ?>


		<?php require "LinkScript.php" ?>

</body>
</html>
