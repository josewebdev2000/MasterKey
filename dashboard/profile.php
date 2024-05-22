<?php require_once "../templates/header.php"; ?>
<?php require_once "templates/dashboard-header.php"; ?>

<?php require_once __DIR__ . "/../helpers/index.php";

// Grab number of entries of relevant tables
$num_accounts = get_num_table_rows("Account");
$num_account_groups = get_num_table_rows("AccountGroup");
$num_account_types = get_num_table_rows("AccountType");

?>
<!--HTML CODE GOES HERE-->
<div class="wrapper">
    <!--IMPORT MAIN HEADER CODE-->
    <?php require_once "templates/dashboard-main-header.php"; ?>

    <!--IMPORT SIDEBAR CODE HERE-->
    <?php require_once "templates/dashboard-sidebar.php"; ?>

    <!--IMPORT PRELOADER HERE-->
    <?php require_once "templates/dashboard-preloader.php"; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="<?$websiteURL?>/dashboard/">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Profile
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-secondary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <?php echo get_profile_pic_html_code($user, "img-circle img-fluid", 100, "$websiteURL/assets/img/avatars/user.png"); ?>
                                </div>
                                <h3 class="profile-username text-center">
                                    <?=$user["username"];?>
                                </h3>
                                <p class="text-muted text-center">
                                    <em><b>MasterKey</b></em> User
                                </p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Accounts</b>
                                        <a class="float-right"><?=$num_accounts;?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Account Groups</b>
                                        <a class="float-right"><?=$num_account_groups;?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Account Types</b>
                                        <a class="float-right"><?=$num_account_types;?></a>
                                    </li>
                                </ul>
                                <a href="<?=$websiteURL?>/dashboard/account.php" class="btn btn-secondary btn-block">
                                    Manage Accounts
                                </a>
                            </div>
                        </div>
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title w-100">Master Files: <span class="float-right"><?=$user["username"];?></span></h3>
                            </div>
                            <div class="card-body">
                                <strong>
                                    <i class="fas fa-key"></i>
                                    Credentials
                                </strong>
                                <p class="text-center mt-3">
                                    <button class="btn btn-secondary btn-lg">Download</button>
                                </p>
                                <hr>
                                <strong>
                                    <i class="fas fa-coins"></i>
                                    Tokens
                                </strong>
                                <p class="text-center mt-3">
                                    <button class="btn bg-dark btn-lg">Download</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php require_once "../templates/footer.php";?>