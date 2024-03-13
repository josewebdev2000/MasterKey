<?php require_once "templates/header.php"; ?>
<?php require_once "templates/main-header.php"; ?>

<main class="container-fluid bg-img-container bg-envelope-img bg-img-peach-hue flex-065">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mt-3 mb-4">Contact Us</h2>
        </div>
    </div>

    <div class="row">
        <!--Introductory Section-->
        <div class="col-12 mb-4 d-flex justify-content-center">
            <section class="text-center p-3 hero rborder-25 dark-peach-hero">
                <p class="lead fsize-120">Have questions, feedback, or need assistance?</p>
                <p class="lead fsize-120">We're here for you!</p>
                <p class="lead fsize-120"> Feel free to reach out using the form below</p>
                <p class="lead fsize-120">Your inquiries are important to us, and we'll respond <b>as soon as possible</b></p>
                <p class="lead fsize-120">Thank you for choosing <em><b>MasterKey</b></em></p>
            </section>
        </div>

        <!--Contact Form Container-->
        <div class="col-12 d-flex justify-content-center opa-09">
            <div class="p-3 hero rboder-25 card card-light">
                <div class="card-header">
                    <h3 class="text-center">Contact Form</h3>
                </div>
                <form action="contact.php" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" name="name" placeholder="Name" id="name" required>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" type="email" placeholder="Email Address" id="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-marker"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" type="text" placeholder="Subject" id="subject" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col input-group mb-3 d-flex justify-content-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                </div>
                                <select class="custom-select" name="urgency" required>
                                    <option value="" disabled selected>Select Urgency Status</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col input-group">
                                <textarea class="summernote" name="request"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer m-0 p-0">
                        <button type="submit" class="btn btn-block btn-light">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once "templates/main-footer.php"; ?>
<?php require_once "templates/footer.php";?>