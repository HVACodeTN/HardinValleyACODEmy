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
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>



    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Home</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME ICONS  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
     <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    
    <!--<div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
        
            <div class="navbar-header">
            
             <img src="Header.jpg" alt="LOGO" height="180" width="1100"/>
              
            </div>

            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">

                        
</ul>
                            </div> -->
                        


                    
              <!--  </div>
            </div>
        </div>
    
    <!-- LOGO HEADER END-->
       <section class="menu-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-collapse collapse ">
                            <ul id="menu-top" class="nav navbar-nav navbar-left ">
                               
                                <li><a href="Index.php">Home</a></li>
                                <li><a href="Map_Schedule">Schedule</a></li>
                                <li><a href="About.php">About Us</a></li>
                                 <li><a href="MemberList.php">Member list</a></li>
                                <li><a href="Logout.php">Logout</a></li>
    
                            </ul>
                        </div>
                    </div>
 
                </div>
            </div>
        </section>
    <!-- MENU SECTION END-->

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
    
    <div class="content-wrapper" name="map" id="map" style=" background-size: contain;height:100%; background-repeat: no-repeat;" >
        <div class="container" >
        
          <div class="main">
          <input type="radio" name="ch" value="1stfloor" checked="checked" onclick="ChangeBackground(this.value);" /> 1st Floor
          <br />
          <br />
          <input type="radio" name="ch" value="2ndfloor" onclick="ChangeBackground(this.value);" /> 2nd Floor
          <br />
          <br />
          <input type="radio" name="ch" value="buspickup" onclick="ChangeBackground(this.value);" style="position: relative; left:0px;">Section A and Bus Duty</input>
          <br />
          <br />
               <span title="BOO" id="buspickup" name="buspickup">A101</span> 
                   <span >A102</span>
                   <span >A103</span>
                   <span >Gym</span>
          
          <script type="text/javascript">
		  function ChangeBackground(bg){
		  	var url;
			var Asection;
			if(bg=="1stfloor")
				{
					url="assets/img/1stfloor.png";
					document.getElementById("map").style.backgroundImage = "url(" + url + ")";
				}
					else if(bg=="2ndfloor")
						{
							url="assets/img/2ndfloor.png";
							document.getElementById("map").style.backgroundImage = "url(" + url + ")";
						}
							else if(bg=="buspickup")
								{
									url="assets/img/buspickup.png";
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
