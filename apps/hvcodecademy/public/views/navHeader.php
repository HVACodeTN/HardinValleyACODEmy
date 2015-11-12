<?php
if ($_SESSION['user']['AccountType'] == 'Administrator'){
    $admin = true;
}
?>


<img src="\views\assets\img\Header.jpg" alt="LOGO" style="width:100%;height:10%"/>

<!-- LOGO HEADER END-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">Hardin Valley ACODEmy</a> -->
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">

			    			<li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="Map_Schedule.php">Schedule</a></li>
                            <li><a href="ItemSignUp.php">Cart SignUp</a></li>
                            <li><a href="RoomSignUp.php">Room SignUp</a></li>
                            <?php if (admin): ?>
                                <li><a href="UserList.php">User List</a></li>
                            <?php endif; ?>
                            <li><a href="edit_account.php">Edit Account</a></li>
                            <li><a href="Logout.php">Logout</a></li>

      </ul>
    </div>
  </div>
</nav>
