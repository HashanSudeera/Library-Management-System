<?php include "../includes/db_config.php";

if (isset($_GET['id'])){
    $book_id =mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "DELETE FROM  book WHERE book_id = '$book_id'";

    if($conn->query($sql)==TRUE){
        header("Location: books.php?status=deleted");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>