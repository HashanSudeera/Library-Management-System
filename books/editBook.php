<?php 
     include '../includes/db_config.php';

     if(isset($_GET['id'])){
        $id= mysqli_real_escape_string($conn, $_GET['id']);
        $sql="SELECT * FROM book WHERE book_id ='$id'";
        $result= $conn->query($sql);

        if ($result->num_rows>0){
            $book =$result->fetch_assoc();
        }else{
            echo "Book not Found!";
            exit();
        }

     }else{
            header("Location: books.php");
             exit();
     }
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
            <h2 class="mb-4">Update an Existing Book</h2>


            <div class="card bg-body-tertiary">
                <div class="card-body">


                  <form action="books/updateBook.php" class="needs-validation" novalidate method="post">

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-lablel">Book ID</label>
                        <div class="col-sm-6">
                            <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">
                            <input type="text" class="form-control" value="<?php echo $book['book_id']; ?>" disabled>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-lable">Book Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="book_name" value="<?php echo $book['book_name']; ?>" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please provide a valid Book Name</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-lablel">Book Category</label>
                        <div class="col-sm-6">

                                     <div class="col-sm-6">
                                    <select name="category_id" class="form-select" required>
                                       
                                        <?php
                                          $sql = "SELECT * FROM bookcategory";
                                            $result = $conn->query($sql);         
                                            if ($result->num_rows > 0) {
                                                 while($row = $result->fetch_assoc()) {
                                                $selected =($row['category_id'] ==$book['category_id'])? "selected" : "" ;
                                                 echo "<option value='" . $row['category_id'] . "' $selected >" .  $row['category_Name'] ."</option>";
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