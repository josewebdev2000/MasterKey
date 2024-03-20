    
    <!--Dependency Scripts-->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>

    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/plugins/chart.js/Chart.min.js"></script>

    <!--script src="assets/plugins/sparklines/sparkline.js"></script-->

    <script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>

    <script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>

    <script src="assets/plugins/moment/moment.min.js"></script>

    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>

    <script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>

    <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <script src="assets/dist/js/adminlte.js?v=3.2.0"></script>

    <!--script src="assets/dist/js/pages/dashboard.js"></script-->

    <!--Custom Scripts-->

    <!--JS Constants-->
    <script src="assets/js/constants.js"></script>

    <!--JS Snippets-->
    <script src="assets/js/snippets/alerts/error.js"></script>
    <script src="assets/js/snippets/alerts/success.js"></script>

    <!--JS Classes-->
    <script src="assets/js/oop/ScrollToTopBtn.js"></script>
    <script src="assets/js/oop/CSSInteractor.js"></script>

    <!--Page Scripts-->
    <script src="assets/js/index.js"></script>

    <?php require_once "helpers/index.php";

        // Grab the name of the current page
        $currentPage = getActualPageName();

        // Dynamically Load Content For Each Page
        switch ($currentPage)
        {
            case "contact.php":
            {
                echo '<script src="assets/js/contact.js"></script>';
                break;
            }

            case "privacy.php":
            {
                echo '<script src="assets/js/privacy.js"></script>';
                break;
            }
        }
        
    ?>
</body>
</html>