<?php
$output = shell_exec('pkill -U www');
echo "<pre>$output</pre>";

$hostname = 'localhost';
$username = 'root';
$password = '123';
$database = 'wbw';


$conn = new mysqli($hostname, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// $sql = "SELECT * FROM animals";
// $result = $conn->query($sql);

// $sqlComments = "SELECT * FROM comments WHERE animal_id = 522";
// $resultComments = $conn->query($sqlComments);



// mysqli_close($conn);
?>
