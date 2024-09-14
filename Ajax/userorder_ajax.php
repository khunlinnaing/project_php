<?php
require_once './dbconnection/dbconnection.php';
require_once './classes/CartProduct.class';
$db = new Database();
$database = $db->getConnection();
$carts = new Cart($database);
$carts_val = $carts->index();
?>
