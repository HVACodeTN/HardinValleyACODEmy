<!-- Login actived action -->
<?php

//variables that define the connection information for MYSQL Database
$username = "dbusername";
$password = "dbpassword";
$school = "dbschool";
$host = "localhost";

//comunicates that we are using UTF-8
//stores wide varienty of special characters
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

try
{
	
	//opens connection to PDO
	
$db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 
    } 
    catch(PDOException $ex)
	{
	//if an error occurs then output error and stop executing
	die("failed to connect to the database: " . $ex->getMessage());
}
//allows for trapping errors from database using try/catch blocks
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// This statement configures PDO to return database rows from your database using an associative 
    // array.  This means the array will have string indexes, where the string value 
    // represents the name of the column in your database. 
																			// NOTE THIS MAY NEED TO BE CHANGED TO NOT BE STRING INDEXES
 $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);



//disables magic quotes
if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) 
    { 
        function undo_magic_quotes_gpc(&$array) 
        { 
            foreach($array as &$value) 
            { 
                if(is_array($value)) 
                { 
                    undo_magic_quotes_gpc($value); 
                } 
                else 
                { 
                    $value = stripslashes($value); 
                } 
            } 
        } 
     
        undo_magic_quotes_gpc($_POST); 
        undo_magic_quotes_gpc($_GET); 
        undo_magic_quotes_gpc($_COOKIE); 
    } 
	
	
	// Tells web browser that encoded in UTF-8 and to send back in UTF-8.
	header('Content-Type: text/html; charset=utf-8');
	
	//used to store information from the user on server side
	session_start();