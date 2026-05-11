<?php
//connect DB
include '../includes/db_config.php';


if (isset($_POST['add_borrow'])) {

    $borrow_id = $_POST['borrow_id'];
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $borrow_status = $_POST['borrow_status'];


    $check_book = "SELECT * FROM book WHERE book_id = '$book_id'";
    $book_result = mysqli_query($conn, $check_book);
    if (mysqli_num_rows($book_result) == 0) {
        // Book does not exist! Send them back with an error.
        header("Location: ../borrow/borrow_add_form.php?error=book_not_found");
        exit();
    }

    // 2. Check if Member exists
    $check_member = "SELECT * FROM member WHERE member_id = '$member_id'";
    $member_result = mysqli_query($conn, $check_member);
    if (mysqli_num_rows($member_result) == 0) {
        // Member does not exist! Send them back with an error.
        header("Location: ../borrow/borrow_add_form.php?error=member_not_found");
        exit();
    }

    $date_modified = date('Y-m-d H:i:s');


    $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified) 
            VALUES ('$borrow_id', '$book_id', '$member_id', '$borrow_status', '$date_modified')";

    // 5. Execute the query and check if it was successful
    if (mysqli_query($conn, $sql)) {
        header("Location: ../borrow/borrow_add_form.php?status=success");
        exit();
    } else {
        echo "Error adding record: " . mysqli_error($conn);
    }
}



if (isset($_POST['update_borrow'])) {

    // 1. Grab and sanitize the data
    $borrow_id = mysqli_real_escape_string($conn, $_POST['borrow_id']);
    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
    $member_id = mysqli_real_escape_string($conn, $_POST['member_id']);
    $borrow_status = mysqli_real_escape_string($conn, $_POST['borrow_status']);

    // 2. DEFINE THE REGULAR EXPRESSION PATTERNS
    $book_pattern = "/^B[0-9]{3}$/";
    $member_pattern = "/^M[0-9]{3}$/";

    // Setup the base URL for errors so it remembers which ID we are editing
    $error_redirect = "Location: borrow_update.php?id=$borrow_id&error=";

    // 3. VALIDATE THE INPUTS
    if (!preg_match($book_pattern, $book_id)) {
        header($error_redirect . "invalid_book_id");
        exit();
    }

    if (!preg_match($member_pattern, $member_id)) {
        header($error_redirect . "invalid_member_id");
        exit();
    }

    // 4. WRITE THE SQL UPDATE QUERY
    $date_modified = date('Y-m-d H:i:s');
    $sql = "UPDATE bookborrower 
                SET book_id = '$book_id', 
                    member_id = '$member_id', 
                    borrow_status = '$borrow_status', 
                    borrower_date_modified = '$date_modified' 
                WHERE borrow_id = '$borrow_id'";

    // 5. USE TRY-CATCH TO HANDLE FATAL ERRORS (Like missing books/members)
    try {
        // Try to execute the update
        mysqli_query($conn, $sql);

        // If it succeeds, show the JS alert and redirect back to the table
        echo "<script>
                    alert('Data updated successfully!');
                    window.location.href = '../borrow/borrow.php';
                  </script>";
        exit();
    } catch (mysqli_sql_exception $e) {
        // Catch ERROR 1452: Foreign Key Constraint Failure
        if ($e->getCode() == 1452) {
            // Check if the error was caused by the Book ID or Member ID
            if (strpos($e->getMessage(), 'book_id') !== false) {
                header($error_redirect . "book_not_found");
            } else {
                header($error_redirect . "member_not_found");
            }
            exit();
        }
        // Catch any other unexpected database errors safely
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
