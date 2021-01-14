<?php
session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: http://localhost/music_sales_application");
    } else {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <script type="text/javascript" src="../js/jquery-3.5.1.js"></script>
            <script type="text/javascript" src="../js/functions.js"></script>
            <script type="text/javascript" src="../js/main.js"></script>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Music Cart</title>
            <link rel="stylesheet" href="../css/styles.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        </head>
        <body>
            <header>
                <div class="img-title">
                    <img src="../img/notes-logo.png" alt="notes-logo" id="notes-logo">
                    <div class="home-title">
                        <h1>Music Store</h1>
                    </div>
                </div>
                <div class="header-icons">
                    <i class="fas fa-shopping-cart fa-2x h-icon" id="shopping-cart-btn"></i>
                    <i class="far fa-user fa-2x h-icon" id="profile-btn"></i>
                    <i class="fas fa-sign-out-alt fa-2x h-icon" id="sign-out-btn"></i>
                </div>
            </header>
        <?php
    }

?>