<?php
// Define the Base URL for the project
if(!defined('BASE_URL')){
    define('BASE_URL', 'http://localhost/web_project/Smart_Library/'); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Library Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="./assets/login_register.css">

</head>
<body>

<div class="container-fluid">

    <div class="row">

        <!-- Left section -->

        <div class="col-lg-6 left-side">

            <div class="quote-box">

                <h1>
                    “The only thing that you absolutely have to know is the location of the library.”
                </h1>

                <p>— Albert Einstein</p>

            </div>

        </div>

        <!-- Right section -->

        <div class="col-lg-6 right-side d-flex justify-content-center align-items-center">

            <div class="login-box">

                <div class="text-center mb-4">
                    <h1 class="login-title">
                        Login for Smart Library System
                    </h1>

                    <p class="sub-title">
                        Library-Management-System
                        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                            <div class="container mt-3 text-center">
                                <p class="text-success fw-bold">
                                    <i class="bi bi-check-lg"></i> Registration Successful! Welcome to the Library System.
                                </p>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_GET['status']) && $_GET['status'] == 'invalid'): ?>
                            <p class="text-danger fw-bold text-center mb-3">
                                <i class="bi bi-exclamation-triangle-fill"></i> Invalid Username or Password!
                            </p>
                        <?php endif; ?>
                    </p>

                </div>

                <form method="POST" action="action/login_register.php">

                    <div class="mb-3">

                        <label class="form-label">
                            Usename
                        </label>

                        <input type="text"
                               class="form-control"
                               placeholder="Enter Your Username"
                               name="username"
                               required>

                    </div>

                    <div class="mb-3">

                        <div class="d-flex justify-content-between">

                            <label class="form-label">
                                Password
                            </label>

                        </div>

                        <input type="password"
                               class="form-control"
                               placeholder="********"
                               name="password"
                               required>

                    </div>

                    <div class="form-check mt-3">

                        <input class="form-check-input"
                               type="checkbox"
                               id="remember">

                        <label class="form-check-label" for="remember">
                            Stay logged in
                        </label>

                    </div>

                    <button type="submit" class="btn btn-login" name="login">
                        SIGN IN
                    </button>

                </form>
                <hr>

                <div class="register-text">

                    Don’t have an account?
                    <a href="register.php">Register here.</a>

                </div>

            </div>

        </div>

    </div>

</div>
</body>
</html>