<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// get posted data
$data = json_decode(file_get_contents("php://input"));

$id = trim($data->id);

// make sure data is not empty
if(!empty($id)) {
    require_once('../../models/track.php');
    $track = new Track;
    
    http_response_code(200);
    echo json_encode($track->delete($id));    
} else {
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to delete Track.", "id" => $id));
}