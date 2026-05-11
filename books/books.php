<?php 
     include '../includes/db_config.php';

        $limit=12;
        $page=isset($_GET['page'])? (int)$_GET['page']:1;
        $offset=($page-1)*$limit;

        $sql="SELECT * FROM book LIMIT $limit OFFSET $offset";
        $result= mysqli_query($conn, $sql);

        $total_result= mysqli_query($conn,"SELECT COUNT(book_id) AS total FROM book");
        $total_books=mysqli_fetch_assoc($total_result)['total'];
        $total_pages=ceil($total_books/$limit);
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
            <p class="mb-4">Recently added books for quick review and management.</p>
<div class="card-body">

           <div class="card bg-body-tertiary shadow-sm">
    <div class="card-body">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            

           
                <div class="card border-dark mb-3 text-center card w-75 mb-3 " style="max-width: 18rem;">
                    <p class="card-header">Total Books</p>
                    <h5 class="card-title"><?php echo $total_books; ?></h5>
                </div>
            

            <a href="books/newBook.php" class="btn text-white px-6 btn-lg " style="background-color: var(--brown-900); border-radius: 8px;">
                <i class="bi bi-plus-circle me-2"></i>Add New Book
            </a>
        </div>
            

                            <table class="table table-hover">

                                    <thead class="custom-header">
                                        <tr class="table-active">
                                        <th scope="col">Book ID</th>
                                        <th scope="col">Book Name</th>
                                        <th scope="col">Book Category</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody class="table-group-divider">

                                        <?php
                                        /* $sql="SELECT book_id, book_name, category_id FROM book";
                                        $result=$conn->query($sql);

                                        /* echo "No of Books: " . $result->num_rows . "<br>"; */
                                        if($result->num_rows >0){ 
                                        while($row=$result->fetch_assoc()){
                                            echo "<tr>
                                            <td>" .$row["book_id"] . "</td>
                                            <td>" . $row["book_name"] . "</td>
                                            <td>" . $row["category_id"] . "</td>
                                            <td>

                                            <a href='./books/editBook.php?id=" . $row['book_id']. "' class='btn btn-light'>
                                                            <i class='bi bi-pencil-square'></i>
                                            </a>

                                            <a href='./books/deleteBook.php?id=" . $row['book_id']. "' class='btn btn-light' onclick='return confirm(\"Are you sure? \")'>
                                                            <i class='bi bi-trash3'></i>
                                            </a>
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


<ul class="pagination justify-content-center" >
    <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
        <a href="books/books.php?page=<?php echo $page - 1; ?>" class="page-link"> Previous  </a>
    </li>
    <?php for($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?php if($page == $i){ echo 'active'; } ?>">
            <a class="page-link" href="books/books.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        </li>
    <?php endfor; ?>

    <li class="page-item <?php if($page >= $total_pages){ echo 'disabled'; } ?>">
        <a class="page-link" href="books/books.php?page=<?php echo $page + 1; ?>">Next</a>
    </li>

</ul>


    
</body>
</html>