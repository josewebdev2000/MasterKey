<?php require_once __DIR__ . "/../helpers/index.php";
require_once __DIR__ . "/../envs.php";

// Start sessions out
session_start();

// Load environs
loadEnvVarsWhenRequired();

// Set up cookie encryption method
$cookieEncryptionMethod = $_ENV["COOKIE_ENC_METHOD"];

// Generate a cookie encryption key
$cookieEncryptionKey = $_ENV["COOKIE_ENC_KEY"];

$websiteURL = getWebsiteUrl();

// Check if user cookie is set, if it is, set a user session
if (isset($_COOKIE["user-id"]) && !isset($_SESSION["id"]))
{
    // Check it is a number
    $cookie_user_id = get_decrypted_cookie_value(
        $cookieEncryptionMethod, 
        $cookieEncryptionKey, 
        $_COOKIE["user-id"]
    );

    if (is_valid_id_param($cookie_user_id))
    {
        $_SESSION["id"] = $cookie_user_id;
    }
}

if (isset($_SESSION["id"]))
{
    $user = get_user_by_id($_SESSION["id"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MasterKey</title>

    <!--Favicon-->
    <link rel="shortcut icon" href="<?=$websiteURL?>/favicon.ico" type="image/x-icon">

    <!--Dependency Stylesheets-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="<?=$websiteURL?>/assets/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="<?=$websiteURL?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="<?=$websiteURL?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="<?=$websiteURL?>/assets/plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="<?=$websiteURL?>/assets/dist/css/adminlte.min.css?v=3.2.0">

    <link rel="stylesheet" href="<?=$websiteURL?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="<?=$websiteURL?>/assets/plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="<?=$websiteURL?>/assets/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="<?=$websiteURL?>/assets/plugins/cookiealert/cookiealert.css">

    <!--Custom Stylesheets-->
    <link rel="stylesheet" href="<?=$websiteURL?>/assets/css/style.css">

    <!--Dependency Scripts-->
    <script src="<?=$websiteURL?>/assets/plugins/jquery/jquery.min.js"></script>

    <script src="<?=$websiteURL?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="<?=$websiteURL?>/assets/plugins/jquery-validation/jquery.validate.min.js"></script>

    <script src="<?=$websiteURL?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?=$websiteURL?>/assets/plugins/chart.js/Chart.min.js"></script>

    <!--script src="assets/plugins/sparklines/sparkline.js"></script-->

    <script src="<?=$websiteURL?>/assets/plugins/jqvmap/jquery.vmap.min.js"></script>

    <script src="<?=$websiteURL?>/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="<?=$websiteURL?>/assets/plugins/jquery-knob/jquery.knob.min.js"></script>

    <script src="<?=$websiteURL?>/assets/plugins/moment/moment.min.js"></script>

    <script src="<?=$websiteURL?>/assets/plugins/daterangepicker/daterangepicker.js"></script>

    <script src="<?=$websiteURL?>/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="<?=$websiteURL?>/assets/plugins/summernote/summernote-bs4.min.js"></script>

    <script src="<?=$websiteURL?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        
</head>
<body>