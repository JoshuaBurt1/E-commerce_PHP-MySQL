<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $auth = isset($_SESSION["user"]);
?>
<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $authw = isset($_SESSION["userw"]);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="<?= ROOT_PATH ?>/styles/style.css">
    <title><?= $title ?></title>
</head>

<body id="<?= $override_id ?? "main" ?>">
    <!-- Simple notification check for errors -->
    <?php if (isset($errors)): ?>
        <div class="alert alert-danger">
            <?php
                if (is_string($errors)) {
                    echo "<p>$errors</p>";
                } else {
                    foreach ($errors as $error) echo "<p>$error</p>";
                }
            ?>
        </div>
    <?php endif ?>

    <!-- Simple notification check for successes -->
    <?php if (isset($success)): ?>
        <div class="alert alert-success">
            <?php
                if (is_string($success)) {
                    echo "<p>$success</p>";
                } else {
                    foreach ($success as $s) echo "<p>$s</p>";
                }
            ?>
        </div>
    <?php endif ?>

    <!-- LEFT SIDE: Page navigation -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= ROOT_PATH ?>">
                Biotec-For-U
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Manufacturer Portal </a>
                        <ul class="dropdown-menu">
                        <?php if ($authw): ?><!--IF USERW (MANUFACTURER) LOGGED IN - viewable-->
                            <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/categories/new">New Category </a></li>
                            <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/categories">List Categories</a></li>
                            <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/products/new">New Product </a></li>
                            <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/products">List Products</a></li>
                            <li><a onclick="return confirm('Are you sure you are ready to log out?')" class="dropdown-item"  href="<?= ROOT_PATH ?>/logoutw">Logout</a></li>
                            <?php else: ?><!--IF USERW (MANUFACTURER) NOT LOGGED IN - viewable-->
                            <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/usersw/new">Registration</a></li>
                            <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/loginw">Login</a></li>
                            <?php endif ?>
                        </ul>
                    </li>
                </ul>
            </div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">User Portal </a>
                        <ul class="dropdown-menu">
                        <?php if ($auth): ?><!--IF USER LOGGED IN - viewable-->
                            <li class="nav-item">
                            <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/protocols">Protocols</a></li>
                            <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/forum">Forum </a></li>
                            <li><a onclick="return confirm('Are you sure you are ready to log out?')" class="dropdown-item" href="<?= ROOT_PATH ?>/logout">Logout</a></li>
                        <?php else: ?><!--IF USER NOT LOGGED IN - viewable-->
                            <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/users/new">Registration</a></li>
                            <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/login">Login</a></li>
                        <?php endif ?>
                        </ul>
                    </li>
                </ul>

            <!--RIGHT SIDE: PAGE NAVIGATION-->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if ($auth): ?><!--IF USER LOGGED IN - viewable-->
                <li>
                    <a class="nav-link" href="<?= ROOT_PATH ?>/resources">Cart</a>
                </li>
                <?php endif ?><!--IF USER NOT LOGGED IN - viewable-->
                <li>
                    <a class="nav-link" href="<?= ROOT_PATH ?>/categories">Search by Category</a>
                </li>
                <li>
                    <a class="nav-link" href="<?= ROOT_PATH ?>/products?page=1">Products</a>
                </li>
                <li>
                    <a class="nav-link" href="<?= ROOT_PATH ?>/about">About</a>
                </li>
                <li>
                    <a class="nav-link" href="<?= ROOT_PATH ?>/contact">Contact</a>
                </li>
            </ul>
            
        </div>
    </nav>
        
        

    <!-- View specific output -->
    <?= $yield ?? null ?>
</body>
<footer>
<div class="container">
            <hr/>
          <div class="row">
            <div class="footer-col-1">
              <h4>Download Our App</h4>
              <p>
                Download App for Android <br />
                and ios mobile phone
              </p>
              <div class="app-logo">
                <img src="<?= ROOT_PATH ?>/images/business/play-store.png" alt="" id="play"/>
                <img src="<?= ROOT_PATH ?>/images/business/app-store.png" alt="" id="app"/>
              </div>
            </div>
            <div class="footer-col-2">
              <img src="<?= ROOT_PATH ?>/images/business/logo.png" alt="" id="logo" />
            </div>
            <div class="footer-col-3">
              <h4>Useful Links</h4>
              <ul>
                <li>Coupons</li>
                <li>Blog Post</li>
                <li>Return Policy</li>
                <li>Join Affiliate</li>
              </ul>
            </div>
  
            <div class="footer-col-4">
              <h4>Follow us</h4>
              <ul>
                <li>Facebook</li>
                <li>Twitter</li>
                <li>Instagram</li>
                <li>YouTube</li>
              </ul>
            </div>
          </div>
          <hr/>
          <p class="copyright">Copyright © 2023 Biotec-For-U All rights reserved.</p>
        </div>
</footer>
</html>
