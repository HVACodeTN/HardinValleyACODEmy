<?php
if ($_SESSION['user']['AccountType'] == 'Administrator'){
    $admin = true;
}
?> 
<img src="\views\assets\img\Header.jpg" alt="LOGO" style="width:100%;height:10%"/>

<!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-left ">
                           
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="Map_Schedule.php">Schedule</a></li>
                            <li><a href="ItemSignUp.php">Cart SignUp</a></li>
                            <li><a href="RoomSignUp.php">Room SignUp</a></li>
                            <?php if (admin): ?>
                                <li><a href="UserList.php">Member list</a></li>
                            <?php endif; ?>                    
                            <li><a href="edit_account.php">Edit Account</a></li>
                            <li><a href="Logout.php">Logout</a></li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
<!-- MENU SECTION END-->