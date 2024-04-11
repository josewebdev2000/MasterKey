<?php 
// Set error reporting level
error_reporting(E_ALL);

// Enable displaying errors
ini_set('display_errors', 1);

require_once "../helpers/index.php"; 
require_once "../envs.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';

loadEnvVarsWhenRequired();

/** Handle POST Request for Contact Page */

if (is_post_request())
{
    // Grab Data that comes from JSON
    $contact_data = get_json_request();

    /** Data is Grabbed Without Hanging */

    // Validate Contact data
    $validation_assoc = validate_contact_data($contact_data);

    /** Validation Runs Without Hanging */

    // Try to send Email
    if (array_key_exists("success", $validation_assoc))
    {
        // Send no reply email and admin message email
        /** Scripts HANGS AROUND HERE
         * RESEARCH SEND_HTML_EMAIL FUNCTION and OTHERS
         */
        // Replace the user's HTML with HTML that has URLS to imgs
        $contact_data["request"] = replace_base64_with_urls($contact_data["request"]);
        $no_reply_result = send_html_email($contact_data, "build_no_reply_email_for_user");
        $admin_message_result = send_html_email($contact_data, "build_admin_email_notice");

        if (array_key_exists("success", $no_reply_result) && array_key_exists("success", $admin_message_result))
        {
            return send_json_response($admin_message_result);
        }

        else
        {
            return send_json_error_response($no_reply_result, 500);
        }
    }

    // Send Early JSON HTTP Response
    else
    {
        return send_json_error_response($validation_assoc, 400);
    }

}

