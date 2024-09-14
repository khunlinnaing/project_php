<?php
    require_once '../../dbconnection/dbconnection.php';
    require_once '../../classes/Auth/login.class';
    session_start();
    $db = new Database();
    $database = $db->getConnection();
    $user = new LoginUser($database);
    $result=$user->login($_POST);
    $_SESSION['access_token']=$result['token'];
    $_SESSION['role'] = $result['role'];
    $_SESSION['userid'] = $result['id'];
    $_SESSION['loginuseraccount'] = $result['username'];
    if($result['status']=='error'){
        header("Location: ../../index.php?page=login&&message=".$result['message']);
    }else{
        header("Location: ../../index.php");
    }
    
?>