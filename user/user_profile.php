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
                    Modify existing archival record and security credentials for library patronage.
                </p>

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
                               readonly>

                    </div>

                    <!-- LAST NAME -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Last name
                        </label>

                        <input type="text"
                               class="form-control"
                               value="<?php echo $user['last_name']; ?>"
                               readonly>

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
                               readonly>

                    </div>

                    <!-- EMAIL -->
                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            E-mail address
                        </label>

                        <input type="email"
                               class="form-control"
                               value="<?php echo $user['email']; ?>"
                               readonly>

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
                               readonly>

                    </div>

                </div>

                <hr>

                <div class="d-flex justify-content-end gap-3 mt-4">

                    <a href="#" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">Delete Account</a>
                    <a href="#" class="btn btn-secondary" tabindex="-1" role="button" aria-disabled="true">Edit User Details</a>
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>