<?php

    require("private.php");
    
    require("roomProcessor.php");
    
    //TODO: Jackson create variable for each room with "TeacherName" + "Room name" from database based on current time.
    // Rooms include All Classrooms, Labs, Workrooms, Multipurpose room, Library, bus duty (It's a place on the map)
    //$D101="TeacherName" + " D101";

    //TODO: Logic to chose Period
    $period = 2;

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
    switch ($Location) {
        case 'Down':
            # code...
            break;
        case 'UP':
            # code...
            break;
        case 'Bus':
            # code...
            break;
        default:
            # code...
            break;
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

<?php require 'Link.php'; ?>

<!-- Add PHP Table -->
<h1>Schedule</h1> 
<table class="table table-bordered>
	<thead>
        <tr>  
            <th>Room</th>  
            <th>Username</th> 
            <th>Item</th>
            <th>Email</th>
        </tr> 
    </thead>
    <tbody>
    	<tr>
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
            } ?></td> 
            <td><?php echo htmlentities($row['UserName'], ENT_QUOTES, 'UTF-8'); ?></td> 
        </tr>
        <tr>
        	<td>
            <td>
            <td>
        </tr>
        <tr>
        	<td>
            <td>
            <td>
        </tr>
     </tbody>
   </table>
    <?php endfor; ?> 
</table> 
<!-- End PHP Table -->
<?php require link.php ?>

    <div class="content-wrapper" name="map" id="map" style=" background-size: contain;height:100%; background-repeat: no-repeat;" >
        <div class="container" >
        
          <div class="main">
          <input type="radio" name="ch" value="1stfloor" checked="checked" onclick="ChangeBackground(this.value);" style="position:"relative"; left:"500px"; /> 1st Floor
          <br />
          <br />
          <input type="radio" name="ch" value="2ndfloor" onclick="ChangeBackground(this.value);" /> 2nd Floor
          <br />
          <br />
          <input type="radio" name="ch" value="buspickup" onclick="ChangeBackground(this.value);" style="position: relative; left:0px;">Section A and Bus Duty</input>
          <br />
          <br />
               <span title="BOO" id="buspickup" name="buspickup" style="background-image: url(assets/img/buspickup.jpg)">A101</span> 
                   <span >A102</span>
                   <span >A103</span>
                   <span >Gym</span>
          
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
                   
   <div class="A101">
     BOO!  
   </div>
      

    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
