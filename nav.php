<?php include "conf/url.php" ?>
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
                <a class="nav-link" href="<?php echo $base_URL.'/views/schedules/' ?>"><span data-feather="file"></span><i class="fas fa-calendar-alt"></i> Schedules</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/patients/' ?>"><span data-feather="file"></span><i class="fas fa-id-card-alt"></i> Patients</a>
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
                <a class="nav-link" href="<?php echo $base_URL.'/views/doctors/' ?>"><span data-feather="file"></span><i class="fas fa-user-md"></i> Doctors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/locations/' ?>"><span data-feather="file"></span><i class="fas fa-map"></i> Locations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/rooms/' ?>"><span data-feather="file"></span><i class="fas fa-hospital-alt"></i> Rooms</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/departments/' ?>"><span data-feather="file"></span><i class="fas fa-folder-open"></i> Departments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/specialties/' ?>"><span data-feather="file"></span><i class="fas fa-briefcase-medical"></i> Specialties</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'/views/users/' ?>"><span data-feather="file"></span><i class="fas fa-user"></i> Users</a>
            </li>
        </ul>
        
    </div>
</nav>
