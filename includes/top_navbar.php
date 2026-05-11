<?php
$current_page = basename($_SERVER['PHP_SELF']);

if(!defined('BASE_URL')){
    define('BASE_URL', 'http://localhost/web_project/Library-Management-System/'); 
}

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom px-2 py-1">
        <div class="container-fluid">
            <div class="logo-wrapper">
                <a class="navbar-brand d-flex align-items-center text-decoration-none m-0" href="dashboard.php">

                    <img src="<?php echo BASE_URL; ?>assets/img/UOC_logo.png" alt="Smart Library Logo" class="me-2" style="width: 45px; height: auto;">

                    <div class="d-flex flex-column justify-content-center align-items-start">
                        <span class="brand-title">SMART LIBRARY</span>
                        <span class="brand-subtitle">Library Management Systems</span>
                    </div>

                </a>
            </div>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#"><i class="bi bi-bell fs-5"></i></a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#"><i class="bi bi-gear fs-5"></i></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4 me-1"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="login.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>