<?php
    require_once '../../dbconnection/dbconnection.php';
    require_once '../../classes/CartProduct.class'; 
    $db = new Database();
    $database = $db->getConnection();
    $carts = new Cart($database);
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    $cart= $carts->DeleteCart($data);
    echo json_encode($cart);
?>