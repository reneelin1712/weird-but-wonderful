<?php
session_start();

$hostname = 'localhost';
$username = 'root';
$password = '123';
$database = 'wbw';


$conn = new mysqli($hostname, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $user_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
$text = mysqli_real_escape_string($conn, $_REQUEST['comment']);
$id = md5(uniqid(rand(), true));
$userid = md5(uniqid(rand(), true));
 
// Attempt insert query execution
$user_name = $_SESSION['user_name'];
$sql = "INSERT INTO comments (id, animal_id, user_id, text, user_name) VALUES ('$id', '522', '$userid', '$text', '$user_name' )";
if(mysqli_query($conn, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

header("location:http://localhost/wbw/detail.php");

?>