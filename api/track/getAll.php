<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once('../../models/track.php');
$track = new Track;

// get posted data
$data = json_decode(file_get_contents("php://input"));

if(isset($_GET['offset']) && (isset($_GET['from']))) {
    $from = trim($_GET['from']);
    $offset = trim($_GET['offset']);
} else {
    $from = 0;
    $offset = 4000;
}

// make sure data is not empty
if(!empty($offset) && $from >= 0){
    http_response_code(200);
    echo json_encode($track->getAll($offset, $from));
} else{
    // set response code - 503 service unavailable
    http_response_code(503);

    echo json_encode(array("message" => "Unable to get Track."));
}
?>