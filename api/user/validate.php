<?php
session_start();
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once('../../model/user.php');
$user = new User;

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if( isset($data->email) && isset($data->password)){
    $email = trim($data->email); 
    $password = trim($data->password);  

    http_response_code(200);
    echo json_encode(array("isUserValid" => $user->validate($email, $password)));

} else{
    // set response code - 503 service unavailable
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Bad Request"));
}
?>