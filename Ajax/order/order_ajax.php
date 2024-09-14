<?php
    
    require_once '../../dbconnection/dbconnection.php';
    require_once '../../classes/orderClass.class';
    
    $db = new Database();
    $database = $db->getConnection();
    $orders = new Order($database);
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);
    $cart= $orders->Create($data);
    echo json_encode($cart);
?>