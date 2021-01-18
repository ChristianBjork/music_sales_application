<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if(isset($_SESSION["userId"])) {

    $password = trim($data->password);

    require_once("../../models/profile.php");
    $profile = new Profile;

    http_response_code(200);
    echo json_encode(array("Change Password" => $profile->changePassword($password)));
    
}else {
    http_response_code(501);
    echo json_encode(array("Something Went Wrong" => "Bad Request"));
}
?>