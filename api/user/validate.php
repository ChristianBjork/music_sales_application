<?php
session_start();
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once('../../models/user.php');
$user = new User;

// make sure data is not empty
if( isset($_GET['email']) && isset($_GET['password'])){
    $email = trim($_GET['email']); 
    $password = trim($_GET['password']);  

    http_response_code(200);
    echo json_encode($user->validate($email, $password));

} else{
    // set response code - 503 service unavailable
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Bad Request"));
}
?>