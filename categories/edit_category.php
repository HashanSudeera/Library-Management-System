<!DOCTYPE html>
<html lang="en">
    <?php include '../includes/header.php'?> 
    <?php

        $cat_data = [
            'id' => 101,
            'name' => 'Science Fiction',
            'code' => 'SF-001',
            'description' => 'A genre of speculative fiction that typically deals with imaginative and futuristic concepts.',
            'is_public' => true
        ];
    ?>

<body>
    <?php include '../includes/top_navbar.php'?> 

    <div class="d-flex font_change">
        <?php include '../includes/sidebar.php'?> 

        <div class="main-content w-100">
            <div class="container-fluid px-4">
                
                <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
                    <div class="breadcrumb-text">DASHBOARD > CATEGORYS > <span class="fw-bold">EDIT CATEGORY</span></div>
                    <a href="category_list.php">    
                        <button class="btn btn-outline-secondary btn-sm px-4">View categories</button>
                    </a>
                </div>

                <div class="row g-4">
                    <div class="col-xl-8">
                        <div class="main-card shadow-sm">
                            <h2 class="mb-4 font" style="color: #2c3e50;">Update Category</h2>
                            <?php
                            // 1. Get data from URL parameters
                            $cat_id = $_GET['id'] ?? '';
                            $cat_name = $_GET['name'] ?? '';
                            ?>

                            <form action="../action/category_action.php" method="POST">
                                <input type="hidden" name="cat_id" value="<?= htmlspecialchars($cat_id) ?>">

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Category Name</label>
                                        <input type="text" class="form-control shadow-none" name="cat_name" 
                                            value="<?= htmlspecialchars($cat_name) ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Category code</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control shadow-none" name="cat_code" 
                                                value="<?= htmlspecialchars($cat_id) ?>">
                                            <span class="input-group-text bg-white"><i class="bi bi-grid-3x3-gap"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center gap-3">
                                    <button type="button" class="btn btn-cancel px-5 py-2" onclick="history.back()">Cancel</button>
                                    <button type="submit" name="action" value="update" class="btn btn-register px-5 py-2">Update Category</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    </div>
                </div>
                <div class="h-25 d-inline-block"></div>
                <div class="mt-2 w-100">
                <?php include '../includes/footer_banner.php' ?>
            </div>
            </div>
        </div>
    </div>
</body>
</html>