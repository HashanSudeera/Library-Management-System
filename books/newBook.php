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
    

                  <form action="books/bookProcess.php" class="needs-validation" novalidate method="post">

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-lablel">Book ID</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="book_id" pattern="B\d{3}" placeholder="e.g., B001"required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please provide a valid Book ID (e.g., B001).</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-lable">Book Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="book_name" value="" placeholder="Potta Harry" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please provide a valid Book Name</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-lablel">Book Category</label>
                        <div class="col-sm-6">

                                     <div class="col-sm-6">
                                    <select name="category_id" class="form-select" required>
                                        <option value="" selected disabled>Select Category</option>
                                        <?php
                                          $sql = "SELECT * FROM bookcategory";
                                            $result = $conn->query($sql);         
                                            if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
               
                                            echo "<option value='" . $row['category_id'] . "'>" .  $row['category_Name'] ."</option>";
                                            }
                                             } else {
                                             echo "<option value=''>No categories found</option>";
                                            }
                                            ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Select a Category from the menu</div>
                                </div>   

                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                  </form>
                </div>

                <?php if (isset($_GET['status']) && $_GET['status'] == 'duplicate'): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 20px;">
                <strong>Invalid Book ID:</strong> Duplicate entry found! 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

               
            
                                <script>
                                
                                (function () {
                                    'use strict'  
                                    var forms = document.querySelectorAll('.needs-validation')              
                                    Array.prototype.slice.call(forms).forEach(function (form) {
                                    form.addEventListener('submit', function (event) {
                                   
                                    if (!form.checkValidity()) {
                                        event.preventDefault()   
                                        event.stopPropagation() 
                                    }

                                    form.classList.add('was-validated')
                                    }, false)
                                    })
                                    })()
                                </script>


    
</body>
</html>