<?php
    session_start();
    if(isset($_SESSION['userId'])){
        require_once('home.php');
    } else {
        require_once('login.php');
    }
?>