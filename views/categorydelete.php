<?php
require_once './dbconnection/dbconnection.php';
require_once './classes/category.class';
$db = new Database();
$database = $db->getConnection();
$user = new Category($database);
$result = $user->deleteCategory($_POST);
if($result){
    header("Location: ./index.php");
}else{
    header("Location: ./index.php");
}
?>