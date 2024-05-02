<?php
/** Back-End Route to Check Token File From a user */
// Set error reporting level
error_reporting(E_ALL);

// Enable displaying errors
ini_set("display_errors", 1);

require_once "../helpers/index.php";

if (is_post_request())
{
    // Grab the token data from the frontend
    $token_data = get_json_request();

    // Validate the data received from the frontend
    $validation_assoc = validate_token_data($token_data);

    if (array_key_exists("error", $validation_assoc))
    {
        return send_json_error_response($validation_assoc, 400);
    }

    // Grab Data from JSON
    $encoded_content = $token_data["encoded_content"];
    $user_id = $token_data["user_id"];

    // Decode base-64 string
    $tokenFileContent = base64_decode($encoded_content);

    // Extract tokens
    $tokens = extract_tokens($tokenFileContent);

    // Send the tokens to be evaluated by the database
    $correct_tokens = are_user_tokens_correct($user_id, $tokens);

    if ($correct_tokens)
    {
        return send_json_response([
            "message" => "Correct Tokens"
        ]);
    }

    else
    {
        return send_json_error_response(["error" => "Incorrect Tokens"], 400);
    }
    

}

function extract_tokens($decodedTokenFileContent)
{
    // Initialize tokens array
    $tokens = [];

    // First separate by newline character
    $lines = explode("\n", $decodedTokenFileContent);

    // Loop through two lines
    for ($lineNum = 0; $lineNum < 2; $lineNum++)
    {
        $token = explode(":", $lines[$lineNum])[1];
        $tokenKeyName = $lineNum + 1;
        $tokens["token$tokenKeyName"] = trim($token);
    }

    return $tokens;

}

function validate_token_data($token_data)
{
    // Grab the encoded content
    $encoded_content = isset($token_data["encoded_content"]) ? $token_data["encoded_content"] : NULL;
    $user_id = isset($token_data["user_id"]) ? $token_data["user_id"] : NULL;

    // Decode base-64 string
    $tokenFileContent = base64_decode($encoded_content);

    $decoded_token_pattern = '/^Token 1: [a-f0-9]{32}\nToken 2: [a-f0-9]{32}$/';

    if (!preg_match($decoded_token_pattern, $tokenFileContent))
    {
        return ["error" => "Tokens were not provided"];
    }

    $tokens = extract_tokens($tokenFileContent);

    // If tokens could not be extracted, return error response
    if (!isset($tokens["token1"]) || !isset($tokens["token2"]))
    {
        return ["error" => "Could not extract tokens from given file"];
    }

    if ($encoded_content == NULL)
    {
        return ["error" => "Token File were not submitted"];
    }

    if (!is_string($encoded_content))
    {
        return ["error" => "Token File must be encoded in base64"];
    }

    if ($user_id == NULL)
    {
        return ["error" => "User ID was not specified"];
    }

    if (!is_numeric($user_id) || $user_id < 1)
    {
        return ["error" => "User ID must be a whole positive number"];
    }

    // All checks passed by this point
    return ["success" => ""];
}

?>