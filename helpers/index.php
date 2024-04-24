<?php 
require_once "api-helpers.php";
require_once "http-helpers.php";
require_once "db-helpers.php";
require_once "json-helpers.php";
require_once "page-helpers.php";
require_once "other-helpers.php";

function encode_token_file_in_base64($tokenFileName)
{
    $encoded_file_content = "";

    // Read contents of file
    $file_content = file_get_contents($tokenFileName);

    // Encode the content in base 64
    $encoded_file_content = base64_encode($file_content);

    return $encoded_file_content;
}

function generate_new_password() 
{

    // Define the character set for the password
    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    // Initialize the password
    $password = '';

    // Generate the password
    while (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) 
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

function validate_password($password)
{
    // Run checks against password regex
    $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/";

    // If empty, return it can't be empty
    if (empty($password))
    {
        return ["error" => "password cannot be empty"];
    }

    // Check regex works out
    elseif (!preg_match($passwordRegex, $password))
    {
        return ["error" => "password must have at least one lowecase letter, one uppercase letter, one digit, eight characters, and no special symbols"];
    }

    // Return valid password
    else
    {
        return ["success" => ""];
    }
}

?>