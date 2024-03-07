<?php 

// Read file that contains creds
$creds_db_lines = file("db_creds.txt");

// Grab each DB detail
$db_host = trim($creds_db_lines[0]);
$db_name = trim($creds_db_lines[1]);
$db_user = trim($creds_db_lines[2]);
$db_pass = trim($creds_db_lines[3]);

// Create a new OOP MySQLi Object
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error)
{
    die("Connection Failed: " . $conn->connect_error);
}

?>