<?php

//connects to server
require("./views/common.php");

//privates the page
require("./views/private.php");






?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title>Untitled Document</title>

</head>

<body>
	<!-- HEADER AND NAVBAR -->
       <img src="../Header.jpg" width="1280" height="427" alt=""/>
<!-- change logo later to updated verison instead of last year's -->
            
            <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">Angular Routing Example</a>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../views/Login.php"> Login</a></li>
                    <li><a href="../views/Register.php"> Register</a></li>
                    <li><a href="../views/memberlist.php"> Admin</a></li>
                    <li><a href="../views/edit_account.php"> My Account</a></li>
                    <li><a href="../views/common.php"> common</a></li>
                </ul>
            </div>
</nav>
</header>
</body>
</html>