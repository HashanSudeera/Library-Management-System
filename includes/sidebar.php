<?php
$current_page = basename($_SERVER['PHP_SELF']);

if(!defined('BASE_URL')){
    define('BASE_URL', 'http://localhost/web_project/Library-Management-System/'); 
}

?>

<div class="custom-sidebar bg-body-tertiary d-flex flex-column border-end">
    <ul class="nav flex-column mb-auto mt-1 pe-1">
        
        <li class="nav-item mb-1">
            <a href="<?php echo BASE_URL; ?>dashboard.php" class="nav-link custom-nav-link d-flex align-items-center gap-3 py-2 px-4 <?php echo ($current_page == 'dashboard.php') ? 'active-tab' : ''; ?>">
                <i class="bi bi-grid fs-5"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="books.php" class="nav-link custom-nav-link d-flex align-items-center gap-3 py-2 px-4 <?php echo ($current_page == 'books.php' || $current_page == 'add_book.php' || $current_page == 'edit_book.php') ? 'active-tab' : ''; ?>">
                <i class="bi bi-book fs-5"></i>
                Book Catalog
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="categories.php" class="nav-link custom-nav-link d-flex align-items-center gap-3 py-2 px-4 <?php echo ($current_page == 'categories.php') ? 'active-tab' : ''; ?>">
                <i class="bi bi-diagram-3 fs-5"></i>
                Categories
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="<?php echo BASE_URL; ?>member/member_details.php" class="nav-link custom-nav-link d-flex align-items-center gap-3 py-2 px-4 <?php echo ($current_page == 'addmember.php' || $current_page == 'member_details.php' || $current_page == 'member_edit.php') ? 'active-tab' : ''; ?>">
                <i class="bi bi-people fs-5"></i>
                Members
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="<?php echo BASE_URL; ?>borrow/borrow.php" class="nav-link custom-nav-link d-flex align-items-center gap-3 py-2 px-4 <?php echo ($current_page == 'borrow.php' || $current_page == 'borrow_add_form.php' || $current_page == 'borrow_edit.php') ? 'active-tab' : ''; ?>">
                <i class="bi bi-arrow-left-right fs-5"></i>
                Borrowing
            </a>
        </li>
        
    </ul>
</div>