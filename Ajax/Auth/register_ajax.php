<?php
    require_once '../../dbconnection/dbconnection.php';
    require_once '../../classes/Auth/register.class';
    $db = new Database();
    $database = $db->getConnection();
    $user = new RegisterUser($database);
    if(!empty($user->checkAccount($_POST))){
        header("Location: ../../index.php?page=register&&message=".$_POST['username']." Already exit.");
    }else{
        $result = $user->create($_POST);
        header("Location: ../../index.php?page=login");
    }
?>