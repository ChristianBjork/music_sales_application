$(document).ready(function() {
    const apiUrl = "api/api.php"
    loginToSignup();
    createUser(apiUrl);
    validateLogin(apiUrl);
});

function loginToSignup() {
    $('.message a').click(function () {
        $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
    });
}

function validateLogin(apiUrl) {
    
    $(".loginUser").click(function() {
        console.log("validate login initiated");
        let email = $.trim($("#loginEmail").val());
        let password = $.trim($("#loginPassword").val());
        $.ajax({
            url: apiUrl,
            type: "POST",
            data: {
                entity: "user",
                action: "validate",
                email: email,
                password: password
            },
            success: function(data){
                data = JSON.parse(data);
                console.log(data);
                if (data === true){
                    console.log("TRUE");
                    //window.location.replace("index.php");
                    window.location.reload();
                  } else {
                    console.log("ALERT");
                    alert("Login credentials uncorrect");
                  }
            }
        });
    });
}


function createUser(apiUrl) {
    $(".createUser").click(function () {
        console.log("CREATE CLICKED");
        let firstName = $.trim($("#firstName").val());
        let lastName = $.trim($("#lastName").val());
        let password = $.trim($("#password").val());
        let company = $.trim($("#company").val());
        let address = $.trim($("#address").val());
        let city = $.trim($("#city").val());
        let state = $.trim($("#state").val());
        let country = $.trim($("#country").val());
        let postalCode = $.trim($("#postalCode").val());
        let phone = $.trim($("#phone").val());
        let fax = $.trim($("#fax").val());
        let email = $.trim($("#email").val());
    
        $.ajax({
        url: apiUrl,
        type: "POST",
        data: {
            entity: "user",
            action: "create",
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
        }, 
        success: function(data){
            let isUserAdded = JSON.parse(data);
            if(isUserAdded == true) {
                $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
            } else {
                alert("Email already exists")
            }
        }
        });
    });
}