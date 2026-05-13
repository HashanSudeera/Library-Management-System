<?php 
     include '../includes/db_config.php';

        $limit=12;

        $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
        
        $allowed_columns = ['book_id', 'book_name', 'category'];
        $sort = isset($_GET['sort']) && in_array($_GET['sort'], $allowed_columns) ? $_GET['sort'] : 'book_id';
        $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';
        
        $page=isset($_GET['page'])? (int)$_GET['page']:1;
        $offset=($page-1)*$limit;

        $whereClause = "";
         if (!empty($search)) {
        $whereClause = " WHERE book_name LIKE '%$search%' OR book_id LIKE '%$search%'";
    }

        $sql="SELECT 
        book.book_id, 
        book.book_name, 
        bookcategory.category_name 
        FROM book JOIN bookcategory 
        ON book.category_id = bookcategory.category_id " . $whereClause . " ORDER BY $sort $order LIMIT $limit OFFSET $offset";
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

<div class="d-flex font_change">
        <?php include '../includes/sidebar.php';?>

        <div class="main-content flex-grow-1 p-4">

            <nav aria-label="breadcrumb" class="font_change">
                <ol class="breadcrumb mb-3 fs-6">
                    <li class="breadcrumb-item text-muted">Book Catalog</li>
                    <li class="breadcrumb-item active" aria-current="page">Book Records</li>
                </ol>
            </nav>    
  
    
        
        <div class="d-flex justify-content-between   p-3 rounded-3 ">
        
                <div class="card custom_card border-0 shadow-sm w-180 p-2 rounded-3">
                        <div class="card-body py-2 ">
                            <div class="d-flex align-items-center mb-1">
                                <i class="bi bi-book text-muted me-2 fs-5"></i>
                                <span class="text-muted fw-medium fs-6">Total Books</span>
                            </div>
                            <h3 class="card-title"><?php echo $total_books; ?></h5>
                        </div>
                    </div>

                    <div class="col-md-4 text-end">
                        <a href="books/newBook.php" class="btn text-white px-6 btn-lg " style="background-color: var(--brown-900); border-radius: 8px;">
                            <i class="bi bi-plus-circle me-2"></i>Add New Book
                        </a>
                    </div>
        </div>
        

<div class="card border-0 shadow-sm bg-body-tertiary p-4 rounded-4"> <!-- flex around the table and search box -->

<div class="d-flex justify-content-between  bg-body-tertiary p-3 rounded-3 shadow-sm border border-opacity-10">

                    <div class="col-md-4">
                        <!-- <select class="form-select rounded-pill" onchange="location = this.value;">
                            <option value="books/books.php?sort=book_id&order=ASC">Sort by ID</option>
                            <option value="books/books.php?sort=book_name&order=ASC">Sort by Name (A-Z)</option>
                            <option value="books/books.php?sort=book_name&order=DESC">Sort by Name (Z-A)</option>
                        </select> -->
                    </div>

                    <form action="books/books.php" method="GET" class="d-flex">  <!-- Search button -->
                        <div class="input-group">
                            <button class="btn border border-end-0 rounded-start-pill bg-white" type="submit">
                                <i class="bi bi-search text-muted"></i>
                            </button>
                            <input type="text" name="search" class="form-control border-start-0 rounded-end-pill" placeholder="Search books..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                        </div>
                    </form>
    
</div>


        

            
                      <div class="border rounded-3 overflow-hidden shadow-sm mt-5">  

                      <?php if (isset($_GET['status']) && $_GET['status'] == 'restricted'): ?>
                            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>Action Denied!</strong> This book is currently being borrowed and cannot be deleted until the record is cleared.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        
                            <table class="table table-hover mb-0 custom-header">

                                    <thead >
                                        <tr  >
                                        <th scope="col"  >Book ID</th>
                                        <th scope="col" >Book Name</th>
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
                                            <td>" . $row["category_name"] . "</td>
                                            <td>

                                            <a href='./books/editBook.php?id=" . $row['book_id']. "' class='btn btn-light'>
                                                            <i class='bi bi-pencil-square'></i>
                                            </a>

                                            <a href='./action/deleteBook.php?id=" . $row['book_id']. "' class='btn btn-light' onclick='return confirm(\"Are you sure? \")'>
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
    </div>
</div>


    
</body>
</html>