function replace_base64_with_urls($htmlSnippet)
{
    /** Replace Base 64 Image Sources with URLS from the API */

    // Parse the HTML content
    $dom = new DOMDocument();
    $dom->loadHTML($htmlSnippet, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    // Iterate through all <img> tags
    $images = $dom->getElementsByTagName('img');
    foreach ($images as $image) 
    {
        // Get the src attribute
        $src = $image->getAttribute('src');
        
        // Check if the src is a base-64 encoded image
        if (strpos($src, 'data:image') === 0) 
        {
            // Replace the src attribute with the URL returned by the API
            /*$api_res_assoc = request_to_upload_img_base_64_src_online($_ENV["API_KEY_PY_PIC"], $src, "pic");
            
            if (isset($api_res_assoc["img_url"]))
            {
                $image->setAttribute('src', $api_res_assoc["img_url"]);
            }
            */

            // Initialize Cloudinary for the Image API to use it
            $cloudinary = init_cloudinary(
                $_ENV["API_CLOUDINARY_CLOUD_NAME"], 
                $_ENV["API_CLOUDINARY_API_KEY"], 
                $_ENV["API_CLOUDINARY_API_SECRET"]
            );

            // Upload the Image to Cloudinary to get the URL of the image to be sent
            // Generate a Unique ID for each image
            $img_url = upload_base64_to_cloudinary($cloudinary, $src, uniqid('', true))["secure_url"];

            // Grab the image url from the response
            $image->setAttribute("src", $img_url);
        }
    }

    // Save the modified HTML
    $modifiedHtml = $dom->saveHTML();

    return $modifiedHtml;
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

function build_no_reply_email_for_user($email_assoc)
{
    /** Function to build automatic email user will get as soon as he sent an email to contact page
     * Return an assoc with the following elements
     * htmlMessage: HTML String representing the email content to be sent,
     * sender: Email Address of the sender of this email
     * senderPass: Password for sender
     * recipient: Email Address of the recipient of this email
     */

     // Make a switch statement for the days value and Bootstrap class for urgency status
     $days = null;
     $color = null;

     switch (strtolower($email_assoc["urgency"]))
     {
        case "high":
        {
            $days = 7;
            $color = "red";
            break;   
        }

        case "medium":
        {
            $days = 4;
            $color = "yellow";
            break;
        }

        default:
        {
            $days = 2;
            $color = "green";
        }
     }

     // Prepare Urgency Span the template will contain
     $urgency_span = "<span style='color: $color'>". strtoupper($email_assoc["urgency"]) ."</span>";

     // Grab the HTML email template for no reply
     $no_reply_template_string = file_get_contents("../email-templates/no-reply.html");

     /** Script Hangs Around Here */
     //return send_json_response($email_assoc);

     // Replace placeholders for actual data
     $no_reply_template_string = str_replace("{{NAME}}", $email_assoc["name"], $no_reply_template_string);
     $no_reply_template_string = str_replace("{{URGENCY}}", $urgency_span, $no_reply_template_string);
     $no_reply_template_string = str_replace("{{DAYS}}", $days, $no_reply_template_string);
     $no_reply_template_string = str_replace("{{EMAIL}}", $email_assoc["email"], $no_reply_template_string);

     $result_assoc = [
        "htmlMessage" => $no_reply_template_string,
        "host" => $_ENV["SMTP_HOST"],
        "from" => "No Reply MasterKey Email Sender",
        "subject" => $email_assoc["subject"],
        "sender" => $_ENV["SMTP_NO_REPLY_USER"],
        "senderPass" => $_ENV["SMTP_NO_REPLY_PASS"],
        "recipient" => $email_assoc["email"]
     ];

     return $result_assoc;

}

function build_admin_email_notice($email_assoc)
{
    /** Function to build automatic email admin will receive as soon as a user sends an email
     * Return an assoc with the following elements
     * htmlMessage: HTML String representing the email content to be sent,
     * sender: Email Address of the sender of this email
     * senderPass: Password for sender
     * received: Email Address of the recipient of this email
     */
    // Make a switch statement for the days value and Bootstrap class for urgency status
    $color = null;

    switch (strtolower($email_assoc["urgency"]))
    {
        case "high":
            {
                $color = "red";
                break;   
            }

            case "medium":
            {
                $color = "yellow";
                break;
            }

            default:
            {
                $color = "green";
            }
    }

    // Prepare Urgency Span the template will contain
    $urgency_span = "<span style='color: $color'>". strtoupper($email_assoc["urgency"]) ."</span>";

    // Grab Admin Message HTML Message
    $admin_message_template_string = file_get_contents("../email-templates/admin-message.html");

    // Replace Placeholders for actual data
    $admin_message_template_string = str_replace("{{NAME}}", $email_assoc["name"], $admin_message_template_string);
    $admin_message_template_string = str_replace("{{URGENT}}", $urgency_span, $admin_message_template_string);
    $admin_message_template_string = str_replace("{{MESSAGE}}", $email_assoc["request"], $admin_message_template_string);
    $admin_message_template_string = str_replace("{{EMAIL}}", $email_assoc["email"], $admin_message_template_string);

    $result_assoc = [
        "htmlMessage" => $admin_message_template_string,
        "host" => $_ENV["SMTP_HOST"],
        "from" => "No Reply MasterKey Email Sender",
        "subject" => $email_assoc["name"] . " sent a query of " . $email_assoc["urgency"] . " urgency",
        "sender" => $_ENV["SMTP_NO_REPLY_USER"],
        "senderPass" => $_ENV["SMTP_NO_REPLY_PASS"],
        "recipient" => $_ENV["SMTP_ADMIN_USER"]
     ];

    return $result_assoc;
}

function send_html_email($email_assoc, $email_template_building_function)
{
    /** Send an Email with an HTML Template */

    // Call the email template building function
    $building_response_assoc = call_user_func($email_template_building_function ,$email_assoc);

    // Generate a new instance of PHP Mailer
    $mailer = new PHPMailer(true);

    try
    {
        // Configure creds according to the assoc gotten from the template building function
        $mailer->SMTPDebug = 0;
        $mailer->isSMTP();
        $mailer->isHTML(true);
        $mailer->SMTPAuth = true;
        $mailer->Host = $building_response_assoc["host"];
        $mailer->Username = $building_response_assoc["sender"];
        $mailer->Password = $building_response_assoc["senderPass"];
        // $mailer->SMTPSecure = 'tls'; // Use TLS encryption
        $mailer->Port = 587;

        // Set the email of the sender as the SMTP email
        $mailer->setFrom($building_response_assoc["sender"], $building_response_assoc['from']);
        $mailer->addAddress($building_response_assoc['recipient']);
        $mailer->Subject = $building_response_assoc['subject'];
        $mailer->Body = $building_response_assoc['htmlMessage'];

        // return var_dump($mailer->Username);

        // Set a timeout for the send operation
        $timeout_seconds = 30; // Adjust as needed
        $mailer->Timeout = $timeout_seconds;

        // Send the email
        if (!$mailer->send()) 
        {
            throw new Exception('Failed to send email: ' . $mailer->ErrorInfo);
        }
    }

    catch (Exception $e)
    {
        return ["error" => $e->getMessage()];
    }

    return ["success" => "Email could be successfully sent"];
}

?>