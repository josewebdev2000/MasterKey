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
                                <h3 class="card-title w-100">Master Actions <span class="float-right"><?=$user["username"];?></span></h3>
                            </div>
                            <div class="card-body">
                                <strong>
                                    <i class="fas fa-clipboard"></i>
                                    Get Profile Accounts
                                    <p class="text-center mt-3">
                                        <button type="button" class="btn btn-info btn-lg text-white" data-toggle="tooltip" data-placement="top" data-html="true" title="Download <em><b>MasterKey</b></em> account credentials in PDF">Download</button>
                                    </p>
                                </strong>
                                <strong>
                                    <i class="fas fa-id-card"></i>
                                    Delete My Accounts
                                </strong>
                                <p class="text-center mt-3">
                                    <button type="button" class="btn btn-warning btn-lg text-white" data-toggle="tooltip" data-placement="top" data-html="true" title="Delete <em><b>MasterKey</b></em> account credentials">Clear</button>
                                </p>
                                <hr>
                                <strong>
                                    <i class="fas fa-portrait"></i>
                                    Destroy My <span class="font-weight-bold font-italic">MasterKey</span> Profile
                                </strong>
                                <p class="text-center mt-3">
                                    <button class="btn bg-danger btn-lg" data-toggle="tooltip" data-placement="top" data-html="true" title="Destroy your <em><b>MasterKey</b></em> account with all its data">Destroy</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <p class="float-left text-mute">Profile Editor</p>
                                <ul class="float-right nav nav-pills">
                                    <li class="nav-item">
                                        <a href="#username-editor" class="nav-link active" data-toggle="tab">
                                            Username
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#profile-pic-editor" class="nav-link" data-toggle="tab">
                                            Profile Picture
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#password-editor" class="nav-link" data-toggle="tab">
                                            Password
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div id="username-editor" class="tab-pane active">
                                        <form action="" class="form-horizontal" id="username-form">
                                            <div class="form-group row">
                                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="username" id="username" class="form-control" value="<?=$user["username"];?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <div class="checkbox">
                                                        <label for="confirm-username">
                                                            <input id="confirm-username" type="checkbox">
                                                            I confirm I want to change my username
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary" id="username-btn">Change Username</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="profile-pic-editor" class="tab-pane">
                                        <form action="" id="avatar-form">
                                            <div class="form-group">
                                                <label for="avatar" class="col-sm-2 col-form-label">Select an Avatar</label>
                                            </div>
                                            <div id="pic-grid-selector" class="form-group">
                                                <div class="container">
                                                    <div class="row d-flex justify-content-center align-items-center">
                                                        <?php for($i = 1; $i <= 12; $i++): ?>
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 text-center p-2 m-2">
                                                                <img id="avatar-<?=$i?>" class="avatar" src="<?=$websiteURL?>/assets/img/avatars/avatar-<?=$i?>.png" alt="Avatar <?=$i?>">
                                                            </div>
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="avatar-url" id="avatar-url">
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary mt-3" id="avatar-btn">Change Avatar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="password-editor" class="tab-pane">passwordsin</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php require_once "../templates/footer.php";?>