<?php
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
if(
    !empty($data->firstName) &&
    !empty($data->lastName) &&
    !empty($data->password) &&
    !empty($data->company) &&
    !empty($data->address) &&
    !empty($data->city) &&
    !empty($data->state) &&
    !empty($data->country) &&
    !empty($data->postalCode) &&
    !empty($data->phone) &&
    !empty($data->fax) &&
    !empty($data->email)
    ){
    $firstName = trim($data->firstName); 
    $lastName = trim($data->lastName); 
    $password = trim($data->password); 
    $company = trim($data->company); 
    $address = trim($data->address); 
    $city = trim($data->city); 
    $state = trim($data->state); 
    $country = trim($data->country); 
    $postalCode = trim($data->postalCode); 
    $phone = trim($data->phone); 
    $fax = trim($data->fax); 
    $email = trim($data->email); 

    http_response_code(201);
    echo json_encode(array("isUserCreated" => $user->create($firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email)));

} else{
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to get Create user"));
}
?>