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
        
        //var today = new DATE().ToLocaleString();
    // var dateTime = today.getFullYear()+"-"+(today.getMonth()+1)+"-"+today.getDate();
        let date = new Date().toJSON().slice(0, 19).replace('T', ' '); 
        let price = $('#finalPrice').val();
        console.log(billingAddress, billingCity, billingCountry, billingPostalCode, billingState, date, price);
        let apiUrl = setApiUrl('purchase', 'createInvoice');
        $.ajax({
            url: apiUrl,
            type: POST,
            data: JSON.stringify( {
                date: date,
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