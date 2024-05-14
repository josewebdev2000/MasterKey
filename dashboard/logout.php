<?php require_once "../templates/header.php"; ?>
<?php require_once "templates/dashboard-header.php"; ?>
<?php require_once "../helpers/index.php";

// Grab website URL
$websiteURL = getWebsiteUrl();

if (isset($_SERVER["HTTP_REFERER"]) && isset($_SESSION["id"]))
{
    // Destroy the current session
    session_destroy();

    // Destroy the cookie attached to this session if it's there
    delete_user_cookie();
}

header("Location: $websiteURL");
?>