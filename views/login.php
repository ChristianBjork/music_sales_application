<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css"></style>
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="js/functions-general.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
</head>
<body>
    <div class="login-box">
        <div class="form">
            <form class="register-form">
                <input type="text" id="firstName" placeholder="First name" />
                <input type="text" id="lastName" placeholder="Last name" />
                <input type="password" id="password" placeholder="Password" />
                <input type="text" id="company" placeholder="Company" />
                <input type="text" id="address" placeholder="Address" />
                <input type="text" id="city" placeholder="City" />
                <input type="text" id="state" placeholder="State" />
                <input type="text" id="country" placeholder="Country" />
                <input type="zip" id="postalCode" placeholder="Postal Code" />
                <input type="tel" id="phone" placeholder="Phone" />
                <input type="text" id="fax" placeholder="Fax" />
                <input type="email" id="email" placeholder="Email address" />
                <button class="createUser">create</button>
                <p class="message">Already registered? <a href="#">Sign In</a></p>
            </form>
            <form class="login-form">
                <input id="loginEmail" type="email" placeholder="Email"/>
                <input id="loginPassword" type="password" placeholder="Password"/>
                <button class="loginUser">login</button>
                <p class="message">Not registered? <a href="#">Create an account</a></p>
            </form>
        </div>
    </div>
</body>
</html>