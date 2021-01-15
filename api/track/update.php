<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->id) &&
    !empty($data->name) &&
    !empty($data->albumId) &&
    !empty($data->mediaTypeId) &&
    !empty($data->genreId) &&
    !empty($data->composer) &&
    !empty($data->milliseconds) &&
    !empty($data->bytes) &&
    !empty($data->unitPrice)
    ){
    require_once('../../models/track.php');
    $track = new Track;
    
    $id= trim($data->id);
    $name = trim($data->name); 
    $albumId = trim($data->albumId); 
    $mediaTypeId = trim($data->mediaTypeId); 
    $genreId = trim($data->genreId); 
    $composer = trim($data->composer); 
    $milliseconds = trim($data->milliseconds); 
    $bytes = trim($data->bytes); 
    $unitPrice = trim($data->unitPrice); 

    $result = $track->update($id, $name, $albumId, $mediaTypeId, $genreId, $composer, $milliseconds, $bytes, $unitPrice);

    if ($result['isTrackUpdated']) {
        http_response_code(200);
    } else {
        http_response_code(404);
    }
    echo json_encode($result);
    
} else{
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to get Create user"));
}
?>