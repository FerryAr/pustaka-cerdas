<?php
include_once '../config/config.php';

$config = new Config();

$baseUrl = $config->root;
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>


    <link rel="stylesheet" href="<?= $baseUrl ?>assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/compiled/css/auth.css">
</head>

<body>
    <script src="<?= $baseUrl ?>assets/static/js/initTheme.js"></script>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="<?= $baseUrl ?>"><h1>PustakaCerdas</h1></a>
                    </div>
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="alert alert-light-danger color-danger">
                            <i class="bi bi-exclamation-circle"></i>
                            <?= $_SESSION['error'] ?>
                            <?php
                            unset($_SESSION['error']);

                            ?>
                        </div>
                    <?php
                    endif; ?>
                    <h2 class="auth-title">Log in.</h2>

                    <form action="<?= $baseUrl ?>auth/loginAction" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="username" placeholder="Username" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Biarkan saya tetap login
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p><a class="font-bold" href="auth-forgot-password.html">Lupa password?</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>