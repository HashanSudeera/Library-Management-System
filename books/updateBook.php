<?php
include "../includes/db_config.php";



if (isset($_POST['book_id']) && isset($_POST['book_name']) && isset($_POST['category_id'])) {

    $book_id = $_POST['book_id'];    
    $book_name = $_POST['book_name'];
    $category_id=$_POST['category_id'];

    
        $sql = "UPDATE  book  SET book_name='$book_name' ,  category_id='$category_id' WHERE book_id='$book_id' ";

        if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: books.php");
        exit();
        //didnt' add a notification to books page.

         } else {
        echo "Error: ".$conn->error;
        $conn->close();
          }


    }


?>