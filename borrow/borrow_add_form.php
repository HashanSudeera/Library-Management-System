<!DOCTYPE html>
<html lang="en">

<?php include '../includes/header.php' ?>

<body>
    
    <?php include '../includes/top_navbar.php' ?>

    <div class="d-flex">

        <?php include '../includes/sidebar.php' ?>

        <div class="main-content flex-grow-1 p-4">

            <nav aria-label="breadcrumb"  class="font_change">
                <ol class="breadcrumb mb-4 fs-6">
                    <li class="breadcrumb-item text-muted">Borrow</li>
                    <li class="breadcrumb-item text-muted" aria-current="page">Borrowing Records</li>
                    <li class="breadcrumb-item active" aria-current="page">Add Borrow Records</li>
                </ol>
            </nav>

            <div class="row align-items-start">

                <div class="col-lg-8 mb-4">
                    <div class="custom-form-card p-5 rounded-3 shadow-sm">

                        <h2 class="fw-bold mb-1" style="color: var(--brown-900);">Add New Borrow Record</h2>
                        <p class="mb-4" style="color: var(--brown-700);">Please ensure all member details are validated before processing.</p>

                        <hr class="mb-4" style="border-color: var(--brown-200);">

                        <form action="../actions/borrow_actions.php" method="POST">

                            <div class="mb-4">
                                <label for="borrow_id" class="form-label fw-medium" style="color: var(--brown-900);">Borrow ID</label>
                                <input type="text" class="form-control custom-input py-2" id="borrow_id" name="borrow_id" placeholder='Borrow ID format "BR001"' pattern="^BR[0-9]{3}$" title="Format must be 'BR' followed by 3 numbers (e.g., BR001)" required>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="book_id" class="form-label fw-medium" style="color: var(--brown-900);">Book ID</label>
                                    <input type="text" class="form-control custom-input py-2" id="book_id" name="book_id" placeholder='Book ID format "B001"' pattern="^B[0-9]{3}$" title="Format must be 'B' followed by 3 numbers (e.g., B001)" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="member_id" class="form-label fw-medium" style="color: var(--brown-900);">Member ID</label>
                                    <input type="text" class="form-control custom-input py-2" id="member_id" name="member_id" placeholder='Member ID format "M001"' pattern="^M[0-9]{3}$" title="Format must be 'M' followed by 3 numbers (e.g., M001)" required>
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="form-label fw-medium d-block mb-3" style="color: var(--brown-900);">Borrow Status</label>
                                <div class="d-flex gap-5">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="borrow_status" id="status_borrowed" value="Borrowed" checked>
                                        <label class="form-check-label" style="color: var(--brown-800);" for="status_borrowed">
                                            Borrowed
                                        </label>
                                    </div>
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input" type="radio" name="borrow_status" id="status_available" value="Available">
                                        <label class="form-check-label" style="color: var(--brown-800);" for="status_available">
                                            Available
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-2">
                                <a href="borrow.php" class="btn btn-cancel px-4 py-2 fw-medium">Cancel</a>
                                <button type="submit" class="btn btn-add px-4 py-2 fw-medium" name="add_borrow">Add Record</button>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="custom-guide-card p-4 rounded-3 shadow-sm h-100">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-info-circle fs-4 me-2" style="color: var(--blue-800);"></i>
                            <h4 class="fw-bold mb-0" style="color: var(--blue-900);">Filing Guidelines</h4>
                        </div>

                        <div class="guideline-item mb-4">
                            <h6 class="fw-bold mb-1" style="color: var(--blue-800);">Borrow ID Validation</h6>
                            <ul class="mb-0 ps-3" style="color: var(--blue-800); font-size: 0.9rem;">
                                <li>Format: Must start with 'BR' followed by numbers (e.g., BR001).</li>
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

    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <script>
            window.onload = function() {
                setTimeout(function() {
                    alert('Data added successfully!');
                    window.location.href = '../borrow/borrow.php';
                    window.history.replaceState(null, null, window.location.pathname);
                }, 100);
            };
        </script>
    <?php endif; ?>
    
    


</body>

</html>