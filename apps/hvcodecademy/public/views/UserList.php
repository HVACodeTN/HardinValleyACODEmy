<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    if(!($_SESSION['user']['AccountType']=='Administrator')) 
    { 
        // User is not admin so we redirect them to the login page. 
        header("Location: /views/index.php"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to index.php"); 
    } 

    require("private.php"); 

    // Everything below this point in the file is secured by the login system 
     
    // We can retrieve a list of members from the database using a SELECT query. 
    // In this case we do not have a WHERE clause because we want to select all 
    // of the rows from the database table. 
    $query = " 
        SELECT 
            UserID, 
            UserName,
            AccountType 
        FROM Users 
    "; 
     
    try 
    { 
        // These two statements run the query against your database table. 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    { 
        // Note: On a production website, you should not output $ex->getMessage(). 
        // It may provide an attacker with helpful information about your code.  
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    // Finally, we can retrieve all of the found rows into an array using fetchAll 
    $rows = $stmt->fetchAll(); 
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User List</title>
</head>

<body>

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
    
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
        
            <div class="navbar-header">
            
             <img src="Header.jpg" alt="LOGO" height="180" width="1100"/>
              

            </div>

            <div class="left-div">
                <div class="user-settings-wrapper">
                    <ul class="nav">

                        
</ul>
                            </div>
                        


                    
                </div>
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
    <div class="content-wrapper">
        <div class="container">
        
          <div class="main">
   <!-- Add PHP Table -->
   <h1>Memberlist</h1> 
   <table> 
       <tr> 
           <th>ID</th> 
           <th>Username</th>  
           <th>Account Type</th>  
       </tr> 
       <?php foreach($rows as $row): ?> 
           <tr> 
               <td><?php echo $row['UserID']; ?></td> <!-- htmlentities is not needed here because $row['id'] is always an integer --> 
               <td><?php echo htmlentities($row['UserName'], ENT_QUOTES, 'UTF-8'); ?></td> 
               <td><?php echo htmlentities($row['AccountType'], ENT_QUOTES, 'UTF-8'); ?></td> 
           </tr> 
       <?php endforeach; ?> 
   </table> 
   <!-- End PHP Table -->
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



