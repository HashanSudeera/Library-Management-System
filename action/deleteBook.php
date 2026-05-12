<?php 
include "../includes/db_config.php";

if (isset($_GET['id'])){
    $book_id = mysqli_real_escape_string($conn, $_GET['id']);

    try {
        $sql = "DELETE FROM book WHERE book_id = '$book_id'";
        
        if($conn->query($sql) === TRUE){
            header("Location: ../books/books.php?status=deleted");
            exit(); 
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451) {
            header("Location: ../books/books.php?status=restricted");
        } else {
            header("Location: ../books/books.php?status=error");
        }
        exit();
    }
}
?>