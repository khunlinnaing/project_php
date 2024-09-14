<?php
require_once './dbconnection/dbconnection.php';
require_once './classes/product.class';
$db = new Database();
$database = $db->getConnection();
$user = new Product($database);
$result = $user->deleteProduct($_POST);
if($result){
    header("Location: ./index.php");
}else{
    header("Location: ./index.php");
}
?>