<?php
// Set error reporting level
error_reporting(E_ALL);

// Enable displaying errors
ini_set("display_errors", 1);

require_once "../helpers/index.php";

// Handle POST Request for Login Page
if (is_post_request())
{
    // Grab the login data of the user
    $login_data = get_json_request();

    // Grab username, password, and rememberMe
    $username = isset($login_data["username"]) ? $login_data["username"] : "";
    $password = isset($login_data["password"]) ? $login_data["password"] : "";
    $rememberMe = isset($login_data["rememberMe"]) ? $login_data["rememberMe"] : NULL;

    // Validate username and password
    $username_val_assoc = validate_username_for_login($username);
    $password_val_assoc = validate_password($password);

    // Return early error response in case username is invalid
    if (array_key_exists("error", $username_val_assoc))
    {
        return send_json_error_response($username_val_assoc, 400);
    }

    // Return early error response in case password is invalid
    if (array_key_exists("error", $password_val_assoc))
    {
        return send_json_error_response($password_val_assoc, 400);
    }

    // Perform a login attempt
    $login_assoc = login_user_to_db($username, $password);

    // Add remember me key to login assoc
    if ($rememberMe != NULL)
    {
        $login_assoc["rememberMe"] = $rememberMe;
    }

    /** Include Code for Cookies Later On */

    // Return the result
    if (array_key_exists("error", $login_assoc))
    {
        return send_json_error_response($login_assoc, 400);
    }

    else
    {
        return send_json_response($login_assoc);
    }
}

function validate_username_for_login($username)
{
    // Run check against username regex
    $usernameRegex = "/^[A-Za-z\s.,:;0-9]+$/";

    // If empty, return it can't be empty
    if (empty($username))
    {
        return ["error" => "username cannot be empty"];
    }

    // If it contains especial symbols, reject early
    elseif (!preg_match($usernameRegex, $username))
    {
        return ["error" => "username cannot contain special symbols"];
    }

    // All checks were passed by this point
    else
    {
        return ["success" => ""];
    }
}

?>