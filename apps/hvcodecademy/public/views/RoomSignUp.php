<?php
// connect to database, and make page private.
require("private.php");

require("roomProcessor.php");

//Create Query to get teachers
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
        $insertFailMsg = "Could not find UsernName";
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
        ':Period' => $_POST['period']
    );

    $iquery_params[':UserID'] = $UserID;

    // insert indo db
    $iquery = "INSERT INTO RoomCheckout (
        Room,
        UserID,
        Date,
        Period
    ) VALUES (
        :Room,
        :UserID,
        :Date,
        :Period
    )";

    if (!$room) {
        $insertFailMsg = "Could not find Room".htmlentities($room, ENT_QUOTES, 'UTF-8');
    } else if (!$UserID) {
        $insertFailMsg = "Could not find UserName";
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
    <title>Room SignUp</title>
    <?php require 'Link.php'; ?>
</head>
<body>

    <?php require 'navHeader.php'; ?>

    <div class="content-wrapper">
        <div class="container">

            <div class="main" align="center">

                <!--Code for if select is wanted over datalist -->

                <!-- Notify user of success -->
                <?php if ($insertSuccess): ?>
                    <h4>You have succesfully signed up for room: <?php echo $_POST['room']; ?></h4>
                    <br />
                <?php endif; if ($insertFailMsg): ?>
                    <h4><?php echo $insertFailMsg ?></h4>
                    <br />
                <?php endif; ?>
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
                        <input id="" name="room" type="text" list="Room" autofocus/>
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
                        <input id="" class="dropdown" name="period" type="text" list="Period" />
                        <datalist id="Period" placeholder="Period" class="dropdown">
                            <option value="0">7am Class</option>
                            <option value="1">First Period</option>
                            <option value="2">Second Period</option>
                            <option value="3">Third Period</option>
                            <option value="4">Fourth Period</option>
                            <option value="5">Flight Time</option>
                            <option value="6">Bus Duty</option>
                        </datalist>
                    </fieldset>
                    <br />
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
    	<?php require "bottomBar.php" ?>


		<?php require "LinkScript.php" ?>

</body>
</html>
