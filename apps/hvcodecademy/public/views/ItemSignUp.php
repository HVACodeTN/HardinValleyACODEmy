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
  
  <!--<form action="cartsignup.php" method="POST">
       <fieldset>
           <label for="">Teacher:</label>
                <select id="" name="select" type="text" list="Teacher"/>
                   		<!--Teachers
                        <option value="">
                        <option value="">
                        <option value="">
                        <option value="">
       </fieldset>
       			<br>
       <fieldset>
           <label for="">Room:</label>
                <select id="" name="select" type="text" list="Room"/>
                   		<!--All A Rooms
                        <option value="A101">
                        <option value="A102">
                        <option value="A103">
                        <option value="Gymnasium">
                        <!--All B Rooms
                        <option value="B101">
                        <option value="B102">
                        <option value="B103">
                        <option value="B107">
                        <option value="B112">
                        <option value="Commons Area">
                        <option value="Auditorium">
                        <option value="">
                        <option value="">
                        <option value="">
                        <!--All C Rooms
                        <option value="Multi-Purpose Room">
                        <option value="Learning Center">
                        <option value="Guidance">
                        <option value="Office">
                        <option value="">
                        <option value="">
                        <option value="">
                        <option value="">
                        <!--All D Rooms
                        <option value="D101">
                        <option value="D102">
                        <option value="D103">
                        <option value="D104">
                        <option value="D105">
                        <option value="D106">
                        <option value="D107">
                        <option value="D108">
                        <option value="D109">
                        <option value="D110">
                        <option value="D111">
                        <option value="D112">
                        <option value="D113">
                        <option value="D114">
                        <option value="D115">
                        <option value="D116">
                        <option value="D117">
                        <option value="D118">
                        <option value="D119">
                        <option value="D201">
                        <option value="D202">
                        <option value="D203">
                        <option value="D204">
                        <option value="D205">
                        <option value="D206">
                        <option value="D207">
                        <option value="D208">
                        <option value="D209">
                        <option value="D210">
                        <option value="D211">
                        <option value="D212">
                        <option value="D213">
                        <option value="D214">
                        <option value="D215">
                        <option value="D216">
                        <option value="D217">
                        <option value="D218">
                        <!--All E Rooms
                        <option value="Library">
                        <option value="E102">
                        <option value="E103">
                        <option value="E104">
                        <option value="E105">
                        <option value="E106">
                        <option value="E205">
                        <option value="E206">
                        <option value="E208">
                        <!--All F Rooms
                        <option value="F101">
                        <option value="F102">
                        <option value="F103">
                        <option value="F104">
                        <option value="F105">
                        <option value="F106">
                        <option value="F107">
                        <option value="F108">
                        <option value="F109">
                        <option value="F110(Bio Lab)">
                        <option value="F111">
                        <option value="F112">
                        <option value="F113">
                        <option value="F114">
                        <option value="F115">
                        <option value="F116">
                        <option value="F117">
                        <option value="F118">
                        <option value="F119">
                        <option value="I.S.S">
                        <option value="F202(Chem Lab)">
                        <option value="F203">
                        <option value="F204">
                        <option value="F205">
                        <option value="F206">
                        <option value="F207">
                        <option value="F208">
                        <option value="F209">
                        <option value="F210">
                        <option value="F211">
                        <option value="F212">
                        <option value="F213">
                        <option value="F214">
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
  
  
  
   <form action="cartsignup.php" method="POST">
       <fieldset>
           <label for="">Teacher:</label>
                <input id="" name="" type="text" list="Teacher"/>
                    <datalist id="Teacher" placeholder="Teacher" class="dropdown">
                        <!--Teachers-->
                        <option value="Mrs.West">
                        <option value="">
                        <option value="">
                        <option value="">
       </fieldset>
       			<br>
       <fieldset>
           <label for="">   Room:</label>
                <input id="" name="" type="text" list="Room"/>
                    <datalist id="Room" placeholder="Room" class="dropdown">
                        <!--All A Rooms-->
                        <option value="A101">
                        <option value="A102">
                        <option value="A103">
                        <option value="Gymnasium">
                        <!--All B Rooms-->
                        <option value="B101">
                        <option value="B102">
                        <option value="B103">
                        <option value="B107">
                        <option value="B112">
                        <option value="Commons Area">
                        <option value="Auditorium">
                        <option value="">
                        <option value="">
                        <option value="">
                        <!--All C Rooms-->
                        <option value="Multi-Purpose Room">
                        <option value="Learning Center">
                        <option value="Guidance">
                        <option value="Office">
                        <option value="">
                        <option value="">
                        <option value="">
                        <option value="">
                        <!--All D Rooms-->
                        <option value="D101">
                        <option value="D102">
                        <option value="D103">
                        <option value="D104">
                        <option value="D105">
                        <option value="D106">
                        <option value="D107">
                        <option value="D108">
                        <option value="D109">
                        <option value="D110">
                        <option value="D111">
                        <option value="D112">
                        <option value="D113">
                        <option value="D114">
                        <option value="D115">
                        <option value="D116">
                        <option value="D117">
                        <option value="D118">
                        <option value="D119">
                        <option value="D201">
                        <option value="D202">
                        <option value="D203">
                        <option value="D204">
                        <option value="D205">
                        <option value="D206">
                        <option value="D207">
                        <option value="D208">
                        <option value="D209">
                        <option value="D210">
                        <option value="D211">
                        <option value="D212">
                        <option value="D213">
                        <option value="D214">
                        <option value="D215">
                        <option value="D216">
                        <option value="D217">
                        <option value="D218">
                        <!--All E Rooms-->
                        <option value="Library">
                        <option value="E102">
                        <option value="E103">
                        <option value="E104">
                        <option value="E105">
                        <option value="E106">
                        <option value="E205">
                        <option value="E206">
                        <option value="E208">
                        <!--All F Rooms-->
                        <option value="F101">
                        <option value="F102">
                        <option value="F103">
                        <option value="F104">
                        <option value="F105">
                        <option value="F106">
                        <option value="F107">
                        <option value="F108">
                        <option value="F109">
                        <option value="F110(Bio Lab)">
                        <option value="F111">
                        <option value="F112">
                        <option value="F113">
                        <option value="F114">
                        <option value="F115">
                        <option value="F116">
                        <option value="F117">
                        <option value="F118">
                        <option value="F119">
                        <option value="I.S.S">
                        <option value="F202(Chem Lab)">
                        <option value="F203">
                        <option value="F204">
                        <option value="F205">
                        <option value="F206">
                        <option value="F207">
                        <option value="F208">
                        <option value="F209">
                        <option value="F210">
                        <option value="F211">
                        <option value="F212">
                        <option value="F213">
                        <option value="F214">
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
       <fieldset>
       		<label for="">Item:</label>
                <input id="" name="select item" type="text" list="SignOutItems" />
                    <datalist id="SignOutItems" placeholder="select">
                        <option value="">
                        <option value="">
                        <option value="">
                        <option value="">
                    </datalist>
       </fieldset>   
       
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