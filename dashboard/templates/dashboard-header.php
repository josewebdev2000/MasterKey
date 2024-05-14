<?php
    require_once __DIR__ . "/../../helpers/index.php";
    // Check the session id is set and it is valid
    $id = $_SESSION["id"];

    // Redirect to main page if user id session isn't set well
    if (!(isset($id) && is_id_in_db($id)))
    {
        $websiteURL = getWebsiteUrl();
        header("Location: $websiteURL/index.php");
    }

?>