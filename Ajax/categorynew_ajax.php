<?php
    require_once '../dbconnection/dbconnection.php';
    require_once '../classes/category.class';
    $db = new Database();
    $database = $db->getConnection();
    $categorynew = new Category($database);
    $result= $categorynew->create(['categoryname'=>$_POST['categoryname'], 'image'=>basename($_FILES["image"]["name"]) ,'amount'=>$_POST['amount']]);
    if($result['status'] =='success'){
        $targetDir = "../uploads/";
    
    // Ensure the directory exists
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Get the file name and extension
    $fileName = basename($_FILES["image"]["name"]);
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Generate a unique file name to prevent conflicts
    $newFileName = uniqid() . '.' . $fileType;
    $targetFilePath = $targetDir . $newFileName;

    // Allowed file types
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

    // Check if the file type is allowed
    if (in_array($fileType, $allowedTypes)) {
        // Attempt to move the uploaded file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            echo "The file has been uploaded as " . htmlspecialchars($newFileName);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
    }
    }else{
        echo 'Something Worng';
    }
    
?>