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
    include("templates/header.php");
    if(!isset($_SESSION['userId'])) {
        header("Location: ../");
        die();
    }
?>

<main>
    <div class="editCustomer">
        <div class="form">
            <div class="update-modal-content">
                <p>Firstname</p>
                <input type="text" id="firstname" placeholder="First name" required/>
            </div>
            <div class="update-modal-content">
                <p>Lastname</p>
                <input type="text" id="lastname" placeholder="Last name" required/>
            </div>
            <div class="update-modal-content">
                <p>Company</p>
                <input type="text" id="company" placeholder="Company" required/>
            </div>
            <div class="update-modal-content">
                <p>Address</p>
                <input type="text" id="address" placeholder="Address" required/>
            </div>
            <div class="update-modal-content">
                <p>City</p>
                <input type="text" id="city" placeholder="City" required/>
            </div>
            <div class="update-modal-content">
                <p>State</p>
                <input type="text" id="state" placeholder="State" required/>
            </div>
            <div class="update-modal-content">
                <p>Country</p>
                <input type="text" id="country" placeholder="Country" required/>
            </div>
            <div class="update-modal-content">
                <p>Postalcode</p>
                <input type="zip" id="postalcode" placeholder="Postal Code" required/>
            </div>
            <div class="update-modal-content">
                <p>Phone</p>
                <input type="tel" id="phone" placeholder="Phone" required/>
            </div>
            <div class="update-modal-content">
                <p>Fax</p>
                <input type="text" id="fax" placeholder="Fax" required/>
            </div>
            <div class="update-modal-content">
                <p>Email</p>
                <input type="email" id="email" placeholder="Email address" required/>
            </div>
                <button class="submitEditUser">Edit</button>
                <input type="password" id="password" placeholder="Change Password">
            <button class="editPassword">Update Password</button>
        </div>
    </div>
    <div id="snackbar">Successfully Updated!</div>
</main>
</body>
</html>