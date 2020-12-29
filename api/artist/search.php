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
if(isset($data->searchVal) && isset($data->offset) && isset($data->from)){
    $searchVal = trim($data->searchVal); 
    $offset = trim($data->offset);
    $from = trim($data->from);

    http_response_code(200);
    echo json_encode($artist->searchArtist($searchVal, $offset, $from));
} else{
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to get artist."));
}
?>