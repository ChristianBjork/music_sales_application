<?php
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// if($_SESSION['isAdmin']){
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(!empty($data->id) && !empty($data->name)){
    require_once('../../models/artist.php');
    $artist = new Artist;
    
    $id = trim($data->id); 
    $name = trim($data->name); 

    $result = $artist->update($id, $name);
    
    if ($result['isArtistUpdated']) {
        http_response_code(200);
    } else {
        http_response_code(404);
    }

    echo json_encode($result);

} else{
    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "Unable to get Create Artist"));
}
// }
?>