<?php                                                                      
include "auth_user.inc.php";                                               
include "conn_inc.php";                                                    
// your_name_here                                                          
// Web Programming II - PHP                                                
// Fall 2018                                                               
// Practical Test 1                                                        
?>                                                                         
<html>                                                                     
<head>                                                                     
<title>The PHP Store</title>                                               
</head>                                                                    
<body>                                                                     
<h1>Update Account Information</h1>                                        
<p>                                                                        
  Here you can update your account information for viewing in your         
  profile.<br /><br />                                                     
<?php                                                                      
if (isset($_POST['submit']) && $_POST['submit'] == "Update") {             
  $query_update = "UPDATE user_info SET " .                                
                  "email = '" . $_POST['email'] . "', " .                  
                  "city = '" . $_POST['city'] . "', " .                    
                  "state = '" . $_POST['state'] . "', " .                  
                  "hobbies = 'nothing'" .                                  
                  " WHERE username = '" . $_SESSION['user_logged'] .       
                  "' AND password = (PASSWORD('" .                         
                  $_SESSION['user_password'] . "'))";                      
  $result_update = mysql_query($query_update)                              
    or die(mysql_error());                                                 
                                                                           
  $query = "SELECT * FROM user_info " .                                    
           "WHERE username = '" . $_SESSION['user_logged'] . "' " .        
           "AND password = (PASSWORD('" .                                  
           $_SESSION['user_password'] . "'))";                             
  $result = mysql_query($query)                                            
    or die(mysql_error());                                                 
                                                                           
  $row = mysql_fetch_array($result);                                       
  $hobbies = explode(", ", $row['hobbies'])                                
?>                                                                         
  <b>Your account information has been updated.</b><br />                  
  <a href="user_personal.php">Click here</a> to return to your account.    
  <form action="update_account.php" method="post">                         
    Email: <input type="text" name="email"                                 
             value="<?php echo $row['email']; ?>"><br />                   
    City: <input type="text" name="city"                                   
            value="<?php echo $row['city']; ?>"><br />                     
    State: <input type="text" name="state"                                 
            value="<?php echo $row['state']; ?>"><br />                    
    More Info:                                                             
    <input type="submit" name="submit" value="Update"> &nbsp;              
    <input type="button" value="Cancel" onclick="history.go(-1);">         
  </form>                                                                  
</p>                                                                       
<?php                                                                      
} else {                                                                   
  $query = "SELECT * FROM user_info " .                                    
           "WHERE username = '" . $_SESSION['user_logged']. "' " .         
           "AND password = (PASSWORD('" .                                  
           $_SESSION['user_password'] . "'));";                            
  $result = mysql_query($query)                                            
    or die(mysql_error());                                                 
                                                                           
  $row = mysql_fetch_array($result);                                       
  $hobbies = explode(", ", $row['hobbies'])                                
?>                                                                         
<p>                                                                        
  <form action="update_account.php" method="post">                         
    Email: <input type="text" name="email"                                 
             value="<?php echo $row['email']; ?>"><br />                   
    City: <input type="text" name="city"                                   
            value="<?php echo $row['city']; ?>"><br />                     
    State: <input type="text" name="state"                                 
            value="<?php echo $row['state']; ?>"><br />                    
    <input type="submit" name="submit" value="Update"> &nbsp;              
    <input type="button" value="Cancel" onclick="history.go(-1);">         
  </form>                                                                  
</p>                                                                       
<?php                                                                      
}                                                                          
?>                                                                         
</body>                                                                    
</html>                                                                    
