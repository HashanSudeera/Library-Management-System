<?php 
     include '../includes/db_config.php';
    ?>


<!DOCTYPE html>
<base href="../">
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
                  <form action="books/bookProcess.php" method="post">

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-lable">Book ID</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="book_id" value="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-lable">Book Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="book_name" value="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-lablel">Book Category</label>
                        <div class="col-sm-6">

                                     <div class="col-sm-6">
                                    <select name="category" class="form-select">
                                        <option value="" selected disabled>Select Category</option>
                                        <option value="fiction">Fiction</option>
                                        <option value="non-fiction">Non-Fiction</option>
                                        <option value="educational">Educational</option>
                                    </select>
                                </div>   

                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                  </form>
                </div>

               
                    
  


    
</body>
</html>