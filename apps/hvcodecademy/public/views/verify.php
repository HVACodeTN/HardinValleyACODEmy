<?php 
        // First execute common code to connection to the database and start the session
        require("common.php");
	//verify hash
	if(isset($_GET['hash']) && !empty($_GET['hash']))
	{
                $URLsalt = $_GET['hash'];
        
                $query = "
            SELECT 
                UserID
            FROM Users
            WHERE
                URLsalt = :URLsalt
        ";

        // This contains the definitions for any special tokens that we place in
        // our SQL query.  In this case, we are defining a value for the token
        // :username.  It is possible to insert $_POST['username'] directly into
        // your $query string; however doing so is very insecure and opens your
        // code up to SQL injection exploits.  Using tokens prevents this.
        // For more information on SQL injections, see Wikipedia:
        // http://en.wikipedia.org/wiki/SQL_Injection
        $query_params = array(
            ':URLsalt' => $URLsalt
        );

        try
        {
            // These two statements run the query against your database table.
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            die("Failed to run query1: " . $ex->getMessage());
        }
        $getUserID = $stmt->fetch();
        //echo $getUserID;
        if($getUserID)
        {
                $UserID = $getUserID["UserID"];
        }
        else
        {
                die("User not found");
        }
               
		$query3 = "
            UPDATE Users
            SET Activated = '1'
            WHERE 
                UserID = :UserID;
        ";
		$query3_params = array(
            ':UserID' => $UserID
        );
		try
        {
            // These two statements run the query against your database table.
            $stmt3 = $db->prepare($query3);
            $result3 = $stmt3->execute($query3_params);
        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            die("Failed to run query3: " . $ex->getMessage());
        }
        
        header("Location: Login.php");
                   die("Account Activated
                   Redirecting to Login.php");
	}
		
?>

</body>
</html>
