<?php 
error_reporting(E_ALL);

// Enable displaying errors
ini_set('display_errors', 1);

require_once __DIR__ . "/../utils/config.php";

/** PHP Reused code that has to do dealing with DBs */
// All DB Queries will be done from here

function is_username_in_db($username)
{
    global $conn;

    // Escape username to prevent SQLi
    $username = $conn->real_escape_string($username);

    // Build SQL query get username from User Table
    $sql = "SELECT id FROM User WHERE username = '$username'";

    // Execute the query
    $result = $conn->query($sql);

    // If the number of rows is greater than 0, the user exists
    if ($result->num_rows > 0)
    {
        return true;
    }

    else
    {
        return false;
    }

}

function insert_new_user_into_db($username, $password, $token1, $token2)
{
    // Insert a New User to DB and along with its tokens
    global $conn;

    // Escape parameters so no SQLi takes place
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Hash it right from the start
    $hashed_password = hash_password($password);

    // Hash tokens right away as well
    $token1 = hash_password($token1);
    $token2 = hash_password($token2);
    
    // No need to escape tokens since they don't come from the user
    // Form SQL query to insert user
    $user_sql = "INSERT INTO User (username, password_hash) VALUES ('$username', '$hashed_password')";

    // Begin a DB transaction to make sure the User is inserted first and then the TokenFile
    $conn->begin_transaction();

    // Track whether the transaction was successful
    $trans_success = false;

    // Set success status to true in case new user could be inserted
    if ($conn->query($user_sql))
    {
        $trans_success = true;
    }

    // If User inserted file, go for TokenFile
    if ($trans_success)
    {
        // Grab the id of the last inserted row
        $user_id = $conn->insert_id;

        // Develop SQL query for TokenFile
        $tokenfile_sql = "INSERT INTO TokenFile (user_id, token1, token2) VALUES ($user_id, '$token1', '$token2')";

        // Set success status to false if tokenfile could not be inserted
        if (!$conn->query($tokenfile_sql))
        {
            $trans_success = false;
        }
    }

    // Commit or rollback transaction based on succes status
    if ($trans_success)
    {
        // Commit all transaction
        $conn->commit();

        // Return username
        return [
            "username" => $username,
            "password" => $password
        ];
    }

    else
    {
        // Rollback all interactions
        $conn->rollback();

        // Return error in DB
        return ["error" => "Failed to register user"];
    }
}

?>