<?php


    require("common.php");

    //TODO: Jackson create variable for each room with "TeacherName" + "Room name" from database based on current time.
    // Rooms include All Classrooms, Labs, Workrooms, Multipurpose room, Library, bus duty (It's a place on the map)
    $D101="TeacherName" + " D101";

    //TODO: Logic to chose Period
    $period = 1;

    //Create Query
    $query = "SELECT
                Name,
                Room
            FROM Schedule
            WHERE
                Period = :Period";
    $query_params = array( 
        ':Period' => $period;
    );

    $num_results = 0;
    try 
    { 
        // Execute the query against the database 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params);
        $num_results = $result->num_rows;
    } 
    catch(PDOException $ex) 
    { 
        //display if failed to run 
        die("Failed to run query: " . $ex->getMessage()); 
    }

    
    // Iterate Results
    for ($i=0; $i < $num_results; $i++) { 
        //Process Results
        $row = $stmt->fetch();
        // Use data to create variable for schedule
    }
    
    //Put text on map








?>
<!doctype html>
<html>
<head>

<meta charset="utf-8">


</head>

<body>




<img src="" width="" height="" alt="Schedule"/>

</body>
</html>