<?php  
require 'conn.php';
if(isset($_POST["user_name"]))
{

 $query = "SELECT * FROM users WHERE user_name = '".$_POST["user_name"]."'";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result)>0){
     echo '<span>username not available</span>';
 } else {
    echo '<span>username available</span>';
 }
}
?>