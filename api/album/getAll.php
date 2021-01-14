<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require_once('../../models/album.php');
$album = new Album;

// make sure data is not empty
if(isset($_GET['offset']) && isset($_GET['from'])){
    $offset = trim($_GET['offset']);
    $from = trim($_GET['from']);

    http_response_code(200);
    echo json_encode($album->getAll($offset, $from));
} else{
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to get Album."));
}
?>