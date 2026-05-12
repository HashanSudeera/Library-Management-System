<?php
include '../includes/db_config.php';
?>
<?php
// Query to count total rows in the member table
$count_sql = "SELECT COUNT(*) as total FROM member";
$count_result = $conn->query($count_sql);
$total_members = 0;

if ($count_result && $row = $count_result->fetch_assoc()) {
    $total_members = $row['total'];
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include '../includes/header.php' ?>

<body>
    <?php include '../includes/top_navbar.php' ?>

    <div class="d-flex">

        <?php include '../includes/sidebar.php' ?>

        <div class="main-content flex-grow-1 p-4">

            <nav aria-label="breadcrumb" class="font_change">
                <ol class="breadcrumb mb-3 fs-6">
                    <li class="breadcrumb-item text-muted">Member</li>
                    <li class="breadcrumb-item active" aria-current="page">Member details</li>
                </ol>
            </nav>

            <div class="row align-items-center mb-4">

                <div class="col-md-8 d-flex gap-4 font_change">
                    <div class="card custom_card border-0 shadow-sm flex-fill p-2 rounded-3">
                        <div class="card-body py-2 ">
                            <div class="d-flex align-items-center mb-1">
                                <i class="bi bi-folder2-open text-muted me-2 fs-5"></i>
                                <span class="text-muted fw-medium fs-6">Total members </span>
                            </div>
                            <h3 class="mb-0 fw-bold fs-2"><?php /** @var mysqli_result $total_members */  echo "{$total_members}" ?></h3>
                        </div>
                    </div>

                </div>

                <div class="col-md-4 text-end">
                    <a href="addmember.php" class="btn btn-add-record px-4 py-3 fw-medium shadow-sm">
                        <i class="bi bi-plus-circle me-2"></i> Add New Member
                    </a>
                </div>
            </div>

            <div class="card border-0 shadow-sm bg-body-tertiary p-4 rounded-4">

                <form action="borrow.php" method="GET" class="mb-4">
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
                    <table class="table table-hover align-middle border-0 text-center mb-0">
                        <thead class="custom-table-header font_change">
                            <tr>
                                <th class="py-3 px-4 rounded-start border-0 fw-medium">Member Id</th>
                                <th class="py-3 border-0 fw-medium text-start">First Name </th>
                                <th class="py-3 border-0 fw-medium text-start">Last Name</th>
                                <th class="py-3 border-0 fw-medium">E-mail Address</th>
                                <th class="py-3 border-0 fw-medium">Birthday</th>
                                <th class="py-3 px-4 text-center rounded-end border-0 fw-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">

                            <?php
                $sql = "SELECT* FROM member";
                $result = $conn->query($sql);

                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                                    echo "<tr>";
                                    echo "  <td class='px-4 py-3 border-bottom border-opacity-10 font_change'>{$row['member_id']}</td>";
                                    echo "  <td class='text-start border-bottom border-opacity-10 font_change'>{$row['first_name']}</td>";
                                    echo "  <td class='text-start border-bottom border-opacity-10 font_change'>{$row['last_name']}</td>";
                                    echo "  <td class='text-start border-bottom border-opacity-10 font_change'>{$row['email']}</td>";
                                    echo "  <td class='text-start border-bottom border-opacity-10 font_change'>{$row['birthday']}</td>";
                                    echo "  <td class='text-center border-bottom border-opacity-10'>
                                                <a href='member_edit.php?id={$row['member_id']}' class='text-muted text-decoration-none me-3'>
                                                <i class='bi bi-pencil-square fs-5'></i>
                                                </a> 

                                                <a href='../actions/member_action.php?delete_id={$row['member_id']}' 
                                                    class='text-muted text-decoration-none' 
                                                    onclick=\"return confirm('Are you sure you want to delete this record? This action cannot be undone.');\">
                                                <i class='bi bi-trash fs-5'></i>
                                                </a>
                                            </td>";
                                    echo "</tr>";
                    }
                }

                ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


</body>

</html>