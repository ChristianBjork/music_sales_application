<?php

    if (!isset($_POST['entity']) || !isset($_POST['action'])) {
        echo json_encode("entity action, not set");
    } else {
        $entity = $_POST['entity'];
        $action = $_POST['action'];
        // $entity = "track";
        // $action = "get";
        switch ($entity) {
            case 'track':
                require_once('../model/track.php');
                $track = new Track;
                switch($action){
                    case 'get':
                        echo json_encode($track->get($_POST['id']));
                        // echo json_encode($track->get(2));
                        break;
                    }
                break;
            case 'user':
                require_once('../model/user.php');
                $user = new User;
                switch ($action) {
                    case 'create':
                        // echo json_encode($user->create("fornavn", "Efternavn", "adgangskode", "Selskab", "Adresse", "By", "Stat", "Land", "4960", "28272625", "faaaax", "mailer@mail.dk"));
                        echo json_encode($user->create($_POST['firstName'], $_POST['lastName'], $_POST['password'], $_POST['company'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['country'], $_POST['postalCode'], $_POST['phone'], $_POST['fax'], $_POST['email']));
                        break;
                    case 'validate': 
                        echo json_encode($user->validate($_POST['email'], $_POST['password']));
                        break;
                }
                break;
        }
    }
?>