<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script type="text/javascript" src="../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../js/functions-general.js"></script>
    <script type="text/javascript" src="../js/profile.js"></script>
</head>
<body>
<?php
    session_start();
    include("header.php");
    if(!isset($_SESSION['userId'])) {
        header("Location: ../");
        die();
    }
?>

<main>
    <div class="editCustomer">
        <div class="form">
                <input type="text" id="firstname" placeholder="First name" />
                <input type="text" id="lastname" placeholder="Last name" />
                <input type="text" id="company" placeholder="Company" />
                <input type="text" id="address" placeholder="Address" />
                <input type="text" id="city" placeholder="City" />
                <input type="text" id="state" placeholder="State" />
                <input type="text" id="country" placeholder="Country" />
                <input type="zip" id="postalcode" placeholder="Postal Code" />
                <input type="tel" id="phone" placeholder="Phone" />
                <input type="text" id="fax" placeholder="Fax" />
                <input type="email" id="email" placeholder="Email address" />
                <button class="submitEditUser">Edit</button>
                <input type="password" id="password" placeholder="Change Password">
                <button class="editPassword">Update Password</button>
        </div>
    </div>
    <div id="snackbar">Successfully Updated!</div>
</main>
</body>
</html>