<?php
    require_once('track.php');
    
    $track = new Track;
    if(isset($_POST['id'])) {
        echo json_encode($track->get($_POST['id']));
    }

    // echo json_encode($track->get());
?>