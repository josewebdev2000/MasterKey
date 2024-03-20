<?php 
require_once "../helpers/index.php"; 
require_once "../envs.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
/** Handle POST Request for Contact Page */

if (is_post_request())
{
    // Grab Data that comes from JSON
    $contact_data = get_json_request();
    send_json_response($contact_data);

    // Validate Contact data
    $validation_assoc = validate_contact_data($contact_data);

    // Try to send Email
    if (array_key_exists("success", $validation_assoc))
    {
        // Load envs when required
        loadEnvVarsWhenRequired();
    }

    // Send Early JSON HTTP Response
    else
    {
        send_json_error_response($validation_assoc, 400);
    }

}

function validate_contact_data($contact_assoc)
{
    /** Validate Received Contact Data */
    
    // First, check all expected JSON fields are set
    $expected_fields = ["name", "email", "subject", "urgency", "request"];

    // Check that none of the field values is empty
    foreach ($expected_fields as $field)
    {
        // Return error if one of the fields is not set
        if (!array_key_exists($field, $contact_assoc))
        {
            return ["error" => "$field is not set"];
        }

        // Return an error if one of the fields is empty
        if (empty($contact_assoc[$field]))
        {
            return ["error" => "$field has no value"];
        }
    }

    // Now grab each field value and run a check for each
    $name = $contact_assoc["name"];
    $email = $contact_assoc["email"];
    $subject = $contact_assoc["subject"];
    $urgency = $contact_assoc["urgency"];
    $request = $contact_assoc["request"];

    // Run checks for name regex
    $nameRegex = "/^[A-Za-z\s.,:;]+$/";

    if (!preg_match($nameRegex ,$name)) 
    {
        return ["error" => "Name can only contain letters and white space allowed"];
    }

    // Run checks for email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        return ["error" => "Invalid Email Address was provided"];
    }

    // By this point, return a success assoc
    return ["success" => ""];
}

?>