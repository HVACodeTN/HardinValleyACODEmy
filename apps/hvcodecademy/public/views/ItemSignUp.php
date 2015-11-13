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

//Create Query for Carts
$query3 = "SELECT
    CartName,
    CartDescription
    FROM Carts
";

try
{
    // Execute the query against the database
    $stmt3 = $db->prepare($query3);
    $result = $stmt3->execute();

    $carts = $stmt3->fetchAll();
}
catch(PDOException $ex)
{
    //display if failed to run
    die("Failed to run query3: " . $ex->getMessage());
}

if(!empty($_POST))
{
    //SignUp Request recived

    // Get UserID
    $squery = "SELECT
    UserID
    FROM Users
    WHERE
    UserName = :UserName";

    $squery_params = array(
        ':UserName' => $_POST['teacher']
    );
    $UserID;
    try
    {
        // Execute the query against the database
        $sstmt = $db->prepare($squery);
        $result = $sstmt->execute($squery_params);
        $UserID = $sstmt->fetch()['UserID'];
    }
    catch(PDOException $ex)
    {
        //display if failed to run
        //die("Failed to run search query: " . $ex->getMessage());
        $insertFailMsg = "Could not find UserName";
    }
    // Get UserID
    $cquery = "SELECT
    CartID
    FROM Carts
    WHERE
    CartName = :CartName";

    $cquery_params = array(
        ':CartName' => $_POST['item']
    );

    try
    {
        // Execute the query against the database
        $cquery = $db->prepare($cquery);
        $result = $cquery->execute($cquery_params);
        $CartID = $cquery->fetch()['CartID'];
    }
    catch(PDOException $ex)
    {
        //display if failed to run
        //die("Failed to run search query: " . $ex->getMessage());
        $insertFailMsg = "Could not find Cart";
    }
    //Get Room
    $room = roomNumber($_POST['room']);
    if (!$room) {
        $rquery = "SELECT
            RoomNumber
        FROM Rooms
        WHERE
        RoomName = :RoomName";

        try
        {
            // Execute the query against the database
            $rstmt = $db->prepare($rquery);
            $result = $rstmt->execute(array(':RoomName' => $_POST['room']));
            $room = $rstmt->fetch()['RoomNumber'];
        }
        catch(PDOException $ex)
        {
            //display if failed to run
            // die("Failed to run room query: " . $ex->getMessage());
            $insertFailMsg = "Could not find Room";
        }
    }

    $iquery_params = array(
        ':Room' => $room,
        ':Date' => $_POST['date'],
        ':Period' => $_POST['period'],
        ':CartID' => $CartID,
        ':UserID' => $UserID
    );

    // insert indo db
    $iquery = "INSERT INTO CartCheckout (
        CartID,
        Room,
        UserID,
        Date,
        Period
    ) VALUES (
        :CartID,
        :Room,
        :UserID,
        :Date,
        :Period
    )";

    if (!$room) {
        $insertFailMsg = "Could not find Room".htmlentities($room, ENT_QUOTES, 'UTF-8');
    } else if (!$UserID) {
        $insertFailMsg = "Could not find UserName";
    } else if (!$CartID) {
        $insertFailMsg = "Could not find Cart";
    } else {
        // Execute the query to create the user
        try
        {
                $istmt = $db->prepare($iquery);
                $istmt->execute($iquery_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
           die("Failed to run insert query: " . $ex->getMessage());
           $insertFailMsg = "Could not checkout Room: $room";
        }
        $insertSuccess = true; // insert query succesful
    }
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

            <!-- Notify user of success -->
            <?php if ($insertSuccess): ?>
                <h4>You have succesfully signed up for room: <?php echo $_POST['room']; ?></h4>
                <br />
            <?php endif; if ($insertFailMsg): ?>
                <h4><?php echo $insertFailMsg ?></h4>
                <br />
            <?php endif; ?>
                <form action="ItemSignUp.php" method="POST">
                    <fieldset style=" align-content:center;">
                        <label for="">Teacher:</label>
<<<<<<< HEAD
                        <br />
                        <input id="" name="" type="text" list="Teacher" value= <?php echo "\"$currentTeacher\"" ?>/>
=======
                        <input id="" name="teacher" type="text" list="Teacher" value= <?php echo "\"$currentTeacher\"" ?>/>
>>>>>>> origin/master
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
                    </br>
                    <fieldset>
                        <label for="">Room:</label>
<<<<<<< HEAD
                        <br />
                        <input id="" name="" type="text" list="Room"/>
=======
                        <input id="" name="room" type="text" list="Room"/>
>>>>>>> origin/master
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
<<<<<<< HEAD
                        <br />
                        <input id="" name="" type="text" list="Period" />
=======
                        <input id="" class="dropdown" name="period" type="text" list="Period" />
>>>>>>> origin/master
                        <datalist id="Period" placeholder="Period">
                            <option value="0">7am Class</option>
                            <option value="1">First Period</option>
                            <option value="2">Second Period</option>
                            <option value="3">Third Period</option>
                            <option value="4">Fourth Period</option>
                            <option value="5">Flight Time</option>
                            <option value="6">Bus Duty</option>
                        </datalist>
                    </fieldset>
                    </br>
                    <fieldset>
                	       <label for="">Item:</label>
<<<<<<< HEAD
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
=======
                           <input id="" name="item" type="text" list="SignOutItems" />
                            <datalist id="SignOutItems" placeholder="select">
                                <?php foreach ($carts as $key => $row): ?>
                                    <option value='<?php
                                        echo htmlentities($row['CartName'], ENT_QUOTES, 'UTF-8');
                                    ?>' label='<?php
                                        echo htmlentities($row['CartDescription'], ENT_QUOTES, 'UTF-8');
                                    ?>'>
                                <?php endforeach; ?>
                            </datalist>
>>>>>>> origin/master
                    </fieldset>
                    </br>
                    <fieldset>
                        <label for="">Date:</label>
                        <div id="datetimepicker" class="input-append date">
                            <input type="date" name="date" value="<?php echo Date("Y-m-d")?>"></input>
                       </div>
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
            <?php require "social.php" ?>

            <!-- CONTENT-WRAPPER SECTION END-->
       </div>
    	<?php require "bottomBar.php" ?>


		<?php require "LinkScript.php" ?>

</body>
</html>
