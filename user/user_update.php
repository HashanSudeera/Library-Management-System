<?php include '../includes/session.php'?>

<?php 

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM user WHERE user_id='$user_id'";

$result = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($result); 

?>


<!DOCTYPE html>
<html lang="en">

<?php include '../includes/header.php' ?>
<head>
    <link rel="stylesheet" href="../assets/profile.css">
</head>
<body>

<?php include '../includes/top_navbar.php' ?>

<div class="container mt-4">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card profile-card">

                <h2 class="profile-title">
                    User Profile
                </h2>

                <p class="profile-subtitle">
                    User can edit their profile information and passwords
                    <?php if (isset($_GET['status'])): ?>
                        <?php 
                            $status = $_GET['status'];
                            $msg = "";
                            $class = "text-danger"; // Default to error red

                            if ($status == 'success') {
                                $msg = "Profile updated successfully!";
                                $class = "text-success"; 
                            }
                            elseif ($status == 'mismatch') $msg = "Passwords do not match!";
                            elseif ($status == 'exists') $msg = "User ID, Email, or Username is already taken.";
                            elseif ($status == 'failed') $msg = "Update failed. Try again.";
                        ?>

                        <?php if ($msg != ""): ?>
                            <p class="<?php echo $class; ?> fw-bold mb-3">
                                <i class="bi bi-info-circle-fill me-1"></i> 
                                <?php echo $msg; ?>
                            </p>
                            <?php endif;
                        endif; ?>
                    ?>
                </p>
                <form method="POST" action="../action/login_register.php">

                    <h6 class="section-title mt-4 mb-4">
                        PROFILE INFORMATION
                    </h6>

                    <div class="row">

                        <!-- FIRST NAME -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                First name
                            </label>

                            <input type="text"
                                class="form-control"
                                value="<?php echo $user['first_name']; ?>"
                                 name="first_name">

                        </div>

                        <!-- LAST NAME -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Last name
                            </label>

                            <input type="text"
                                class="form-control"
                                value="<?php echo $user['last_name']; ?>"
                                name="last_name">

                        </div>

                    </div>


                    <div class="row">

                        <!-- USER ID -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                User ID
                            </label>

                            <input type="text"
                                class="form-control"
                                value="<?php echo $user['user_id']; ?>"
                                name="user_id"
                                pattern="U[0-9]{3}"
                                title="User ID shoud start with 'u' and followed by 3 digits"
                                required>

                        </div>

                        <!-- EMAIL -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                E-mail address
                            </label>

                            <input type="email"
                                class="form-control"
                                value="<?php echo $user['email']; ?>"
                                name="email"
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                title="Please enter a valid email address"
                                required>

                        </div>

                    </div>

                    <!-- USERNAME -->
                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Username
                            </label>

                            <input type="text"
                                class="form-control"
                                value="<?php echo $user['username']; ?>"
                                name="username"
                                required>

                        </div>

                    </div>
                    <hr>
                    <!-- PASSWORD -->
                        <h6 class="section-title">SECURITY CREDENTIALS</h6>

                        <div class="row mt-3">

                            <div class="col-md-6 mb-4">
                                <label class="form-label">New Password</label>
                                <input type="password" 
                                    name="password"
                                    class="form-control"
                                    placeholder="********">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" 
                                    name="confirm_password"
                                    class="form-control"
                                    placeholder="********">
                            </div>

                        </div>


                    <div class="d-flex justify-content-end gap-3 mt-4">

                        <button type="button" class="btn btn-danger">Delete Account</button>
                        <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>