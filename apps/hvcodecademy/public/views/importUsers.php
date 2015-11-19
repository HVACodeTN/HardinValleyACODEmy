<?php
$input="CarleenLewis,,,6106,3117,6106,6106
JaredHuisingh,,,6111,6104,6104,6111
BethLove,,,4104,4104,4104,4104
ValarieMills,,,6103,6103,6103,6103
JenniferPace,,,4116,4116,4116,4116
PaigeWalker,,4115,,4115,4106,4115
JohnSides,,,4206,4206,4204,
AllisonWalker,,6111,,6112,6111,6104
AmandaWash,,,6113,6113,6113,
MichelleWeller,6115,6115,,6115,,6115
TerryDisney,,6106,4202,,4202,4202
JenniferGalloway,,4112,4108,4112,,4108
KeithGalloway,,4104,4103,5105,,4103
JakeGulledge,,4205,4205,4205,,4205
LoriHarder,,6110,6110,,6110,6110
EmilyHarmon,,4203,4203,,4203,4203
DorothyLee,,4202,4208,4202,,4208
TealMcInturff,,4110,4114,,4114,4114
JoeMichalski,,6103,4214,4214,,
RachelO'Connor,,5102,5102,,5102,
GerriParker,,4212,,4212,4212,4212
ShellyPatton,4214,4214,,4203,,4216
KateRussell,,,4112,4114,4112,4112
TeresaSon,4114,4114,4216,,,
RobertWright,6112,6112,6112,,,6112
NancyBusch,,5105,6211,,6211,6211
RudyFurman,,4112,5205,,,
AslynnHalverson,,6207,6212,,6207,6214
MichaelHartman,,,6207,6208,6208,
LisaJacobs,6214,6214,,6214,,6212
ArbyDickert,,6211,6214,6211,,6214
MichaelKnapp,6213,6213,,6213,,5102
KerriMiralles,,,6205,6209,6209,6209
CalebPaquette,,6212,6210,6212,,6210
SarahPrice,,6210,6209,,,
TravisQuick,,6203,6203,,6203,6203
YoungShim,,6205,,6205,6205,6205
JamesSternberg,,6209,6202,,,6202
VeronicaSussmane,,,6213,,6213,6213
JohnTilson,,6208,6208,6203,,6208
BryanBrown,4110,,4110,4110,,4110
ShaneChambers,,4116,4107,4116,,4106
RebeccaFurman,,6108,,6108,6108,
AndreaGuy,,6102,6101,,6101,6101
MikeHicks,,,6108,6103,6103,6108
SierraHuff,,6113,6113,6110,,6113
DLKing,,,2112,2101,4104,2112
CeliaMoorman,6114,6114,6114,,,6114
LisaMyers,,,6115,6114,6114,6116
MattPatillo,,4106,,4201,4106,4214
SethRayman,,4108,4116,4108,,4206
MikeRosenke,,4210,,1103,4210,4207
HollyWilgus,,,4106,6106,6106,4115
TreyWilliams,,,4210,4210,4214,4210
MikeWise,,,4212,4115,,
SandraAchenbach,,4105,4105,4105,,4105
VeronicaCalderon-Speed,,,6109,6116,6116,6109
CarlosLopez,,6116,6116,,6115,6116
FrankChen,,4208,,4208,4208,4211
EmilyFulgham,,,6102,6102,6102,6102
AmandaDascomb,,,,6107,6107,
BethHowe,,6107,6107,,6112,
PeggyMelgaard,,6109,,6109,6109,6107
SabineNebenfuehr,,,,,4105,
AmandaBrown,,4209,4209,,4209,4209
TammyDavis,,4215,,4215,5105,6116
JimFriedrich,,,4215,5102,4215,4215
GloriaPrice,,5106,5106,5106,5106,5106
VivianWest,,4207,,4207,4207,
JeffWilson,,,4211,4211,4211,4110
ChuckBrock,,2102,,2102,2102,2103
AngelaDick,,5104,5104,,5104,5104
BenEng,,,5103,5103,5103,5103
PeggyJones,,2103,,2103,2103,2102
AlexRector,,1106,2102,,2102,2102
TeresaScoggins,,2112,,2112,2112,
RobertWarren,2100,2101,2101,,,2101
AndreCaballero,,,1100,1100,1103,1100
RickCollett,,1100,,1102,1102,1106
JeffHash,,1102,1102,,1100,1102
WesJones,,2100,2100,,,2100
PaulMaynard,,,2100,2100,2100,
BrianneMcCroskey,,1100,1101,1101,,1101
MitziMcCurry,,1103,1103,,1100,1103
MarkPatterson,,1101,1100,1100,,1100
MikePotter,,2100,,2100,2100,2100
JeffBlack,,4107,,4107,4107,4107
AmberHartman,,,5208,5208,5208,5208
AmyMurrell,5205,5205,,5205,,4201
DanaSherrell,,4201,4201,,5205,4201
BeckySwann,,5208,,5206,5206,5206
JoyBegnaud,,5206,5206,,4201,6207
VanceBretz,,6212,4101,,6207,4101
BethBuehler,,4101,4204,,6103,
CoryMinzyk,,4216,4214,4216,,
AnthonyDelisse,,6104,,4204,6114,
KristeeGuy,,4106,,4101,4102,
DonnaHenkel,,,4102,4102,4102,4102
TerriHicks,,4103,4103,4103,,4102
TimLee,,4109,4109,4109,4109,
MalloryWoods,,4111,4111,4111,4111,4109
";

