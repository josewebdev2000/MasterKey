<?php require_once "../helpers/index.php"; 
/** Handle POST Request for Contact Page */

if (is_post_request())
{
    $contact_data = get_json_request();
    var_dump($contact_data);
}

?>