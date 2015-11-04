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




<TABLE BORDER="0" cellpadding="0" CELLSPACING="0">
<TR>
<!-- add img map img to background later (when I can scan it) place holder img for now to use for testing.-->
<TD width="415" HEIGHT="300" VALIGN="Center" BACKGROUND="Header.jpg" Id="" alt="Schedule">

<FONT SIZE="3" COLOR="Black" Id="$D101">D101</FONT>
<br>
<font size="3" color="black">D102</font>
</TD>

</TR>
</TABLE>


</body>
</html>