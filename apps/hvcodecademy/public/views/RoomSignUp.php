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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Access Item Signup</title>
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
       </fieldset>
       			<br>
       <fieldset>
           <label for="">   Room:</label>
                <input id="" name="" type="text" list="Room"/>
                    <datalist id="Room" placeholder="Room" class="dropdown">
                        <?php foreach ($rooms as $key => $row){
                            echo "<option value='";
                            if ($row['RoomName']) {
                                echo htmlentities($row['RoomName'], ENT_QUOTES, 'UTF-8');
                            } else {
                                echo htmlentities(roomString($row['RoomNumber']), ENT_QUOTES, 'UTF-8');
                            }
                            echo "'>";
                        } ?>
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
   </form>
   
 
   
   
          </div>
            <div class="panel-body">
                               
            </div>
             <ul>
                                   
                                   
                                     
        <div class="text-center alert alert-warning">
            <a href="https://www.facebook.com/HardinValleyACODEmy/" class="btn btn-social btn-facebook">
            	<i class="fa fa-facebook"></i>&nbsp; Facebook</a>
            <a href="https://plus.google.com/communities/106795819648573546757?hl=en" class="btn btn-social btn-google">
            	<i class="fa fa-google-plus"></i>&nbsp; Google</a>
            <a href="https://twitter.com/HVACODEmy" class="btn btn-social btn-twitter">
            	<i class="fa fa-twitter"></i>&nbsp; Twitter </a>
            <a href="https://www.linkedin.com/grp/home?gid=8434114" class="btn btn-social btn-linkedin">
            	<i class="fa fa-linkedin"></i>&nbsp; Linkedin </a>
 </ul>
                            
         </div>
                
    <!-- CONTENT-WRAPPER SECTION END-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <center>
                    	<p>HardinValleyACODEmy@gmail.com</p>
                        <p> 2015 | By: Hardin Valley ACODEmy </p>
                    </center>
                </div>

            </div>
        </div>
    </footer>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>

</body>
</html>