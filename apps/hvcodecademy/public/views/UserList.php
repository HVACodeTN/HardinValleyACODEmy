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

<?php require 'Link.php'; ?>

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
    <?php require "bottomBar.php" ?>
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
