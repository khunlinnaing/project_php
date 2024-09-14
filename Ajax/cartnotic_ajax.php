<?php
require_once '../dbconnection/dbconnection.php';
require_once '../classes/User.class';
$db = new Database();
$database = $db->getConnection();
$user = new User($database);
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);
$userid = $data['userid'];
$data = array(
    "userid" => $userid
);

$count = $user->CloseNotification($data);
if($count > 0){
    echo json_encode(['status'=>'success']);
}else{
    echo json_encode(['status'=>'fail']);
}

?>
