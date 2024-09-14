<?php
require_once './dbconnection/dbconnection.php';
require_once './classes/User.class';
$db = new Database();
$database = $db->getConnection();
$user = new User($database);
$result = $user->deleteUser($_POST);
if($result){
    if($__POST['userid'] == $_SESSION['userid']){
        $_SESSION['access_token']='';
        $_SESSION['role'] = '';
        $_SESSION['userid'] = '';
        $_SESSION['loginuseraccount'] = '';
    }
    header("Location: ./index.php");
}else{
    header("Location: ./index.php");
}
?>