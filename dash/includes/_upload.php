<?php
$target_path = "../assets/images/uploadFile/";
$target_path = $target_path.basename( $_FILES['file']['name']);

if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    echo "File uploaded successfully!";
} else{
    echo "Sorry, file not uploaded, please try again!";
}