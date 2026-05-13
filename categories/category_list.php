<?php 
include '../includes/db_config.php'; 

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$where_clause = "";
if ($search != '') {
    // This filters the results based on what you type
    $where_clause = " WHERE 
                      category_Name LIKE '%$search%' ";
}





// Fetch total count for the stat card
$count_query = "SELECT COUNT(*) as total FROM bookcategory";
$count_result = mysqli_query($conn, $count_query);
$total_cats = mysqli_fetch_assoc($count_result)['total'];

?>
<!DOCTYPE html>
<html lang="en">
<?php include '../includes/header.php'?>
<body>
<?php include '../includes/top_navbar.php'?> 
<div class="d-flex font_change">
    
    <?php include '../includes/sidebar.php'?> 

    <div class="container-fluid py-4">
        <div class="row align-items-center mb-4">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item">Category</li>
                        <li class="breadcrumb-item active">Category List</li>
                    </ol>
                </nav>
            </div>

            <div class="col-auto">
                <a href="add_category.php">
                    <button class="btn text-white px-4 py-2" style="background-color: #4a4538;">
                        <i class="bi bi-plus-circle me-2"></i>
                        Add New Category
                    </button>
                </a>
            </div>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] === 'invalid_format'): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Validation Error:</strong> Category ID must start with 'C' followed by 3 digits (e.g., C001).
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif ($_GET['msg'] === 'exists'): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon-fill me-2"></i>
                    <strong>Duplicate Error:</strong> This Category ID already exists. Please use a unique code.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif ($_GET['msg'] === 'updated'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Category updated successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif ($_GET['msg'] === 'added'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-plus-circle-fill me-2"></i>
                    New category added successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif ($_GET['msg'] === 'deleted'): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-trash-fill me-2"></i>
                    Category deleted successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="row g-3 mb-4 ">
            <div class="col-md-3">
                <div class="card custom_card border-0 shadow-sm w-180 p-2 rounded-3">
                    <span class="text-muted small fw-bold">TOTAL CATEGORIES</span>
                    <h2 class="fw-bold mb-0"><?php echo $total_cats; ?></h2>
                </div>
            </div>
        </div>
        

        <div class="card border-0 shadow-sm bg-body-tertiary p-4 rounded-4">
            <div class="card-body p-0">
                <form method="GET" action="category_list.php">
                    <div class="d-flex justify-content-between align-items-center p-3 bg-white border-bottom">

                        <div class="input-group w-auto bg-body rounded-pill border px-2 py-1 align-items-center font_change">
                            <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Search records..." 
                                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            <button class="btn border-0 text-muted" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover mb-0 custom-header">

                        <thead class="bg-light text-muted small text-uppercase">
                            <tr>
                                <th class="ps-4">Category Name</th>
                                <th>Code</th>
                                <th>Date Modified</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = "SELECT * FROM bookcategory $where_clause ORDER BY date_modified ASC";
                            $result = mysqli_query($conn, $query);

                            

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {

                                    $formatted_date = date('d/m/Y', strtotime($row['date_modified']));
                            ?>
                            <tr>
                                <td class="ps-4 py-3">
                                    <i class="fa-solid fa-feather-pointed text-warning me-2"></i> 
                                    <?= htmlspecialchars($row['category_Name']) ?>
                                </td>
                                <td class="fw-medium"><?= htmlspecialchars($row['category_id']) ?></td>
                                <td class="fw-medium"><?=  $formatted_date ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-3">
                                        <a href="edit_category.php?id=<?= urlencode($row['category_id']) ?>&name=<?= urlencode($row['category_Name']) ?>" 
                                           class="text-decoration-none" 
                                           style="color: #4e6e81;">
                                            <i class="bi bi-pencil-square fs-5"></i>
                                        </a>

                                        <a href="../action/category_action.php?delete=<?= urlencode($row['category_id']) ?>" 
                                           class="text-decoration-none" 
                                           style="color: #4e6e81;" 
                                           onclick="return confirm('Are you sure you want to delete this category?')">
                                            <i class="bi bi-trash fs-5"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center py-4 text-muted'>No categories found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>