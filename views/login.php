<?php
        session_start();
        if(isset($_SESSION['userId'])) {
            header("Location: home.php");
            die();
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/styles.css"></style>
    <script type="text/javascript" src="../js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../js/functions-general.js"></script>
    <script type="text/javascript" src="../js/login.js"></script>
</head>
<body>
    <div class="login-box">
        <div class="form">
            <form class="register-form">
                <input type="text" id="firstName" placeholder="First name" required/>
                <input type="text" id="lastName" placeholder="Last name" required/>
                <input type="password" id="password" placeholder="Password" required/>
                <input type="text" id="company" placeholder="Company" required/>
                <input type="text" id="address" placeholder="Address" required/>
                <input type="text" id="city" placeholder="City" required/>
                <input type="text" id="state" placeholder="State" required/>
                <input type="text" id="country" placeholder="Country" required/>
                <input type="zip" id="postalCode" placeholder="Postal Code" required/>
                <input type="tel" id="phone" placeholder="Phone" required/>
                <input type="text" id="fax" placeholder="Fax" required/>
                <input type="email" id="email" placeholder="Email address" required/>
                <button class="createUser">create</button>
                <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form>
            <form class="login-form">
                <input id="loginEmail" type="email" placeholder="Email" required/>
                <input id="loginPassword" type="password" placeholder="Password" required/>
                <button class="loginUser">login</button>
                <p class="message">Not registered? <a href="#">Create an account</a></p>
            </form>
        </div>
    </div>
</body>
</html>