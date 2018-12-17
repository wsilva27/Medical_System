<?php 
//session_start();
include "conf/url.php" 
?>
<nav class="col-md-2 d-none d-md-block navbar-dark bg-dark sidebar">
    <div class="sidebar-sticky">
        <div class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span style="font-size: 4rem;"><i class="fas fa-user"></i></span>
            <div class="text-left" id="user-info" style="width: 9rem;line-height:25px">
<!--
                <span id="userinfo_name"></span><br>
                <a href="javscript:avoid(0);" onclick="secure.logout();" style="color:#fff;"><i class="fas fa-sign-out-alt"></i> log out</a>
-->
            </div>
        </div>

        
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Dashboard</span>
            <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
            </a>
        </h6>        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'views/schedules/' ?>"><span data-feather="file"></span><i class="fas fa-calendar-alt"></i> Schedules</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $base_URL.'views/patients/' ?>"><span data-feather="file"></span><i class="fas fa-id-card-alt"></i> Patients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:myProfile();"><span data-feather="file"></span><i class="fas fa-id-card-alt"></i> My Profile</a>
            </li>
        </ul>
        <div id="admin-menu"></div>
    </div>
</nav>
<script>
    var base_URL = "<?php echo $base_URL ?>";
</script>
