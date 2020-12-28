<?php
    session_start();
    if (!isset($_POST['entity']) || !isset($_POST['action'])) {
        echo json_encode("entity action, not set");
    } else {
        $entity = $_POST['entity'];
        $action = $_POST['action'];
        switch ($entity) {
            case 'track':
                require_once('../model/track.php');
                $track = new Track;
                switch($action){
                    case 'get':
                        echo json_encode($track->get($_POST['searchVal'], $_POST['offset'], $_POST['from']));
                        break;
                    case 'getModalInfo':
                        echo json_encode($track->getModalInfo($_POST['id']));
                        break;
                }
                break;
            case 'album':
                require_once('../model/album.php');
                $album = new Album;
                switch($action) {
                    case 'get':
                        echo json_encode($album->get($_POST['searchVal'], $_POST['offset'], $_POST['from']));
                        break;
                    case 'getModalInfo':
                        echo json_encode($album->getModalInfo($_POST['id']));
                        break;
                }
                break;
            case 'artist':
                require_once('../model/artist.php');
                $artist = new Artist;
                switch($action) {
                    case 'get':
                        echo json_encode($artist->get($_POST['searchVal'], $_POST['offset'], $_POST['from']));
                        break;
                    case 'getModalInfo':
                        echo json_encode($artist->getModalInfo($_POST['id']));
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
                        // echo json_encode($user->validate("mailing@ail.com", "pasword"));
                        echo json_encode($user->validate($_POST['email'], $_POST['password']));
                        break;
                    case 'sign-out':
                        echo json_encode($user->signOut());
                        break;
                }
                break;
        }
    }
?>