<?php                                                                      
// Ted Kim                                                          
// Web Programming II - PHP                                                
// Fall 2018                                                               
// Practical Test 1   
$conn = mysqli_connect('localhost:8889', 'root', 'root') or die(mysql_error()); 
$db = mysqli_select_db($conn, "registration") or die(mysql_error());     
?>
