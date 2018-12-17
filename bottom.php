
<script src="<?php echo $base_URL ?>commons/js/jquery-3.1.1.js"></script>
<script src="<?php echo $base_URL ?>commons/js/jquery-ui.js"></script>
<script src="<?php echo $base_URL ?>commons/js/popper.min.js"></script>
<script src="<?php echo $base_URL ?>commons/js/bootstrap.min.js"></script>
<script src="<?php echo $base_URL ?>commons/js/jquery.dataTables.js"></script>
<script src="<?php echo $base_URL ?>commons/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $base_URL ?>commons/js/fa-solid.js"></script>
<script src="<?php echo $base_URL ?>commons/js/fontawesome-all.js"></script>
<script src="<?php echo $base_URL ?>js/medical4u.js"></script>
<script src="<?php echo $base_URL ?>js/validate.js"></script>
<?php if(isset($_SESSION['page_name']) && $_SESSION['page_name'] != null && $_SESSION['page_name'] != ''){
    echo '<script src="'.$base_URL.'js/'.$_SESSION['page_name'].'.js"></script>';
} ?>


