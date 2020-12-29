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

    http_response_code(201);
    echo json_encode(array("isUserLoggedOut" => $user->signOut()));

?>