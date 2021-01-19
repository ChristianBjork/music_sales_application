$(document).ready(function() {
    loginToSignup();
    createUser();
    validateLogin();
});

function loginToSignup() {
    $('.message a').click(function () {
        $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
    });
}

//Validate user login
function validateLogin() {
    $(".loginUser").click(function() {
        console.log("validate login initiated");
        let email = $.trim($("#loginEmail").val());
        let password = $.trim($("#loginPassword").val());
        apiUrl = setApiUrl("user", "validate");
        $.ajax({
            url: apiUrl,
            type: GET,
            data: {
                email: email,
                password: password
            },
            success: function(data){
                console.log(data);
                isAdmin = data.isAdmin;
                if (data.isValid === true){
                    console.log("TRUE");
                    window.location.reload();
                  } else {
                    console.log("ALERT");
                    alert("Login credentials incorrect");
                  }
            }, failure: function(e) {
                console.log('failure: ' + e);
            }, error: function(e) {
                console.log('error: ' + e);
                console.log(JSON.stringify(e));
            }
        });
    });
}

//CREATE New User
function createUser() {
    $('.createUser').click(function () {
        console.log('CREATE CLICKED');
        let firstName = $('#firstName').val();
        let lastName = $('#lastName').val();
        let password = $('#password').val();
        let company = $('#company').val();
        let address = $('#address').val();
        let city = $('#city').val();
        let state = $('#state').val();
        let country = $('#country').val();
        let postalCode = $('#postalCode').val();
        let phone = $('#phone').val();
        let fax = $('#fax').val();
        let email = $('#email').val();

        apiUrl = setApiUrl("user", "create");
        $.ajax({
            url: apiUrl,
            type: POST,
            data: JSON.stringify({
                firstName: firstName,
                lastName: lastName,
                password: password,
                company: company,
                address: address,
                city: city,
                state: state,
                country: country,
                postalCode: postalCode,
                phone: phone,
                fax: fax,
                email: email
            }), 
            success: function(data){
                if(data.isUserCreated == true) {
                    $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
                } else {
                    alert("Email already exists")
                }
            }, failure: function(e) {
                console.log('failure: ' + e);
            }, error: function(e) {
                console.log('error: ' + e);
                console.log(JSON.stringify(e));
            }
        });
    });
}