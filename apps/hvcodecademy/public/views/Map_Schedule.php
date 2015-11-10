<?php

    require("private.php");
    
    require("roomProcessor.php");
    
    //TODO: Jackson create variable for each room with "TeacherName" + "Room name" from database based on current time.
    // Rooms include All Classrooms, Labs, Workrooms, Multipurpose room, Library, bus duty (It's a place on the map)
    //$D101="TeacherName" + " D101";

    //TODO: Logic to chose Period
    $period = 1;

    //Create Query
    $query = "SELECT
                Schedule.Room, 
                Users.UserName,
                Rooms.RoomName
            FROM Schedule,Users,Rooms
            WHERE
                Schedule.Period = :Period AND 
                Users.UserID = Schedule.UserID AND
                Rooms.RoomNumber = Schedule.Room";
    $query_params = array(
        ':Period' => $period
    );

    
    $num_results = 0;
    try 
    { 
        // Execute the query against the database 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params);
        $num_results = $stmt->rowCount();
    } 
    catch(PDOException $ex) 
    { 
        //display if failed to run 
        die("Failed to run query: " . $ex->getMessage()); 
    }

    //Radio Buttons:
    // Down:B/C/D/E/F
    // UP F/E/D
    // Bus: A/Bus
    
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
<!doctype html>
<html>
<head>

<meta charset="utf-8">


</head>

<body>

<!-- Add PHP Table -->
<h1>Schedule</h1> 
<table> 
    <tr>  
        <th>Room</th>  
        <th>Username</th>  
    </tr> 
    <?php //Iterate Results
        for ($i=0; $i < $num_results; $i++): 
            //Process Results
            $row = $stmt->fetch();?>
        <tr> 
            <td><?php 
            if ($row['RoomName']) {
                echo htmlentities($row['RoomName'], ENT_QUOTES, 'UTF-8');
            } else {
                echo htmlentities($row['RoomNumber'], ENT_QUOTES, 'UTF-8');
            } ?></td> 
            <td><?php echo htmlentities($row['UserName'], ENT_QUOTES, 'UTF-8'); ?></td> 
        </tr> 
    <?php endfor; ?> 
</table> 
<!-- End PHP Table -->


</body>
</html>