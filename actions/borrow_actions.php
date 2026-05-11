<?php
//connect DB
include '../includes/db_config.php';


if (isset($_POST['add_borrow'])) {

    //get add borrow form details
    $borrow_id = $_POST['borrow_id'];
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $borrow_status = $_POST['borrow_status'];

    //check borrow ID UNIQ
    $check_borrow = "SELECT * FROM bookborrower WHERE borrow_id = '$borrow_id'";
    $borrow_result = mysqli_query($conn, $check_borrow);
    if (mysqli_num_rows($borrow_result) > 0) {
        header("Location: ../borrow/borrow_add_form.php?error=duplicate_borrow_id");
        exit();
    }

    //Check book if exist
    $check_book = "SELECT * FROM book WHERE book_id = '$book_id'";
    $book_result = mysqli_query($conn, $check_book);
    if (mysqli_num_rows($book_result) == 0) {
        // send error using header
        header("Location: ../borrow/borrow_add_form.php?error=book_not_found");
        exit();
    }

    //Check if Member exists
    $check_member = "SELECT * FROM member WHERE member_id = '$member_id'";
    $member_result = mysqli_query($conn, $check_member);
    if (mysqli_num_rows($member_result) == 0) {
        // Member does not exist! Send them back with an error.
        header("Location: ../borrow/borrow_add_form.php?error=member_not_found");
        exit();
    }

    //get system date
    $date_modified = date('Y-m-d H:i:s');


    $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified) 
            VALUES ('$borrow_id', '$book_id', '$member_id', '$borrow_status', '$date_modified')";


    if (mysqli_query($conn, $sql)) {
        header("Location: ../borrow/borrow_add_form.php?status=success");
        exit();
    } else {
        echo "Error adding record: " . mysqli_error($conn);
    }
}



if (isset($_POST['update_borrow'])) {

    // 1. Grab and sanitize the data
    $borrow_id = $_POST['borrow_id'];
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $borrow_status = $_POST['borrow_status'];

    //error header path
    $error_redirect = "Location: borrow_update.php?id=$borrow_id&error=";

    
    $date_modified = date('Y-m-d H:i:s');

    $sql = "UPDATE bookborrower 
                SET book_id = '$book_id', 
                    member_id = '$member_id', 
                    borrow_status = '$borrow_status', 
                    borrower_date_modified = '$date_modified' 
                WHERE borrow_id = '$borrow_id'";

    try {
        //send update query
        mysqli_query($conn, $sql);

        header("Location: ../borrow/borrow_edit.php?id=$borrow_id&status=updated");
        exit();
    } catch (mysqli_sql_exception $e) {
        // Catch ERROR Foreign Key Constraint Failure
        if ($e->getCode() == 1452) {
            if (strpos($e->getMessage(), 'book_id') !== false) {
                header($error_redirect . "book_not_found");
            } else {
                header($error_redirect . "member_not_found");
            }
            exit();
        }

        else {
            echo "Database Error: " . $e->getMessage();
        }
}

} elseif (isset($_GET['delete_id'])) {

    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);

    $sql = "DELETE FROM bookborrower WHERE borrow_id='$delete_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../borrow/borrow.php?status=deleted");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: borrow.php");
    exit();
}
