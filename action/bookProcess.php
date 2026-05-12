<?php
include "../includes/db_config.php";



if (isset($_POST['book_id']) && isset($_POST['book_name']) && isset($_POST['category_id'])) {

    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $category_id=$_POST['category_id'];

    $checksql="SELECT book_id FROM book WHERE book_id='$book_id'";
    $result =$conn->query($checksql);

    if($result->num_rows>0){
        header("Location: ../books/newBook.php ? status=duplicate");
        exit();
    }else{
        $sql = "INSERT INTO book (book_id, book_name, category_id) VALUES ('$book_id', '$book_name','$category_id')";

        if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: ../books/books.php");
        exit();
        //didnt' add a notification to books page.

    } else {
        echo "Error: ".$conn->error;
        $conn->close();
    }


    }
}

?>