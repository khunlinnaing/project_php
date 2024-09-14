<?php
    require_once './dbconnection/dbconnection.php';
    require_once './classes/product.class';
    $db = new Database();
    $database = $db->getConnection();
    $product = new Product($database);
    if(isset($_GET['page'])){
        $productlist = $product->index($_GET['page'], 10);
    }else{
        $productlist = $product->index(1, 10);
    }
?>