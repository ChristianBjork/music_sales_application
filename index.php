<?php
    session_start();
    if(isset($_SESSION['userId'])){
        require_once('views/home.php');
    } else {
        require_once('views/login.php');
    }
?>