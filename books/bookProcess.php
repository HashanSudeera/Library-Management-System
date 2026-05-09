<?php

echo "welcome bookprocess";
include "db_config.php";

if (isset($_POST['book_id']) && isset($_POST['book_name'])) {

    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];

    print "Name: " . $book_id . "<br>";
    print "book_name: " . $book_name . "<br>";

    $sql = "INSERT INTO book (book_id, book_name) VALUES ('$book_id', '$book_name')";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    //redirect to index php

    header("Location: books/books.php");

}

?>