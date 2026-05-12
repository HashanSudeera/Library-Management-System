<?php
include '../includes/db_config.php';

// --- HANDLE DELETING CATEGORY ---
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    
    $sql = "DELETE FROM bookcategory WHERE category_id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: ../categories/category_list.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// 2. UPDATE CATEGORY (POST Request)
if (isset($_POST['action']) && $_POST['action'] === 'update') {
    $category_id   = $_POST['cat_code']; 
    $old_id        = mysqli_real_escape_string($conn, $_POST['cat_id']);
    
    // --- Validation 1: Regex Format ---
    if (!preg_match("/^C\d{3}$/", $category_id)) {
        header("Location: ../categories/category_list.php?msg=invalid_format");
        exit();
    }

    // --- Validation 2: Check for Duplicate ID ---
    // We check if the NEW id exists, but ignore the ID of the record we are currently editing
    $clean_new_id = mysqli_real_escape_string($conn, $category_id);
    $check_query = "SELECT category_id FROM bookcategory WHERE category_id = '$clean_new_id' AND category_id != '$old_id'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        header("Location: ../categories/category_list.php?msg=exists");
        exit();
    }

    $category_name = mysqli_real_escape_string($conn, $_POST['cat_name']);
    $date_modified = date('Y-m-d H:i:s');

    $sql = "UPDATE bookcategory 
            SET category_id = '$clean_new_id', 
                category_Name = '$category_name', 
                date_modified = '$date_modified' 
            WHERE category_id = '$old_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../categories/category_list.php?msg=updated");
        exit(); 
    } else {
        echo "Error updating category: " . mysqli_error($conn);
        exit();
    }
}

// 3. ADD CATEGORY (POST Request)
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST['cat_code'];

    // --- Validation 1: Regex Format ---
    if (!preg_match("/^C\d{3}$/", $category_id)) {
        header("Location: ../categories/category_list.php?msg=invalid_format");
        exit();
    }

    // --- Validation 2: Check for Duplicate ID ---
    $clean_id = mysqli_real_escape_string($conn, $category_id);
    $check_query = "SELECT category_id FROM bookcategory WHERE category_id = '$clean_id'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        header("Location: ../categories/category_list.php?msg=exists");
        exit();
    }

    $category_Name = mysqli_real_escape_string($conn, $_POST['cat_name']);
    $date_modified = date('Y-m-d h:i:sa');

    $sql = "INSERT INTO bookcategory (category_id, category_Name, date_modified) 
            VALUES ('$clean_id', '$category_Name', '$date_modified')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../categories/category_list.php?msg=added");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }
}
?>