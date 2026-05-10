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
            <h2 class="mb-4">Book Catalog</h2>

            <div class="card bg-body-tertiary">
                <div class="card-body">

                    <div class="container">
                            <a class="btn btn btn-secondary" href="books/newBook.php">Add New Book</a>
                            <br><br>

                            <table class="table table-hover">
                                    <thead class="table-success">
                                        <tr>
                                        
                                        <th scope="col">Book ID</th>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Book Category</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                        $sql="SELECT book_id, book_name, category_id FROM book";
                                        $result=$conn->query($sql);

                                        /* echo "No of Books: " . $result->num_rows . "<br>"; */
                                        if($result->num_rows >0){
                                        while($row=$result->fetch_assoc()){
                                            echo "<tr>
                                            <td>" .$row["book_id"] . "</td>
                                            <td>" . $row["book_name"] . "</td>
                                            <td>" . $row["category_id"] . "</td>
                                            <td>

                                            <button type='button' class='btn btn-primary'>
                                                            <i class='bi bi-pencil-square'></i>
                                                            </button>

                                            <button type='button' class='btn btn-danger'>
                                                            Delete 
                                                            </button>
                                            </tr>";
                                            }
                                        }
                                        ?>
                                        
                                    </tbody>
                            </table>
                    </div>
                 </div>
            </div>
        </div>
    </div>



    
</body>
</html>