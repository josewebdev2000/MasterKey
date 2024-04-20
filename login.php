<?php require_once "templates/header.php"; ?>
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
        <div id="register-form-container" class="col-12 d-flex justify-content-center mb-4">
            <form class="hero rborder-25 dark-peach-hero-2 p-5" id="register-form" novalidate>
                <img class="d-block mx-auto mb-4 img-fluid" id="key-person-pic" src="assets/img/key-person.png" alt="Key Person Image">
                <div class="form-group">
                    <input class="form-control form-control-lg text-center" type="text" name="username" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control form-control-lg text-center">
                </div>
                <div class="form-group">
                    <button type="submit" name="send" id="send" class="btn btn-block btn-lg btn-primary">Send</button>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="rememberMe" class="form-check-input" id="rememberMeCheck">
                    <label for="rememberMeCheck" class="form-check-label">Remember Me</label>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once "templates/main-footer.php"; ?>
<?php require_once "templates/footer.php";?>