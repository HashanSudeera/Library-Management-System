<?php
// database connection
include '../includes/db_config.php';

if (isset($_GET['id'])) {
    $member_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    //  fetch data from member table
    $sql = "SELECT * FROM member WHERE member_id = '$member_id'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        header("Location: member.php");
        exit();
    }
} else {
    header("Location: member.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php' ?>

<body>
    <?php include '../includes/top_navbar.php' ?>

    <div class="d-flex font_change" style="min-height: 100vh;">

        <?php include '../includes/sidebar.php' ?>

        <div class="main-content flex-grow-1 d-flex flex-column p-4">

            <nav aria-label="breadcrumb" class="font_change">
                <ol class="breadcrumb mb-4 fs-6">
                    <li class="breadcrumb-item text-muted">Members</li>
                    <li class="breadcrumb-item text-muted" aria-current="page">Member Records</li>
                    <li class="breadcrumb-item active" aria-current="page">Update Member Record</li>
                </ol>
            </nav>

            <div class="row align-items-start">

                <div class="col-lg-8 mb-4">
                    <div class="custom-form-card p-5 rounded-3 shadow-sm">

                        <h2 class="fw-bold mb-1" style="color: var(--brown-900);">Update Member Details</h2>
                        <p class="mb-4" style="color: var(--brown-700);">Edit the personal information for this member.</p>

                        <hr class="mb-4" style="border-color: var(--brown-200);">

                        <div id="error-container"></div>

                        <form action="../actions/member_action.php" method="POST">

                            <div class="mb-4">
                                <label for="member_id" class="form-label fw-medium" style="color: var(--brown-900);">Member ID</label>
                                <input type="text" class="form-control custom-input py-2" id="member_id" name="member_id" value="<?php echo $row['member_id']; ?>" readonly>
                                <small class="text-muted">The Member ID cannot be changed.</small>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label fw-medium" style="color: var(--brown-900);">First Name</label>
                                    <input type="text" class="form-control custom-input py-2" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="last_name" class="form-label fw-medium" style="color: var(--brown-900);">Last Name</label>
                                    <input type="text" class="form-control custom-input py-2" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-medium" style="color: var(--brown-900);">Email Address</label>
                                <input type="email" class="form-control custom-input py-2" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                            </div>

                            <div class="mb-5">
                                <label for="birthday" class="form-label fw-medium" style="color: var(--brown-900);">Birthday</label>
                                <input type="date" class="form-control custom-input py-2" id="birthday" name="birthday" value="<?php echo $row['birthday']; ?>" required>
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-2">
                                <a href="member_details.php" class="btn btn-cancel px-4 py-2 fw-medium">Cancel</a>
                                <button type="submit" class="btn btn-add px-4 py-2 fw-medium" name="update_member">Update Member</button>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="custom-guide-card p-4 rounded-3 shadow-sm h-50">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-info-circle fs-4 me-2" style="color: var(--blue-800);"></i>
                            <h4 class="fw-bold mb-0" style="color: var(--blue-900);">Edit Tips</h4>
                        </div>

                        <div class="guideline-item mb-4">
                            <h6 class="fw-bold mb-1" style="color: var(--blue-800);">Unique Email</h6>
                            <ul class="mb-0 ps-3" style="color: var(--blue-800); font-size: 0.9rem;">
                                <li>Ensure the email address is valid and not already used by another member.</li>
                            </ul>
                        </div>

                        <div class="guideline-item">
                            <h6 class="fw-bold mb-1" style="color: var(--blue-800);">Age Verification</h6>
                            <ul class="mb-0 ps-3" style="color: var(--blue-800); font-size: 0.9rem;">
                                <li>Please verify the date of birth before saving to ensure records match official IDs.</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div> 
    </div>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'updated'): ?>
        <script>
            window.addEventListener('load', function() {
                setTimeout(function() {
                    alert('Member updated successfully!');
                    let memberId = "<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>";
                    window.location.href = 'member_details.php'; 
                }, 100);
            });
        </script>
    <?php endif; ?>

  

</body>
</html>