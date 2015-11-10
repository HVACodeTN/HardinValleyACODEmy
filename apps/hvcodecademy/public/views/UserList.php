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
$query = "SELECT
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
    <title>MemberList</title>
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
            <?php require "social.php" ?>
        </div>
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
