<?php

require("private.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Work Order</title>
	<?php require "Link.php" ?>
</head>

<body>

	<?php require 'navHeader.php';?>
	<div class="content-wrapper">
		<div class="container">

			<div class="main">
				<form action="workorder.php" method="POST">
					<!-- Center everything within the from -->
					<center>
						<h1>Work Order</h1>
						
						<fieldset>
							<!-- Work Order Input -->
							<p>
								<label for="">Problem:</label>
								<br />
								<textarea rows="10" cols="80" name="problem">

								</textarea>
							</p>

							<input type="submit" value="Submit">
						</fieldset>
					</center>
				</form>
			</div>
			<div class="panel-body">

			</div>
			<?php require "social.php" ?>

			<!-- CONTENT-WRAPPER SECTION END-->
		</div>
		<?php require "bottomBar.php" ?>


		<?php require "LinkScript.php" ?>
		<?php 
				require("private.php");
				$currentTeacher = "";
				if ($_SESSION['user']['AccountType']=='Teacher')
				{
    				$currentTeacher = $_SESSION['user']['UserName'];
				}
				
				
				if(!empty($_POST))
    			{
					if(empty($_POST['problem']))
        			{
            			die("Please enter a Problem.");
        			}
					
					$message = 'A New Work Order has been created, the following credentials were used.

------------------------
Teacher: '.$currentTeacher.'
Problem:    
'.$_POST['problem'].'
------------------------
'; 
                
                $headers = "From:noreply@hvcodecademy.projects.codetn.org" . "\r\n"; // Set from headers
	           if(@mail("HardinValleyACODEmy@gmail.com","New Work Order",$message, $header)) 
	           {
                   header("Location: Login.php");
                   die("Work Order Creation Successful
                   Redirecting to Login.php");
  	               
	           }
               else
               {
                   header("Location: Login.php");
                   die("Work Order Creation Not Successful
                   Redirecting to Login.php");
               }	
				}
			?>	

	</body>
	</html>
