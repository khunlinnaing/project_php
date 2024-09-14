<?php
    require_once '../dbconnection/dbconnection.php';
    require_once '../classes/product.class';
    $db = new Database();
    $database = $db->getConnection();
    $product = new Product($database);
    
    $targetDir = "../uploads/";
    $uploadDir='./uploads/';
    
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
    $targetfoleerpath = $uploadDir. $newFileName;
    // Allowed file types
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    $check = $product->checkProduct(['categoryname'=>$_POST['categoryname'], 'name'=>$_POST['productname']]);
    if($check){
        header("Location: ../index.php?error=Product Already Exit.");
    }else{
        $result= $product->create(['categoryname'=>$_POST['categoryname'], 'name'=>$_POST['productname'], 'image'=>$targetfoleerpath ,'amount'=>$_POST['amount'], 'price'=>$_POST['price']]);
        echo json_encode($result);
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