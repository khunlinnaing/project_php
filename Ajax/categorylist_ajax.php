<?php
    require_once './dbconnection/dbconnection.php';
    require_once './classes/category.class';
    $db = new Database();
    $database = $db->getConnection();
    $category = new Category($database);
    if(isset($_GET['page'])){
        $categorylist = $category->index($_GET['page'], 10);
    }else{
        $categorylist = $category->index(1, 10);
    }
?>