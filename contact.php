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
                <form id="contact-form" enctype="multipart/form-data" novalidate>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" name="name" placeholder="Name" id="name" required>
                                <div class="valid-tooltip name">Name looks good</div>
                                <div class="invalid-tooltip name"></div>
                            </div>
                            <div class="col-md-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </div>
                                <input class="form-control" name="email" type="email" placeholder="Email Address" id="email" required>
                                <div class="valid-tooltip email">Email looks good</div>
                                <div class="invalid-tooltip email"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-marker"></i>
                                    </span>
                                </div>
                                <input class="form-control" name="subject" type="text" placeholder="Subject" id="subject" required>
                                <div class="valid-tooltip subject">Subject looks good</div>
                                <div class="invalid-tooltip subject"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col input-group mb-3 d-flex justify-content-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                </div>
                                <select id="urgency" class="custom-select form-control" name="urgency" required>
                                    <option value="" selected>Select Urgency Status</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                                <div class="valid-tooltip urgency">Valid Urgency Status Chosen</div>
                                <div class="invalid-tooltip urgency">Choose a valid option</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col input-group">
                                <textarea class="summernote form-control" name="request" id="request" required></textarea>
                                <div class="valid-tooltip request">Message looks good</div>
                                <div class="invalid-tooltip request"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="form-alerts-container">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer m-0 p-0">
                        <button type="submit" name="send" id="send" class="btn btn-block btn-light">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once "templates/main-footer.php"; ?>
<?php require_once "templates/footer.php"; ?>