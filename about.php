<?php require_once "templates/header.php"; ?>
<?php require_once "templates/main-header.php"; ?>

<main class="container-fluid bg-img-container bg-circular-lock-img bg-img-greenish-hue flex-065">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mt-3 mb-4">About <em><b>MasterKey</b></em></h2>
        </div>
    </div>

    <div class="row">
        <!-- Overview Section -->
        <div class="col-md-12 mb-4 d-flex justify-content-center">
            <section class="text-center p-3 hero rborder-25 dark-green-hero">
                <h3>Overview</h3>
                <p class="lead fsize-120"><em><b>MasterKey</b></em> is a modern password manager that does not require your email or phone number to authenticate.</p>
                <p class="lead fsize-120">You will receive a text with two tokens to verify your account upon sign up.</p>
                <p class="lead fsize-120">With both tokens you can verify your account and change your master credentials</p>
            </section>
        </div>

        <!-- Features Section -->
        <div class="col-lg-6 col-12 mb-4">
            <section class="rborder-25 dark-green-hero">
                <h3 class="text-center">Key Features</h3>
                <ul class="p-3 row list-unstyled">
                    <!-- Feature 1 -->
                    <li class="col-md-6 col-12 hover-blue trans-color-03 media mb-3">
                        <i class="fas fa-lock fa-2x mr-3"></i>
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">Effortless Password Management</h5>
                            <p>We'll provide you a master password for your account</p>
                        </div>
                    </li>

                    <!--Feature 2-->
                    <li class="col-md-6 col-12 hover-blue trans-color-03 media mb-3">
                        <i class="fas fa-key fa-2x mr-3"></i>
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">Token-Based Verification</h5>
                            <p>We'll provide you two tokens you'l need to verify any relevant action</p>
                        </div>
                    </li>

                    <!-- Feature 3 -->
                    <li class="col-md-6 col-12 hover-blue trans-color-03 media mb-3">
                        <i class="fas fa-shield-alt fa-2x mr-3"></i>
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">Advanced Security Measures</h5>
                            <p>We'll ensure no one else but you will be able to handle your account and your data</p>
                        </div>
                    </li>
                    <!--Feature 4-->
                    <li class="col-md-6 col-12 hover-blue trans-color-03 media mb-3">
                        <i class="fas fa-dumbbell fa-2x mr-3"></i>
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">Password Strength Analysis</h5>
                            <p>We'll provide you a strength analysis based on length, character variance, and leaked passwords data</p>
                        </div>
                    </li>
                </ul>
            </section>
        </div>

        <!-- FAQs Section -->
        <div class="col-lg-6 col-12 mb-4">
            <section class="w-100 p-3 hero text-center rborder-25 dark-green-hero">
                <h3>Frequently Asked Questions</h3>
                <div class="p-3" id="accordion">
                    <div class="card dark-green-2-hero m-0">
                        <div class="card-header" id="faq-1">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    How do I change my password in case I forget it?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="faq-1" data-parent="#accordion">
                            <div class="card-body">
                                To recover your password, provide your account tokens. Then, we'll provide you a new password for your account.
                            </div>
                        </div>
                    </div>
                    <div class="card dark-green-2-hero m-0">
                        <div class="card-header" id="faq-2">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How do I manage my account tokens?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="faq-2" data-parent="#accordion">
                            <div class="card-body">
                                We provide you with a downloadable file containing both tokens. Store these tokens securely, allowing you to use our web app across multiple devices with ease.
                            </div>
                        </div>
                    </div>
                    <div class="card dark-green-2-hero m-0">
                        <div class="card-header" id="faq-3">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How can I manage my credentials in <em><b>MasterKey</b></em>?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="faq-3" data-parent="#accordion">
                            <div class="card-body">
                                Organize your accounts into groups for better management. Keep related accounts together, providing a more organized and efficient experience within the app.
                            </div>
                        </div>
                    </div>
                    <div class="card dark-green-2-hero m-0">
                        <div class="card-header" id="faq-4">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    How are my passwords secured in my app?
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="faq-4" data-parent="#accordion">
                            <div class="card-body">
                                The master password of your <em><b>MasterKey</b></em> account undergoes a one-way encryption process that cannot be reverted.
                                On the other hand, the passwords and security questions you store in <em><b>MasterKey</b></em> are encrypted in a reversible way in our database.
                                You will be able to see your decrypted passwords and security questions by providing your account tokens. 
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<?php require_once "templates/main-footer.php"; ?>
<?php require_once "templates/footer.php";?>