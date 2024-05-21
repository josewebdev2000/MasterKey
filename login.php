<?php require_once "templates/header.php"; ?>
<?php

// Detect Post Request
require_once __DIR__ . "/helpers/index.php";

$websiteURL = getWebsiteUrl();

if (isset($_SESSION["id"]))
{
    header("Location: $websiteURL");
}

if (is_post_request())
{
    $user_id = $_POST["user-id"];
    $rememberMe = $_POST["rememberMe"];
    
    // Initialize a new session and go to dashboard if the given id is in the db
    if (is_id_in_db($user_id))
    {
        $_SESSION["id"] = $user_id;

        // If the user wants to be remembered, create a cookie for him/her
        if ($rememberMe)
        {
            create_user_cookie($user_id, $cookieEncryptionMethod, $cookieEncryptionKey);
        }

        // Redirect the user to the dashboard page
        header("Location: $websiteURL/dashboard/index.php");
    }
}

?>
<?php require_once "templates/main-header.php"; ?>

<main class="container-fluid bg-img-container bg-golden-key-img bg-img-light-orange-hue flex-065">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mt-3 mb-4">Login</h2>
        </div>
    </div>

    <div class="row">
        <!--Introductory Section-->
        <div class="col-12 mb-4 d-flex justify-content-center">
            <section class="text-center p-3 hero rborder-25 dark-peach-hero-2">
                <p class="lead fsize-150">Welcome back</p>
                <p class="lead fsize-150">We're glad to have you back</p>
                <p class="lead fsize-150">Enter your credentials and pick up where you left off</p>
            </section>
        </div>

        <!--Register Form Container-->
        <div id="login-form-container" class="col-12 d-flex justify-content-center mb-4">
            <form class="hero rborder-25 dark-peach-hero-2 p-5" id="login-form" novalidate>
                <div class="row">
                    <div class="col-12">
                        <img class="d-block mx-auto mb-4 img-fluid" id="key-person-pic" src="assets/img/key-person.png" alt="Key Person Image">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input class="form-control form-control-lg text-center" type="text" name="username" id="username" placeholder="Username">
                            <div class="valid-tooltip username">Username looks good</div>
                            <div class="invalid-tooltip username"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control form-control-lg text-center">
                            <div class="valid-tooltip password">Password looks good</div>
                            <div class="invalid-tooltip password"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" name="send" id="send" class="btn btn-block btn-lg btn-primary">Send</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" name="rememberMe" class="form-check-input" id="rememberMeCheck">
                            <label for="rememberMeCheck" class="form-check-label">Remember Me</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col" id="form-alerts-container">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="token-modal-container">
        
    </div>

    <div id="hidden-elements" class="d-none">
        <form action="login.php" method="POST">
            <input type="number" name="user-id">
            <input type="checkbox" name="rememberMe">
            <input type="submit" name="token-submit" value="submit">
        </form>
    </div>

</main>

<?php require_once "templates/main-footer.php"; ?>
<?php require_once "templates/footer.php";?>