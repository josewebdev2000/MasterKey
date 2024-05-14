<?php require_once __DIR__ . "/../helpers/index.php";
$websiteURL = getWebsiteUrl();

// Get the username of the current user
if (isset($_SESSION["id"]))
{
    $username = get_user_by_id($_SESSION["id"])["username"];
}
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/key.png" width="30" height="30" class="d-inline-block align-top mr-2" alt="Navbar Brand Image">
            MasterKey
         </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content-collapse" aria-controls="navbar-content-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-content-collapse">
            <ul class="navbar-nav ml-auto mr-auto mt-2 mt-lg-0 text-center">
                <li class="nav-item">
                    <a class="nav-link h5" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link h5" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link h5" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link h5" href="privacy.php">Privacy</a>
                </li>
            </ul>
            <!--In Case $_SESSION["id"] is not set, then display login and register button-->
            <?php if (isset($_SESSION["id"])): ?>
                <!--Change this code later on-->
                <div class="d-flex flex-lg-row flex-column align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-circle img-fluid" width="64" src="<?=$websiteURL?>/assets/img/avatars/avatar-11.png" alt="Stuff">
                        </button>
                        <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                            <h6 class="dropdown-header fsize-150 text-white"><?=$username;?></h6>
                            <a class="dropdown-item user fsize-120" href="<?=$websiteURL?>/dashboard/">Dashboard</a>
                            <a class="dropdown-item user fsize-120" href="<?=$websiteURL?>/dashboard/account.php">Accounts</a>
                            <a class="dropdown-item user fsize-120" href="<?=$websiteURL?>/dashboard/profile.php">Profile</a>
                            <a class="dropdown-item user fsize-120" href="<?=$websiteURL?>/dashboard/settings.php">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item logout fsize-120" href="<?=$websiteURL?>/dashboard/logout.php">Log out</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div id="auth-btn-group" class="btn-group d-flex flex-lg-row flex-column align-items-center" role="group" aria-label="Auth Links">
                    <a class="btn btn-info btn-lg" href="login.php">Login</a>
                    <a class="btn btn-primary btn-lg" href="register.php">Register</a>
                </div>
            <!--In Case $_SESSION["id"] is set, then display circle with user profile with links to go back to dashboard and other options-->
            <?php endif; ?>
        </div>
    </nav>
</header>