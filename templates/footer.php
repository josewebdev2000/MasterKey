<?php require_once __DIR__ . "/../helpers/index.php";

$websiteURL = getWebsiteUrl();

?>    
    <script src="<?=$websiteURL?>/assets/dist/js/adminlte.js?v=3.2.0"></script>

    <!--script src="assets/dist/js/pages/dashboard.js"></script-->

    <!--Custom Scripts-->

    <!--JS Constants-->
    <script src="<?=$websiteURL?>/assets/js/constants.js"></script>

    <!--JS Helpers-->
    <script src="<?=$websiteURL?>/assets/js/helpers.js"></script>

    <!--JS Snippets-->
    <script src="<?=$websiteURL?>/assets/js/snippets/alerts/error.js"></script>
    <script src="<?=$websiteURL?>/assets/js/snippets/alerts/success.js"></script>
    <script src="<?=$websiteURL?>/assets/js/snippets/spinners/loading.js"></script>

    <!--JS Classes-->
    <script src="<?=$websiteURL?>/assets/js/oop/ScrollToTopBtn.js"></script>
    <script src="<?=$websiteURL?>/assets/js/oop/BtnGroupResponsive.js"></script>
    <script src="<?=$websiteURL?>/assets/js/oop/TokenModal.js"></script>

    <!--Page Scripts-->
    <script src="<?=$websiteURL?>/assets/js/index.js"></script>

    <?php require_once __DIR__ . "/../helpers/index.php";

        // Grab the name of the current page
        $currentPage = getActualPageName();

        // Dynamically Load Content For Each Page
        switch ($currentPage)
        {
            case "contact.php":
            {
                echo "<script src='$websiteURL/assets/js/contact.js'></script>";
                break;
            }

            case "privacy.php":
            {
                echo "<script src='$websiteURL/assets/js/privacy.js'></script>";
                break;
            }

            case "register.php":
            {
                echo "<script src='$websiteURL/assets/js/register.js'></script>";
                break;
            }

            case "login.php":
            {
                echo "<script src='$websiteURL/assets/js/login.js'></script>";
                break;
            }
        }
        
    ?>
</body>
</html>