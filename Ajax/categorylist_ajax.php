<?php
    require_once './dbconnection/dbconnection.php';
    require_once './classes/category.class';
    $db = new Database();
    session_start();
    $database = $db->getConnection();
    $user = new User($database);
    if($_GET['page']){
        $result = $user->index($_GET['page'], 10);
    }else{
        $result = $user->index(1, 10);
    }
    $roles = $role->index();
?>