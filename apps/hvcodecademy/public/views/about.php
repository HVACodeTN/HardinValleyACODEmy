<?php

//privates the page
require("private.php");

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>About Us</title>
    <?php require 'Link.php'; ?>
</head>
<body>

    <?php require 'navHeader.php'; ?>


    <div class="content-wrapper">
        <div class="container">

            <div class="main">
              <center>
              <h2>About CodeTN</h2>
              <p>
              CodeTN is a fairly new competition created in 2014 to challenge young, aspiring programmers.
              They are presented with a problem in which they must create a program to solve it.
              This year's problem was to create an application to better the community.
              </p>
              <br>
              <h2>About the Project</h2>
              <p>
              To do this, we created a school schedule and map to help schools
              keep track of things around campus, such as laptop carts and room assignments. It tracks all the teachers
	      with what room they are in and allows others to find them efficiently.
              </p>
              <br>
              <h2>About the Team</h2>
              <p>
              Our team consists of five people:
              <br>
              </p>

                </div>

              <p>
              <br>

            <div class="container">
              <div class="row row-centered">
                <div class="col-xs-12 col-centered">
                  <center><div class="thumbnail"> <img src="assets/img/me3.jpg" width="200" height="200" alt="Tym Brandel"/>
                    <div class="caption">
                        <h3> Tym Brandel
                          <br>
                          <small>Team Leader</small> </h3>
                          <p>Head HTML Programmer, Head Designer, and Social Media.
                          </p>
                    </div>
                            </div>
                            <br>
                          </p> </center>
                      <br><br><br>
                </div>
              <div class="row row-centered">
                <div class="col-xs-6 col-centered">
                  <center><div class="thumbnail"> <img src="assets/img/Jackson.jpg" width="200" height="200" alt="Jackson Smith"/>
<div class="caption">
                    <h3> Jackson Smith
                          <br>
                          <small>Head of Database</small> </h3>
                          <p>Designed database and wrote most of the PHP for the web application.
                          </p>
                    </div>
                            </div>
                            <br>
                          </p> </center>
                      <br><br><br>
                </div>
                <div class="col-xs-6 col-centered">
                  <center><div class="thumbnail"> <img src="assets/img/Sean Toll.jpg" width="200" height="200" alt="Sean Toll"/>
<div class="caption">
                    <h3> Sean Toll
                          <br>
                          <small>Bootstrap</small> </h3>
                          <p>Learned to use bootstrap and worked with Tym.
                          </p>
                    </div>
                            </div>
                            <br>
                          </p> </center>
                      <br><br><br>
                </div>
              </div>
              <div class="row row-centered">
                <div class="col-xs-6 col-centered">
                  <center><div class="thumbnail"> <img src="assets/img/Joey Townsand.jpg" width="200" height="200" alt="Joey Townsand"/>
                    <div class="caption">
                        <h3> Joey Townsend
                          <br>
                          <small>Database</small> </h3>
                          <p>Learning basic PHP from this, Joey assisted Jackson in his PHP objectives.
                          </p>
                    </div>
                            </div>
                            <br>
                          </p> </center>
                      <br><br><br>
                </div>
                <div class="col-xs-6 col-centered">
                  <center><div class="thumbnail"> <img src="assets/img/Jack Anderson.jpg" width="200" height="200" alt="Jack Anderson"/>
                    <div class="caption">
                        <h3> Jack Anderson
                          <br>
                          <small>HTML Editor</small> </h3>
                          <p>Learned basic HTML to help the team.
                          </p>
                    </div>
                            </div>
                            <br>
                          </p> </center>
                      <br><br><br>
                </div>
                </div>
              </div>
          </div>

            <div class="panel-body">
            </div>
            <?php require "social.php" ?>

        </div>
    </div>
    	<?php require "bottomBar.php" ?>


		<?php require "LinkScript.php" ?>

</body>
</html>
