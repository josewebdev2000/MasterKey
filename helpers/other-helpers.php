<?php 
/** PHP Reusable code of no specify category */
function is_valid_id_param($id_param)
{
    // Return true if the given id parameter is valid
    return isset($id_param) && is_numeric($id_param);
}

function delete_file($file_path)
{
    // Delete a file
    if (file_exists($file_path))
    {
        if (unlink($file_path))
        {
            return true;
        }
    }

    return false;
}

function has_exact_keys($assoc_arr, $expected_keys)
{
    // Return true if the assoc array has the expected arrays
    // Get the keys of the array
    $array_keys = array_keys($assoc_arr);

    // Sort both arrays to ensure order doesn't matter
    sort($array_keys);
    sort($expected_keys);

    // Compare the sorted arrays
    return $array_keys === $expected_keys;
}

function hash_password($password)
{
    // Return password hash
    return password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
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