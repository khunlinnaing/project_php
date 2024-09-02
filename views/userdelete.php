<?php
require_once './dbconnection/dbconnection.php';
require_once './classes/User.class';
$db = new Database();
$database = $db->getConnection();
$user = new User($database);
$result = $user->deleteUser($_POST);
if($result){
    header("Location: ./index.php");
}else{
    header("Location: ./index.php");
}
?>