<?php
$name = $_POST['animal_name'];

$file = $_FILES['file1'];
$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
}
if(move_uploaded_file($fileTmpLoc, "upload/$fileName")){
    echo "$fileName upload is complete";
    $mysqli = new mysqli('localhost', 'root', '123','wbw') or die($mysqli->error);
                    $table = 'communityanimals';
                    $description = $fileName;
                    $img_dir = 'upload/'.$fileName;

                    $sql = "INSERT INTO $table (animal_name, description,img_dir) VALUES ('$name', '$description','$img_dir')";
                    $mysqli->query($sql) or die($mysqli->error);
} else {
    echo "move_uploaded_file function failed";
}


?>