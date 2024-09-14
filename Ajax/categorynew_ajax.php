<?php
    require_once '../dbconnection/dbconnection.php';
    require_once '../classes/category.class';
    $db = new Database();
    $database = $db->getConnection();
    $categorynew = new Category($database);
    
    $targetDir = "../uploads/";
    $uploadDir='./uploads/';
    
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $fileName = basename($_FILES["image"]["name"]);
    
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $newFileName = uniqid() . '.' . $fileType;
    $targetFilePath = $targetDir . $newFileName;
    $targetfoleerpath = $uploadDir. $newFileName;
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    $check = $categorynew->checkCategory(['categoryname'=>$_POST['categoryname']]);
    if($check){
        header("Location: ../index.php?error=Category Already Exit.");
    }else{
        $result= $categorynew->create(['categoryname'=>$_POST['categoryname'], 'image'=>$targetfoleerpath ,'amount'=>$_POST['amount']]);
        if($result['status'] =='success'){
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    header("Location: ../index.php?message=successfuly");
                } else {
                    header("Location: ../index.php?error=something error");
                }
            } else {
                header("Location: ../index.php?error=something erro");
            }
        }else{
            header("Location: ../index.php?error=something erro");
        }
    }
?>