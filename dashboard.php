
<!DOCTYPE html>
<html>

<?php include 'includes/header.php' ?>

<body>

    <?php include 'includes/top_navbar.php' ?>


    <div class="d-flex">

        <?php include 'includes/sidebar.php' ?>

        <div class="main-content flex-grow-1 p-4">

            <nav aria-label="breadcrumb" class="font_change">
                <ol class="breadcrumb mb-3 fs-6">
                    <li class="breadcrumb-item text-muted">Borrow</li>
                    <li class="breadcrumb-item active" aria-current="page">Borrowing Records</li>
                </ol>
            </nav>

            <div class="row align-items-center mb-4">

                <div class="col-md-8 d-flex gap-4 font_change">
                    <div class="card custom_card border-0 shadow-sm flex-fill p-2 rounded-3">
                        <div class="card-body py-2 ">
                            <div class="d-flex align-items-center mb-1">
                                <i class="bi bi-folder2-open text-muted me-2 fs-5"></i>
                                <span class="text-muted fw-medium fs-6">Borrowed</span>
                            </div>
                            <h3 class="mb-0 fw-bold fs-2">34</h3>
                        </div>
                    </div>

                    <div class="card custom_card border-0 shadow-sm flex-fill p-2 rounded-3">
                        <div class="card-body py-2">
                            <div class="d-flex align-items-center mb-1">
                                <i class="bi bi-folder2-open text-muted me-2 fs-5"></i>
                                <span class="text-muted fw-medium fs-6">Available</span>
                            </div>
                            <h3 class="mb-0 fw-bold fs-2">12</h3>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card border-0 shadow-sm bg-body-tertiary p-4 rounded-4">

                <form action="borrow.php" method="GET" class="mb-4">
                <div class="d-flex justify-content-between align-items-center bg-body-tertiary p-3 rounded-3 shadow-sm border border-opacity-10">
                    
                    <div class="d-flex align-items-center gap-2 font_change">
                        <i class="bi bi-filter-left fs-4 text-muted"></i>
                        <select name="filter_status" class="form-select border-0 bg-transparent shadow-none" onchange="this.form.submit()" style="cursor: pointer;">
                            <option value="All" <?php echo (isset($_GET['filter_status']) && $_GET['filter_status'] == 'All') ? 'selected' : ''; ?>>All Records</option>
                            <option value="Borrowed" <?php echo (isset($_GET['filter_status']) && $_GET['filter_status'] == 'Borrowed') ? 'selected' : ''; ?>>Borrowed</option>
                            <option value="Available" <?php echo (isset($_GET['filter_status']) && $_GET['filter_status'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                        </select>
                    </div>

                    <div class="input-group w-auto bg-body rounded-pill border px-2 py-1 align-items-center font_change">
                        <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Search records..." 
                               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button class="btn border-0 text-muted" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                </div>
            </form>

                <div class="table-responsive px-2">
                    <table class="table table-hover align-middle border-0 text-center mb-0">
                        <thead class="custom-table-header font_change">
                            <tr>
                                <th class="py-3 px-4 rounded-start border-0 fw-medium">Borrow ID</th>
                                <th class="py-3 border-0 fw-medium text-start">Book Name</th>
                                <th class="py-3 border-0 fw-medium text-start">Member Name</th>
                                <th class="py-3 border-0 fw-medium">Status</th>
                                <th class="py-3 border-0 fw-medium">Date Modified</th>
                                <th class="py-3 px-4 text-center rounded-end border-0 fw-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            <tr>
                                <td>hello</td>
                                <td>hi</td>
                                <td>hi</td>
                                <td>hi</td>
                                <td>hi</td>
                                <td>hi</td>

                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>

</html>