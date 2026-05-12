<!DOCTYPE html>
<html lang="en">
    <?php include '../includes/header.php'?> 

<body>
    <?php include '../includes/top_navbar.php'?> 

    <div class="d-flex">
        <?php include '../includes/sidebar.php'?> 

        <div class="main-content w-100">
            <div class="container-fluid px-4">
                
                <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
                    <div class="breadcrumb-text">DASHBOARD > CATEGORYS > <span class="fw-bold">CATEGORY REGISTRATION</span></div>
                    <a href="category_list.php">
                        <button class="btn btn-outline-secondary btn-sm px-4">View categories</button>
                    </a>
                </div>

                <div class="row g-4">
                    <div class="col-xl-8">
                        <div class="main-card shadow-sm">
                            <h2 class="mb-4" style="font-family: serif; color: #2c3e50;">Create New Category</h2>
                            
                            <form action="../action/category_action.php" method="POST">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Category Name</label>
                                        <input type="text" class="form-control shadow-none" name="cat_name" placeholder="e.g. Science Fiction">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Category code</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control shadow-none" name="cat_code" placeholder="e.g. C001">
                                            <span class="input-group-text bg-white"><i class="bi bi-grid-3x3-gap"></i></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="d-flex justify-content-center gap-3">
                                    <a href="category_list.php">
                                    <button type="button" class="btn btn-cancel px-5 py-2">Cancel</button>
                                    </a>
                                    <button type="submit" class="btn btn-register px-5 py-2">Category Register</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>