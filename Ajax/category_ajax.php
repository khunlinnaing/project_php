<?php
    require_once './dbconnection/dbconnection.php';
    require_once './classes/category.class';
    $db = new Database();
    $database = $db->getConnection();
    $category = new Category($database);
    $result = $category->getAllcategory();
?>