<?php 
/* Set error reporting level
error_reporting(E_ALL);

// Enable displaying errors
ini_set('display_errors', 1);*/

require_once __DIR__ . "/../envs.php";

// Load envs
loadEnvVarsWhenRequired();

// Grab each DB detail
$db_host = $_ENV["DB_HOST"];
$db_name = $_ENV["DB_NAME"];
$db_user = $_ENV["DB_USER"];
$db_pass = $_ENV["DB_PASS"];

// Create a new OOP MySQLi Object
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error)
{
    die("Connection Failed: " . $conn->connect_error);
}

?>