<!DOCTYPE html>
<html lang="en">

<?php include '../includes/header.php' ?>

<body>
    
    <?php include '../includes/top_navbar.php' ?>

    <div class="d-flex font_change" style="min-height: 100vh;">

        <?php include '../includes/sidebar.php' ?>

        <div class="main-content flex-grow-1 d-flex flex-column p-4">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4 fs-6">
                    <li class="breadcrumb-item text-muted">Member</li>
                    <li class="breadcrumb-item text-muted" aria-current="page">Member Details</li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Member</li>
                </ol>
            </nav>

            <div class="row align-items-start">

                <div class="col-lg-8 mb-4">
                    <div class="custom-form-card p-5 rounded-3 shadow-sm">
                        <h2 class="fw-bold mb-1" style="color: var(--brown-900);">Add New Member</h2>
                        <p class="mb-4" style="color: var(--brown-700);">Please ensure all member details are validated before processing.</p>

                        <hr class="mb-4" style="border-color: var(--brown-200);">
                        <div id="error-container"></div>

                         <form action="../actions/member_action.php" method="POST">
    
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="member_id" class="form-label fw-medium" style="color: var(--brown-900);">Member ID</label>
                                    <input type="text" class="form-control custom-input py-2" id="member_id" name="member_id" placeholder="M001" pattern="^M[0-9]{3}$" title="Format must be 'M' followed by 3 numbers (e.g., M001)" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label fw-medium" style="color: var(--brown-900);">First Name</label>
                                    <input type="text" class="form-control custom-input py-2" id="first_name" name="first_name" placeholder="Hashan" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label fw-medium" style="color: var(--brown-900);">Last Name</label>
                                    <input type="text" class="form-control custom-input py-2" id="last_name" name="last_name" placeholder="Sudeera" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-medium" style="color: var(--brown-900);">E-mail Address</label>
                                    <input type="email" class="form-control custom-input py-2" id="email" name="email" placeholder="maneesha@gmail.com" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="birthday" class="form-label fw-medium" style="color: var(--brown-900);">Birthday</label>
                                    <input type="date" class="form-control custom-input py-2" id="birthday" name="birthday" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-2">
                                <a href="member_details.php" class="btn btn-cancel px-4 py-2 fw-medium">Cancel</a>
                                <button type="submit" class="btn btn-add px-4 py-2 fw-medium" name="add_member">Add Member</button>
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
                            <h6 class="fw-bold mb-1" style="color: var(--blue-800);">Member ID Validation</h6>
                            <ul class="mb-0 ps-3" style="color: var(--blue-800); font-size: 0.9rem;">
                                <li>Format: Must start with 'M' followed by numbers (e.g., M001).</li>
                            </ul>
                        </div>
                     
                    </div>
                </div>

            </div>
            
        </div>
   
<script>
        window.addEventListener('load', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            const errorCode = urlParams.get('error');

            let shouldCleanUrl = false;

            // success alert
            if (status === "success") {
                setTimeout(function() {
                    alert('Data added successfully!');
                    window.location.href = '../members/member_details.php';
                    window.history.replaceState(null, null, window.location.pathname);
                }, 100);
                shouldCleanUrl = true;
            }

            // error handling
            if (errorCode) {
                let errorTitle = "Error!";
                let errorMessage = "";

                switch (errorCode) {
                    case 'duplicate_member_id':
                        errorTitle = "Already Exists!";
                        errorMessage = "That MEMBER ID has already been used. Please use a new one.";
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
                    window.history.replaceState(null, null, window.location.pathname);
                }, 200);
            }
        });
    </script>

    
    


</body>

</html>