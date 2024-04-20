<?php
// Set error reporting level
error_reporting(E_ALL);

// Enable displaying errors
ini_set('display_errors', 1);

require_once "../helpers/index.php";

/** Handle POST Request for Register Page */

if (is_post_request())
{
    // Grab the register data of the user
    $register_data = get_json_request();

    $username = isset($register_data["username"]) ? $register_data["username"] : "";

    // Validate the username
    $validation_assoc = validate_username_for_register($username);

    if (array_key_exists("success", $validation_assoc))
    {
        // Generate a new password for the user
        $new_password = generate_new_password();

        // Create new tokens for the new user
        $tokens = generate_new_tokens();

        // Generate new tokens for the user
        $token_file_path = generate_new_token_file($tokens);

        // Encode file content in base64 to send as JSON
        $encoded_token_content = encode_token_file_in_base64($token_file_path);

        // Delete tmp file one it's been encoded
        delete_file($token_file_path);

        // Register the new user in the db
        $new_user_assoc = insert_new_user_into_db($username, $new_password, $tokens[0], $tokens[1]);

        // If everything went well. Return the username from the to the user
        if (array_key_exists("error", $new_user_assoc))
        {
            return send_json_error_response($new_user_assoc, 500);
        }

        else
        {
            $new_user_assoc["token_file_base64"] = $encoded_token_content;
            return send_json_response($new_user_assoc);
        }
    }

    else
    {
        // Send a JSON error response
        return send_json_error_response($validation_assoc, 400);
    }

}

function validate_username_for_register($username)
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

    // If it is already in the database, reject as well
    elseif (is_username_in_db($username))
    {
        return ["error" => "\"$username\" is already taken"];
    }

    // All checks were passed by this point
    else
    {
        return ["success" => ""];
    }
}

function generate_new_password() 
{

    // Define the character set for the password
    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    // Initialize the password
    $password = '';

    // Generate the password
    while (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{12,}$/', $password)) 
    {
        $password = '';

        // Generate random characters from the character set
        for ($i = 0; $i < 12; $i++) 
        {
            $password .= $charset[random_int(0, strlen($charset) - 1)];
        }
    }

    return $password;
}

function generate_new_tokens()
{

    // Generate a secure token (32 bytes)
    $token1 = bin2hex(random_bytes(16));

    // Generate another secure token (32 bytes)
    $token2 = bin2hex(random_bytes(16));

    return [$token1, $token2];
}

function generate_new_token_file($tokens)
{
    // Store the new tokens in a tmp folder
    $token1 = $tokens[0];
    $token2 = $tokens[1];

    // Have the content for the new token file
    $token_file_content = "Token 1: $token1\nToken 2: $token2\n";

    // Produce unique file name
    $token_id = uniqid('', true);

    // Generate file name
    $token_name = "../tmp/token_files/tokens-$token_id.txt";

    // Open new file stream
    $token_file = fopen($token_name,"w");

    // Try to write file
    if ($token_file !== false)
    {
        // Write file
        if (fwrite($token_file, $token_file_content))
        {
            // Close file
            fclose($token_file);
        }
    }

    return $token_name;
}

function encode_token_file_in_base64($tokenFileName)
{
    $encoded_file_content = "";

    // Read contents of file
    $file_content = file_get_contents($tokenFileName);

    // Encode the content in base 64
    $encoded_file_content = base64_encode($file_content);

    return $encoded_file_content;
}

?>