<?php 
     include '../includes/db_config.php';
    ?>

<base href="../">
<!DOCTYPE html>
<html>
    <?php include '../includes/header.php';  ?>

<body>
    <?php 
     include '../includes/top_navbar.php';
    ?>

    <div class="d-flex">
        <?php include '../includes/sidebar.php';?>

        <div class="main-content flex-grow-1 p-4">
            <h2 class="mb-4">Register a New Book</h2>


            <div class="card bg-body-tertiary">
                <div class="card-body">
                  <form method="post">

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-lable">Book ID</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="book_id" value="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-lable">Book Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-lable">Book Category</label>
                        <div class="col-sm-6">

                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Category
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>    

                        </div>
                    </div>

                  </form>
                </div>

               
                    
  


    
</body>
</html>