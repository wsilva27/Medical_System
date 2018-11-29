<?php
session_start();
$_SESSION['idx'] = $_REQUEST['idx'];
echo json_encode("Success");
?>