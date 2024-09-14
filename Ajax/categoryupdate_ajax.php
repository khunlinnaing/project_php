<?php
    require_once '../dbconnection/dbconnection.php';
    require_once '../classes/category.class';
    $db = new Database();
    $database = $db->getConnection();
    $categorynew = new Category($database);
    if(isset($_FILES["image"]["name"])){
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
        $result= $categorynew->updateCategory(['categoryname'=>$_POST['categoryname'], 'image'=>$targetfoleerpath ,'amount'=>$_POST['amount'], 'categoryid'=>$_POST['categoryid']]);
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
    }else{
        $result= $categorynew->updateCategory(['categoryname'=>$_POST['categoryname'], 'image'=>$_POST['oldimage'] ,'amount'=>$_POST['amount'],'categoryid'=>$_POST['categoryid']]);
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