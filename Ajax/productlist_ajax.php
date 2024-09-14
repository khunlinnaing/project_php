<?php
    require_once './dbconnection/dbconnection.php';
    require_once './classes/product.class';
    $db = new Database();
    $database = $db->getConnection();
    $product = new Product($database);
    $products = $product->getAllProduct();
?>