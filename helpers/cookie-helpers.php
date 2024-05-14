<?php 
error_reporting(E_ALL);

// Enable displaying errors
ini_set('display_errors', 1);

/** PHP Code used to deal with user cookies */
// All DB Queries will be done from here

function create_user_cookie($id)
{
    // Set expiration time for two weeks
    $expiration = time() + (14 * 24 * 3600);
    setcookie("user-id", $id, $expiration, "/");
}

function delete_user_cookie()
{
    // Set expiration to one hour ago
    if (isset($_COOKIE["user-id"]))
    {
        $expiration = time() - 3600;
        setcookie("user-id", "", $expiration, "/");
    }
}

?>