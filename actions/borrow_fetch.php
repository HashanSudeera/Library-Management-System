<?php
// 1. Include the database connection
include '../includes/db_config.php'; 


$borrowed_query = "SELECT COUNT(*) AS total FROM bookborrower WHERE borrow_status = 'Borrowed'";
$borrowed_result = mysqli_query($conn, $borrowed_query);
$borrowed_count = mysqli_fetch_assoc($borrowed_result)['total'];

$available_query = "SELECT COUNT(*) AS total FROM bookborrower WHERE borrow_status = 'Available'";
$available_result = mysqli_query($conn, $available_query);
$available_count = mysqli_fetch_assoc($available_result)['total'];

$search_query = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$status_filter = isset($_GET['filter_status']) ? mysqli_real_escape_string($conn, $_GET['filter_status']) : 'All';


$table_sql = "SELECT 
                bb.borrow_id, 
                bb.book_id, 
                bb.borrow_status, 
                bb.borrower_date_modified,
                b.book_name, 
                m.first_name, 
                m.last_name
            FROM bookborrower bb
            JOIN book b ON bb.book_id = b.book_id
            JOIN member m ON bb.member_id = m.member_id
            WHERE 1=1";

// 3. Apply Status Filter (If they selected 'Borrowed' or 'Available')
if ($status_filter != 'All') {
    $table_sql .= " AND bb.borrow_status = '$status_filter'";
}

// 4. Apply Search Bar (Checks Book Name, Member First/Last Name, or Borrow ID)
if (!empty($search_query)) {
    $table_sql .= " AND (b.book_name LIKE '%$search_query%' 
                      OR m.first_name LIKE '%$search_query%' 
                      OR m.last_name LIKE '%$search_query%'
                      OR bb.borrow_id LIKE '%$search_query%'
                      OR bb.borrower_date_modified LIKE '%$search_query%')";
}

// 5. Add the final sort order
$table_sql .= " ORDER BY bb.borrow_id ASC";

$table_result = mysqli_query($conn, $table_sql);
?>