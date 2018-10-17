<?php
//    $base_URL = ($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
    $base_URL = 'http://';
    $base_URL .= $_SERVER['HTTP_HOST'];
    $base_URL .= "/Exam1";
?>
<nav class="col-md-2 d-none d-md-block navbar-dark bg-dark sidebar">
    <div class="sidebar-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Dashboard</span>
            <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
            </a>
        </h6>        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/orders/index.php' ?>"><span data-feather="file"></span><i class="material-icons">fastfood</i> Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/customers/index.php' ?>"><span data-feather="file"></span><i class="material-icons">face</i> Customers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/products/index.php' ?>"><span data-feather="file"></span><i class="material-icons">local_offer</i> Products</a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Admin</span>
            <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
            </a>
        </h6>        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/categories/index.php' ?>"><span data-feather="file"></span><i class="material-icons">view_column</i> Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/employees/index.php' ?>"><span data-feather="file"></span><i class="material-icons">assignment_ind</i> Employees</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/shippers/index.php' ?>"><span data-feather="file"></span><i class="material-icons">local_shipping</i> Shippers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/suppliers/index.php' ?>"><span data-feather="file"></span><i class="material-icons">person_pin</i> Suppliers</a>
            </li>
        </ul>
        
    </div>
</nav>