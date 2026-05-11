<?php
// 1. Include database connection
include '../includes/db_config.php';


if (isset($_GET['id'])) {
    $borrow_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $sql = "SELECT * FROM bookborrower WHERE borrow_id = '$borrow_id'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        header("Location: borrow.php");
        exit();
    }
} else {
    header("Location: borrow.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include '../includes/header.php' ?>

<body>
    <?php include '../includes/top_navbar.php' ?>

    <div class="d-flex font_change">

        <?php include '../includes/sidebar.php' ?>

        <div class="main-content flex-grow-1 p-4">

            <nav aria-label="breadcrumb"  class="font_change">
                <ol class="breadcrumb mb-4 fs-6">
                    <li class="breadcrumb-item text-muted">Borrow</li>
                    <li class="breadcrumb-item text-muted" aria-current="page">Borrowing Records</li>
                    <li class="breadcrumb-item active" aria-current="page">Update Borrow Record</li>
                </ol>
            </nav>

            <div class="row align-items-start">

                <div class="col-lg-8 mb-4">
                    <div class="custom-form-card p-5 rounded-3 shadow-sm">

                        <h2 class="fw-bold mb-1" style="color: var(--brown-900);">Update Borrow Record</h2>
                        <p class="mb-4" style="color: var(--brown-700);">Edit the details for this borrowing transaction below.</p>

                        <hr class="mb-4" style="border-color: var(--brown-200);">

                        <div id="error-container"></div>

                        <form action="../actions/borrow_actions.php" method="POST">

                            <div class="mb-4">
                                <label for="borrow_id" class="form-label fw-medium" style="color: var(--brown-900);">Borrow ID</label>
                                <input type="text" class="form-control custom-input py-2" id="borrow_id" name="borrow_id" value="<?php echo $row['borrow_id']; ?>" readonly>
                                <small class="text-muted">The Borrow ID cannot be changed.</small>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="book_id" class="form-label fw-medium" style="color: var(--brown-900);">Book ID</label>
                                    <input type="text" class="form-control custom-input py-2" id="book_id" name="book_id" placeholder='Book ID format "B001"' pattern="^B[0-9]{3}$" title="Format must be 'B' followed by 3 numbers (e.g., B001)" value="<?php echo $row['book_id']; ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="member_id" class="form-label fw-medium" style="color: var(--brown-900);">Member ID</label>
                                    <input type="text" class="form-control custom-input py-2" id="member_id" name="member_id" placeholder='Member ID format "M001"' pattern="^M[0-9]{3}$" title="Format must be 'M' followed by 3 numbers (e.g., M001)" value="<?php echo $row['member_id']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="form-label fw-medium d-block mb-3" style="color: var(--brown-900);">Borrow Status</label>
                                <div class="d-flex gap-5">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="borrow_status" id="status_borrowed" value="Borrowed" <?php echo ($row['borrow_status'] == 'Borrowed') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" style="color: var(--brown-800);" for="status_borrowed">
                                            Borrowed
                                        </label>
                                    </div>
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="borrow_status" id="status_available" value="Available" <?php echo ($row['borrow_status'] == 'Available') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" style="color: var(--brown-800);" for="status_available">
                                            Available
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-2">
                                <a href="borrow.php" class="btn btn-cancel px-4 py-2 fw-medium">Cancel</a>
                                <button type="submit" class="btn btn-add px-4 py-2 fw-medium" name="update_borrow">Update Record</button>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="custom-guide-card p-4 rounded-3 shadow-sm h-100">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-info-circle fs-4 me-2" style="color: var(--blue-800);"></i>
                            <h4 class="fw-bold mb-0" style="color: var(--blue-900);">Update Guidelines</h4>
                        </div>

                        <div class="guideline-item mb-4">
                            <h6 class="fw-bold mb-1" style="color: var(--blue-800);">Primary Key Lock</h6>
                            <ul class="mb-0 ps-3" style="color: var(--blue-800); font-size: 0.9rem;">
                                <li>The Borrow ID is locked to prevent database relationship errors. If this is incorrect, delete the record and create a new one.</li>
                            </ul>
                        </div>

                        <div class="guideline-item mb-4">
                            <h6 class="fw-bold mb-1" style="color: var(--blue-800);">Book ID Validation</h6>
                            <ul class="mb-0 ps-3" style="color: var(--blue-800); font-size: 0.9rem;">
                                <li>Format: Must start with 'B' followed by numbers (e.g., B001).</li>
                            </ul>
                        </div>

                        <div class="guideline-item">
                            <h6 class="fw-bold mb-1" style="color: var(--blue-800);">Member ID Validation</h6>
                            <ul class="mb-0 ps-3" style="color: var(--blue-800); font-size: 0.9rem;">
                                <li>Format: Must start with 'M' followed by numbers (e.g., M001).</li>
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
                    alert('Data updated successfully!');
                    
                    // Clean the URL to remove the status, but KEEP the Borrow ID!
                    let currentUrl = window.location.pathname;
                    let borrowId = "<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>";
                    window.location.href = '../borrow/borrow.php';
                    window.history.replaceState(null, null, currentUrl + "?id=" + borrowId);
                }, 100);
            });
        </script>
    <?php endif; ?>
    <script>
        window.addEventListener('load', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            const errorCode = urlParams.get('error');
            
            // Grab the ID so we don't accidentally delete it!
            const recordId = urlParams.get('id'); 

            let shouldCleanUrl = false;

            // --- 2. HANDLE ERROR MESSAGES ---
            if (errorCode) {
                let errorTitle = "Error!";
                let errorMessage = "";

                switch (errorCode) {
                    case 'book_not_found':
                        errorTitle = "Not Found!";
                        errorMessage = "That Book ID does not exist in the system.";
                        break;
                    case 'member_not_found':
                        errorTitle = "Not Found!";
                        errorMessage = "That Member ID does not exist in the system.";
                        break;
                    case 'invalid_book_id':
                        errorTitle = "Invalid Format!";
                        errorMessage = "Book ID must be 'B' followed by 3 numbers.";
                        break;
                    case 'invalid_member_id':
                        errorTitle = "Invalid Format!";
                        errorMessage = "Member ID must be 'M' followed by 3 numbers.";
                        break;
                    default:
                        errorTitle = "System Error!";
                        errorMessage = "An unexpected error occurred. Please try again.";
                }

                const alertHTML = `
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" id="dynamicErrorAlert">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                        <div>
                            <strong>${errorTitle}</strong> ${errorMessage}
                        </div>
                    </div>
                `;

                document.getElementById('error-container').innerHTML = alertHTML;

                setTimeout(function() {
                    let alertElement = document.getElementById('dynamicErrorAlert');
                    if (alertElement) {
                        let bsAlert = new bootstrap.Alert(alertElement);
                        bsAlert.close();
                    }
                }, 4000);

                shouldCleanUrl = true;
            }

            if (shouldCleanUrl) {
                setTimeout(function() {
                    let currentPath = window.location.pathname;
                    
                    // If an ID exists, keep it in the URL. Otherwise, clean completely.
                    if (recordId) {
                        window.history.replaceState(null, null, currentPath + "?id=" + recordId);
                    } else {
                        window.history.replaceState(null, null, currentPath);
                    }
                }, 200);
            }
        });
    </script>

</body>
</html>