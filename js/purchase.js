$(document).ready(function() { 
    getCurrentUser();
    createInvoice();
    signOut();
    signIn();
});

function getCurrentUser(){
    let apiUrl = setApiUrl('profile', 'getProfile');
    $.ajax({
        url: apiUrl,
        type: GET,
        success: function(data){
            console.log(data);
            setupPurchaseInfo(data);
        }
    });
}

function createInvoice(){
    $('.createInvoice').on('click', function(){
        console.log('Clicked purchase');
        let billingAddress = $('#billingAddress').val();
        let billingCity = $('#billingCity').val();
        let billingState = $('#billingState').val();
        let billingCountry = $('#billingCountry').val();
        let billingPostalCode = $('#billingPostalCode').val();
        
        if(
            billingAddress.length === 0 || billingCity.length === 0 || billingState.length === 0 ||billingCountry.length === 0 || billingPostalCode.length === 0 
        ) {
            $('div#snackbar').text('Please fill out all fields.');
            showSnackbar();
        } else if(
            !billingAddress.match($regExInput) || !billingCity.match($regExInput) || !billingState.match($regExInput) || !billingCountry.match($regExInput) || !billingPostalCode.match($regExInput) 
        ){
            $('div#snackbar').text("Please don't hack my application! ;-) ");
            showSnackbar();
        } else {
            let price = $('#finalPrice').val();
            let apiUrl = setApiUrl('purchase', 'createInvoice');
            $.ajax({
                url: apiUrl,
                type: POST,
                data: JSON.stringify( {
                    billingAddress: billingAddress,
                    billingCity: billingCity,
                    billingState: billingState,
                    billingCountry: billingCountry,
                    billingPostalCode: billingPostalCode,
                    price: price
                }),
                success: function(data) {
                    console.log(data);
                }
            });
        }
    });
}

// Used in getCurrentUser()
function setupPurchaseInfo(data){
    $('#billingAddress').val(data.Address);
    $('#billingCity').val(data.City);
    $('#billingState').val(data.State);
    $('#billingCountry').val(data.Country);
    $('#billingPostalCode').val(data.PostalCode);

}