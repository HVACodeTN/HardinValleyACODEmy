<?php

require("private.php");

require("roomProcessor.php");


if ($_POST['period']) {
    $period = $_POST['period'];
} else {
    $period = 1;
}

//Create Query
$query = "SELECT Schedule.Room, Rooms.RoomName, Users.UserName, Carts.CartName
FROM `Schedule`
LEFT JOIN Users ON Schedule.UserID = Users.UserID
LEFT JOIN Rooms ON Schedule.Room = Rooms.RoomNumber
LEFT JOIN CartCheckout ON Schedule.UserID = CartCheckout.UserID AND Schedule.Period = CartCheckout.Period AND Schedule.Room = CartCheckout.Room AND CartCheckout.Date = CURDATE()
LEFT JOIN Carts ON CartCheckout.CartID = Carts.CartID
WHERE Schedule.Period = :Period
ORDER BY Schedule.Room ASC";

$query_params = array(
    ':Period' => $period
);

$num_results = 0;
try
{
    // Execute the query against the database
    $stmt= $db->prepare($query);
    $result = $stmt->execute($query_params);
    $num_results = $stmt->rowCount();
    //
    // $stmtUP = $db->prepare($query);
    // $result = $stmtUP->execute($query_params_UP);
    // $num_resultsUP = $stmtUP->rowCount();
    //
    // $stmtA = $db->prepare($query);
    // $result = $stmtA->execute($query_params_A);
    // $num_resultsA = $stmtA->rowCount();
}
catch(PDOException $ex)
{
    //display if failed to run
    die("Failed to run query: " . $ex->getMessage());
}

// Iterate Results
// for ($i=0; $i < $num_results; $i++) {
//     //Process Results
//     $row = $stmt->fetch();
//
//     // Use data to create variable for schedule
//     $varName = roomString($row['Room']);
//     global $$varName,$varName;
//     $$varName = $row['Name']; // Takes row and makes it a variable with teacher name in it.
//     echo $varName.": ".$$varName."\n"; //FIXME: Temp debug echo
// }

//Put text on map


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Schedule</title>
        <?php require 'Link.php'; ?>
    </head>
    <body>
        <?php require 'navHeader.php'; ?>
        <div class="content-wrapper" name="map" id="map" style=" background-size: contain;height:100%; background-repeat: no-repeat;" >
            <div class="container" >

                <div class="main">

                    <script type="text/javascript">
                    function ChangeBackground(bg){
                        var url;
                        var Asection;
                        if(bg=="1stfloor")
                        {
                            url="assets/img/1stfloor.jpg";
                            document.getElementById("map").style.backgroundImage = "url(" + url + ")";
                        }
                        else if(bg=="2ndfloor")
                        {
                            url="assets/img/2ndfloor.jpg";
                            document.getElementById("map").style.backgroundImage = "url(" + url + ")";
                        }
                        else if(bg=="buspickup")
                        {
                            url="assets/img/buspickup.jpg";
                            document.getElementById("map").style.backgroundImage = "url(" + url + ")";
                            /*$("input[type='radio']").change(function(){
                            if($(this).val()=="buspickup")
                            {
                            $("buspickup").show("buspickup");
                        }
                        else
                        {
                        $("1stfloor|| 2ndfloor").hide("buspickup");
                    }
                });*/

            }
        }
        </script>
    </div>
    <div class="aside-right" style="position: absolute; border: thin; border-color: black; left: 1080px; height: 656px;" >
        <input type="radio" name="ch" value="1stfloor" checked="checked" onclick="ChangeBackground(this.value);">1st Floor</input>
        <br />
        <br />
        <input type="radio" name="ch" value="2ndfloor" onclick="ChangeBackground(this.value);" />2nd Floor</input>
        <br />
        <br />
        <input type="radio" name="ch" value="buspickup" onclick="ChangeBackground(this.value);" style="position: relative; left:0px;">Section A and Bus Duty</input>
        <br />
        <br />
    	<form action="Map_Schedule.php" method="POST">
    		<fieldset>
                        <label for="">Period:</label>
                        <select id="" name="period" type="text" list="Period" />
                        <option value="0" label="7AM">
                        <option value="1" label="First Period">
                        <option value="2" label="Second Period">
                        <option value="3" label="Third Period">
                        <option value="4" label="Forth Period">
                        </select>
                    </fieldset>
    	</form>
    </div>
    </div>

	<div class="info-table">
        <!-- Add PHP Table -->
            <table class="table table-border fixed-bottom" style="padding-top: 900px">
                <h1>Schedule</h1>
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Username</th>
                        <th>Item</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //Iterate Results
                    for ($i=0; $i < $num_results; $i++):
                        //Process Results
                        $row = $stmt->fetch();?>
                        <tr>
                            <td><?php
                            if ($row['RoomName']) {
                                echo htmlentities($row['RoomName'], ENT_QUOTES, 'UTF-8');
                            } else {
                                echo roomString($row['Room']);
                            }
                            ?></td>
                            <td><?php echo htmlentities($row['UserName'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlentities($row['CartName'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
            <!-- End PHP Table -->
        </div>
    </div>
    <?php require "social.php" ?>

    <!-- CONTENT-WRAPPER SECTION END-->
    <?php require "bottomBar.php" ?>


    <?php require "LinkScript.php" ?>

</body>
</html>
