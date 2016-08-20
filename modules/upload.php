<?php

function uploadImage($file)
{
$result = [];

$target_dir = "e:/web/banmuonden/web/images/";
$target_file = $target_dir . basename($file["name"]);
//$uploadOk = true;
//$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
//// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
//    $check = getimagesize($file["tmp_name"]);
//    if($check !== false) {
//        echo "File is an image - " . $check["mime"] . ".";
//        $uploadOk = true;
//    } else {
//        echo "File is not an image.";
//        $uploadOk = false;
//    }
//}
//// Check if file already exists
//if (file_exists($target_file)) {
//    echo "Sorry, file already exists.";
//    $uploadOk = false;
//}
//// Check file size
//if ($file["size"] > 500000) {
//    echo "Sorry, your file is too large.";
//    $uploadOk = false;
//}
//// Allow certain file formats
//if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//&& $imageFileType != "gif" ) {
//    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//    $uploadOk = false;
//}
//// Check if $uploadOk is set to 0 by an error
//if (!$uploadOk) {
//    echo "Sorry, your file was not uploaded.";
//// if everything is ok, try to upload file
//} else {
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $result['image'] = basename( $file["name"]);
        $result['image_path'] = 'http://localhost/banmuonden/web/images/';
        $result['success'] = true;
    } else {
        $result['image'] = '';
        $result['image_path'] = '';
        $result['success'] = false;
    }
//}
    
    return $result;
}