require 'common.php';

$lines = explode("\r\n",$input);
foreach ($lines as $key => $line ) {
    $values = explode(",",$line);
    //create user
    echo $values[0];
    $id = createUser($values[0]);
    echo "Created User: $id";
    //add to schedule
    $nVals = count($values);
    for ($i=1; $i < $nVals ; $i++) {
        if ($values[$i]) {
            addSchedule($i-1,$id,$values[$i]);
        }
    }
}


function createUser($TeacherName)
{
    $dusername = "a72e7f8066aa";
    $dpassword = "025449556a1df619";
    $dbname = "hvcodecademy";
    $school = "dbschool"; //TODO: what are we going to do with the school field?
    $host = "localhost"; //TODO: is this the correct host?

    //comunicates that we are using UTF-8
    //stores wide varienty of special characters
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    try {
    	$db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $dusername, $dpassword, $options);
    } catch(PDOException $ex) {
    	//if an error occurs then output error and stop executing
    	die("failed to connect to the database: " . $ex->getMessage());
    }

    //allows for trapping errors from database using try/catch blocks
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	// This statement configures PDO to return database rows from your database using an associative
        // array.  This means the array will have string indexes, where the string value
        // represents the name of the column in your database.
    	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $userIDUnique = false;
    while(!$userIDUnique)
    {
        $query2 = "
            SELECT
                1
            FROM Users
            WHERE
                UserID = :UserID
            ";

        $UserID = mt_rand();
        $query2_params = array(
            ':UserID' =>  $UserID
        );

        try
        {
            // These two statements run the query against your database table.
            $stmt2 = $db->prepare($query2);
            $result2 = $stmt2->execute($query2_params);
        }
        catch(PDOException $ex)
        {
            // TODO: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            die("Failed to run query2: " . $ex->getMessage());
        }
        if (!$stmt2->rowCount()) { // this returns 1 if the userID is found and already exists. If nothing is found, we should proceed
            // we didn't find any conflicts: go ahead and proceed
            $userIDUnique = true;
        }
    }
    $query3 = "
        INSERT INTO Users (
            UserName,
            UserID,
            AccountType
        ) VALUES (
            :UserName,
            :UserID,
            :AccountType
        ) ";

     $query4 = "
        INSERT INTO Passwords (
            UserID,
            Password,
            salt
        ) VALUES (
            :UserID,
            :Password,
            :salt
        )
    ";

    $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));

    $password = hash('sha256', "HVApassword" . $salt);
    for($round = 0; $round < 65536; $round++)
    {
        $password = hash('sha256', $password . $salt);
    }
    $AccountType = 2; //AccountType 1 is Admin

    $query3_params = array(
        ':UserName' => $TeacherName,
        ':UserID' => $UserID,
        ':AccountType' => $AccountType
    );

    $query4_params = array(
        ':UserID' => $UserID,
        ':Password' => $password,
        ':salt' => $salt
    );

    try
    {
        // Execute the query to create the user
        $stmt3 = $db->prepare($query3);
        $result3 = $stmt3->execute($query3_params);
    }
    catch(PDOException $ex)
    {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
       die("Failed to run query3: " . $ex->getMessage());
    }

    try
    {
        // Execute the query to create the user
        $stmt4 = $db->prepare($query4);
        $result4 = $stmt4->execute($query4_params);
    }
    catch(PDOException $ex)
    {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query4: " . $ex->getMessage());
    }
    return $UserID;
}

function addSchedule($period,$id,$room)
{
    $username = "a72e7f8066aa";
    $password = "025449556a1df619";
    $dbname = "hvcodecademy";
    $school = "dbschool"; //TODO: what are we going to do with the school field?
    $host = "localhost"; //TODO: is this the correct host?

    //comunicates that we are using UTF-8
    //stores wide varienty of special characters
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    try {
    	$db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
    } catch(PDOException $ex) {
    	//if an error occurs then output error and stop executing
    	die("failed to connect to the database: " . $ex->getMessage());
    }

    //allows for trapping errors from database using try/catch blocks
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	// This statement configures PDO to return database rows from your database using an associative
        // array.  This means the array will have string indexes, where the string value
        // represents the name of the column in your database.
    	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $query2 = "INSERT INTO `Schedule` (`UserID`, `Period`, `Room`) VALUES (:ID, :Period, :Room)";

    $query2_params = array(
        ':ID' =>  $id,
        ':Period' =>  $period,
        ':Room' =>  $room
    );

    try
    {
        // These two statements run the query against your database table.
        $stmt2 = $db->prepare($query2);
        $result2 = $stmt2->execute($query2_params);
    }
    catch(PDOException $ex)
    {
        // TODO: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query2: " . $ex->getMessage()."Period:$period Room:$room USERID:$id");
    }
}
?>
