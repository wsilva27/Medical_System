<?php                                                                      
session_start();                                                           
ob_start();                                                                
//connect to the database                                                  
include "conn_inc.php";                                                    
                                                                           
mysql_select_db("registration");                                           
                                                                           
$query = "SELECT * FROM user_info";                                        
$results = mysql_query($query) or die(mysql_error());                      
                                                                           
echo "<html>";                                                             
echo "<head>";                                                             
echo "<title>The PHP Store</title>";                                       
echo "</head>";                                                            
echo "<body>";                                                             
echo "<h2>PHP Store Registered Users</h2>";                                
                                                                           
$tbl_head =<<<TBL                                                          
<table width="800" align="center" border="1">                              
  <tr>                                                                     
    <th>Userid</th>                                                        
    <th>Password</th>                                                      
    <th>First Name</th>                                                    
    <th>Last Name</th>                                                     
    <th>Email</th>                                                         
  </tr>                                                                    
TBL;                                                                       
                                                                           
echo $tbl_head;                                                            
                                                                           
$numbr = 1;                                                                
                                                                           
while ($row = mysql_fetch_array($results)) {                               
  extract($row);                                                           
    if ($numbr%2==0) {                                                     
            echo "<tr bgcolor=\"#EDF7EC\">";                               
  }                                                                        
  else                                                                     
            echo "<tr bgcolor=\"#E0F2DC\">";                               
  echo "<td align=\"center\">";                                            
  echo $username;                                                          
  echo "</td><td align=\"center\">";                                       
  echo $password;                                                          
  echo "</td><td align=\"center\">";                                       
  echo $first_name;                                                        
  echo "</td><td align=\"center\">";                                       
  echo $last_name;                                                         
  echo "</td><td align=\"center\">";                                       
  echo $email;                                                             
  echo "</td></tr>";                                                       
  $numbr += 1;                                                             
                                                                           
}                                                                          
?>                                                                         
</table>                                                                   
<br /><br />                                                               
<hr />                                                                     
<center><a href="index.php">Main Page</a></center>                         
</body>                                                                    
</html>       