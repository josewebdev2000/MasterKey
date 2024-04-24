<?php require_once "templates/header.php"; ?>
<?php require_once "templates/main-header.php"; ?>

<main class="container-fluid bg-img-container bg-golden-key-img bg-img-light-orange-hue flex-065">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mt-3 mb-4">Register</h2>
        </div>
    </div>

    <div class="row">
        <!--Introductory Section-->
        <div class="col-12 mb-4 d-flex justify-content-center">
            <section class="text-center p-3 hero rborder-25 dark-peach-hero-2">
                <p class="lead fsize-150">Create a new <em><b>MasterKey</b></em> account</p>
                <p class="lead fsize-150">Start securing your credentials with us</p>
                <p class="lead fsize-150">You won't have to worry about remembering passwords anymore</p>
            </section>
        </div>
    </div>

    <div class="row">
        <!--Register Form Container-->
        <div id="register-form-container" class="col-12 d-flex justify-content-center mb-4">
            <form class="hero rborder-25 dark-peach-hero-2 p-5 hide-fader" id="register-form" novalidate>
                <div class="row">
                    <div class="col-12">
                        <img class="d-block mx-auto mb-4 img-fluid" id="key-person-pic" src="assets/img/key-person.png" alt="Key Person Image">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group input-group">
                            <input class="form-control form-control-lg text-center" type="text" name="username" id="username" placeholder="Username">
                            <div class="valid-tooltip username">Username looks good</div>
                            <div class="invalid-tooltip username"></div>
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
                            <input type="checkbox" name="about" class="form-check-input" id="aboutCheck">
                            <label for="aboutCheck" class="form-check-label">I learnt how <em><b>MasterKey</b></em> works through the <a href="about.php">about</a> page</label>
                            <div class="valid-tooltip aboutCheck">Awesome, you are in the know of <em><b>MasterKey</b>!</em></div>
                            <div class="invalid-tooltip aboutCheck">Would you really create an account of something you don't know of?</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-check">
                            <input type="checkbox" name="privacy" class="form-check-input" id="privacyCheck">
                            <label class="form-check-label" for="privacyCheck">I read and agreed with the <em><b>MasterKey</b></em> <a href="privacy.php">privacy</a> statement</label>
                            <div class="valid-tooltip privacyCheck">Great, you recognized you know your rights and duties!</div>
                            <div class="invalid-tooltip privacyCheck">Would you dare give your data away without privacy concerns?</div>
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

    <div id="creds-shower" class="d-none flex-column justify-content-center show-fader">
        <div class="row hero">
            <div class="col-12 p-4 mb-4 text-center rborder-25 dark-peach-hero-2">
                <img class="d-block mx-auto mb-4 img-fluid" id="key-person-pic" src="assets/img/key-person.png" alt="Key Person Image">
                <h2 id="user-congratulate"></h2>
                <h4><a class="link-primary" href="login.php">Login</a> to your account</h4>
                <h5 class="text-danger"><b>You will be shown this information only once</b></h5>
            </div>
        </div>
        <div class="row hero d-flex justify-content-around">
            <div class="col-md-5 col-12 hero p-4 mb-4 text-center rborder-25 dark-peach-hero-2">
                <h4>Username</h4>
                <h5><b id="show-username">{{username}}</b></h5>
                <h4>Password</h4>
                <h5><b id="show-password">{{password}}</b></h5>
            </div>
            <div class="col-md-5 col-12 hero p-4 mb-4 text-center rborder-25 dark-peach-hero-2">
                <h4>Token File</h4>
                <div class="mt-4 d-flex flex-column justify-content-center align-items-center">
                    <a id="token-file-link" class="btn btn-primary btn-lg" href="" download>Download Token File</a>
                </div>
            </div>
        </div>
    </div>

</main>

<?php require_once "templates/main-footer.php"; ?>
<?php require_once "templates/footer.php";?>