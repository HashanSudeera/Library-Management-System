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

        <!-- LEFT SIDE -->
        <div class="col-lg-5 left-side">

            <div class="quote-box">

                <h1>
                    “The only thing that you absolutely have to know is the location of the library.”
                </h1>

                <p>— Albert Einstein</p>

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="col-lg-7 right-side d-flex justify-content-center align-items-center">

            <div class="register-box p-4">

                <h1 class="title">
                    Register for Smart Library System
                </h1>

                <p class="subtitle">
                    Library-Management-System
                        <?php if (isset($_GET['status'])): ?>
                            <?php 
                                $status = $_GET['status'];
                                $error_msg = "";

                                if ($status == 'mismatch') $error_msg = "Passwords do not match!";
                                if ($status == 'email_exists') $error_msg = "Email is already taken.";
                                if ($status == 'user_exists') $error_msg = "Username is already taken.";
                                if ($status == 'id_exists') $error_msg = "User ID already exists.";
                                if ($status == 'failed') $error_msg = "Registration failed. Try again.";
                            ?>

                            <?php if ($error_msg != ""): ?>
                                <p class="text-danger fw-bold mb-3">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i> <?php echo $error_msg; ?>
                                </p>
                            <?php endif; ?>
                        <?php endif; ?>

                </p>

                <form method="POST" action="action/login_register.php">
                    <!-- User ID -->
                    <div class="mb-3">

                        <label class="form-label">
                            User ID
                        </label>

                        <input type="text"
                               class="form-control"
                               placeholder="U001"
                               name="user_id"
                               pattern="U[0-9]{3}"
                               title="User ID shoud start with 'u' and followed by 3 digits"
                               required>

                    </div>

                    <!-- First Name -->
                    <div class="mb-3">

                        <label class="form-label">
                            First Name
                        </label>

                        <input type="text"
                               class="form-control"
                               placeholder="Sudeera"
                               name="first_name"
                               required>

                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">

                        <label class="form-label">
                            Last Name
                        </label>

                        <input type="text"
                               class="form-control"
                               placeholder="Perera"
                               name="last_name"
                               required>

                    </div>

                    <!-- Email -->
                    <div class="mb-4">

                        <label class="form-label">
                            Email
                        </label>

                        <input type="email"
                               class="form-control"
                               placeholder="sudeera.perera@gmail.com"
                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                               name="email"
                               required>

                    </div>

                    <!-- Username -->
                    <div class="mb-4">

                        <label class="form-label">
                            Username
                        </label>

                        <input type="text"
                               class="form-control"
                               placeholder="user@123"
                               name="username"
                               required>

                    </div>

                    <!-- Password  -->
                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input type="password"
                                   class="form-control"
                                   placeholder="Password"
                                   name="password">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Confirm Password
                            </label>

                            <input type="password"
                                   class="form-control"
                                   placeholder="Confirm Password"
                                   name="confirm_password">
                        </div>

                    </div>

                    <!-- Button -->
                    <button type="submit" class="btn btn-register" name="register">
                        Register Now
                    </button>

                </form>

                <hr>

                <div class="bottom-text">

                    Already have an account?
                    <a href="#">Login</a>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>