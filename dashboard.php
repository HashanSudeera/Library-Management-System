<?php

include 'includes/db_config.php';
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$where_clause = "";
if ($search != '') {
    // This filters the results based on what you type
    $where_clause = " WHERE first_name LIKE '%$search%'
                     OR user_id LIKE '%$search%'
                      OR last_name LIKE '%$search%' 
                      OR username LIKE '%$search%' 
                      OR email LIKE '%$search%'";
}

$limit = 5; // Number of records per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

//fetch all count
$count_res = mysqli_query($conn, "SELECT COUNT(*) as total FROM user");
$total_staff = mysqli_fetch_assoc($count_res)['total'];
$total_pages = ceil($total_staff / $limit);

//fetch all staff members
$sql = "SELECT * FROM user $where_clause ORDER BY user_id asc LIMIT $offset, $limit   ";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>

<?php include 'includes/header.php' ?>

<body>

    <?php include 'includes/top_navbar.php' ?>


    <div class="d-flex">

        <?php include 'includes/sidebar.php' ?>

        <div class="main-content flex-grow-1 p-4">


            <div class="row align-items-center mb-4">

                <div class="col-md-8 d-flex gap-4 font_change w-25">
                    <div class="card custom_card border-0 shadow-sm flex-fill p-2 rounded-3 ">
                        <div class="card dashboard-card h-100 p-3">
                            <small class="text-muted fs-3 text-uppercase">Total Staff</small>
                            <h1 class="display-4 fw-bold mt-2"><?php echo $total_staff; ?></h1>
                        </div>
                    </div>

                    
                </div>

            </div>

            <div class="card border-0 shadow-sm bg-body-tertiary p-4 rounded-4">

                <form action="dashboard.php" method="GET" class="mb-4">
                <div class="d-flex justify-content-between align-items-center bg-body-tertiary p-3 rounded-3 shadow-sm border border-opacity-10">

                    <div class="input-group w-auto bg-body rounded-pill border px-2 py-1 align-items-center font_change">
                        <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none" placeholder="Search records..." 
                               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button class="btn border-0 text-muted" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                </div>
                </form>

                <div class="table-responsive px-2">
                    <table class="table table-hover align-middle border-0 text-center mb-0 font_change">
                        <thead class="custom-table-header font_change">
                            <tr>
                                <th scope="col">User_ID</th>
                                <th scope="col">First name</th>
                                <th scope="col">Last name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email Address</th>

                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            <?php 
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td ><?php echo $row['user_id']; ?></td>
                                        <td><?php echo $row['first_name']; ?></td>
                                        <td><?php echo $row['last_name']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                    </tr>
                                    <?php 
                                } 
                            } 
                            ?>
                            
                        </tbody>
                    </table>
                </div>
                <?php if ($total_pages > 1): ?>
                <nav class="mt-4">
                    <ul class="pagination justify-content-center custom_pagination">
                        <li class="page-item paging <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo $search; ?>">Previous</a>
                        </li>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo $search; ?>">Next</a>
                        </li>
                    </ul>
                </nav>
                <?php endif; ?>

            </div>
        </div>
    </div>

</body>

</html>