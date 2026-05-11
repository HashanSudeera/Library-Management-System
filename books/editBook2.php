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

        <div class="main-content flex-grow-1 d-flex flex-column p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4 fs-6">
                    <li class="breadcrumb-item text-muted">Book Catalog</li>
                    <li class="breadcrumb-item text-muted" aria-current="page">Book Records</li>
                    <li class="breadcrumb-item active" aria-current="page">Update Book</li>
                </ol>
            </nav>


            <div class="row align-items-start">
                <div class="col-lg-8 mb-4" >
                    <div class="custom-form-card p-5 rounded-3 shadow-sm" style="background-color: var(--brown-50);">
                         <h2 class="fw-bold mb-1" style="color: var(--brown-900);">Update Existing Book</h2>
                         <hr class="mb-4" style="border-color: var(--brown-600);">
                           

                  <form action="books/bookProcess.php" class="needs-validation" novalidate method="post">

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

                                     <div class="col-sm-6 w-auto" >
                                    <select name="category_id" class="form-select" required>
                                        
                                        <?php
                                          $sql = "SELECT * FROM bookcategory";
                                            $result = $conn->query($sql);         
                                            if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                            $selected =($row['category_id'] ==$book['category_id'])? "selected" : "" ;
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
                        <button type="submit" class="btn btn-primary" style="background-color: var(--blue-700); width: 150px;">Submit</button>
                    </div>

                  </form>
                </div>

                <?php if (isset($_GET['status']) && $_GET['status'] == 'duplicate'): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 20px;">
                <strong>Invalid Book ID:</strong> Duplicate entry found! 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                </div>
   <div class="col-lg-4 ">
                    <div class="p-4 rounded-3 shadow-sm border border-opacity-10 p-3" style="background-color: var(--blue-200);">
                        <div class="d-flex align-items-center mb-4">
                            <i class="bi bi-info-circle fs-4 me-2" style="color: var(--brown-800);"></i>
                            <h4 class="fw-bold mb-0" style="color: var(--blue-900);">Filing Guidelines</h4>
                        </div>
                        <div class="guideline-item mb-4">
                            <h6 class="fw-bold mb-1" style="color: var(--blue-800);">Book ID Validation</h6>
                            <ul class="mb-0 ps-3" style="color: var(--blue-800); font-size: 0.9rem;">
                                <li>Format: Must start with 'B' followed by numbers (e.g., B001).</li>
                            </ul>
                        </div>
                        <div class="guideline-item mb-4">
                            <h6 class="fw-bold mb-1" style="color: var(--blue-800);">Book Category</h6>
                            <ul class="mb-0 ps-3" style="color: var(--blue-800); font-size: 0.9rem;">
                                <li>Ensure a Book Category is selected from the dropdown menu </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
  </div>
 
  </div>
  

</div>
<br>
                

               
            
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


    <div class="container">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <img src="..." class="rounded me-2" alt="...">
    <strong class="me-auto">Bootstrap</strong>
    <small>11 mins ago</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div>
    </div>
</body>
</html>