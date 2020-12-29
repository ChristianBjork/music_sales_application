<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once('../../model/artist.php');
$artist = new Artist;

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(isset($data->id)){
    $id = trim($data->id); 

    http_response_code(200);
    echo json_encode($artist->getById($id));

} else{
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to get Artist."));
}
?>