<?php require_once __DIR__ . "/../../helpers/index.php";
    // Grab the username
    $username = get_user_by_id($_SESSION["id"])["username"];
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?=$websiteURL.'/dashboard/index.php';?>" class="brand-link logo-switch">
        <img src="<?=$websiteURL.'/assets/img/key.png'?>" alt="MasterKey Key Logo" class="brand-image">
        <span class="brand-text font-weight-light">MasterKey</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img class="img-circle img-fluid elevation-3" width="128" src="<?=$websiteURL?>/assets/img/avatars/avatar-11.png" alt="Stuff">
            </div>
            <div class="info fsize-120">
                <a href="#" class="d-block"><?=$username?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">
                <li class="nav-header">DASHBOARD</li>
                <li class="nav-item">
                    <a href="<?=$websiteURL?>/dashboard/index.php" class="nav-link">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>Main Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>Accounts</p>
                    </a>
                </li>
                <li class="nav-header">DETAILS</li>
                <li class="nav-header">EXIT</li>
                <li class="nav-item">
                    <a href="<?=$websiteURL?>/dashboard/logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>