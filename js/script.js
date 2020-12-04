$(document).ready(function() {
    
    
    console.log("before display");
    displayOneTrack(2);
});

function displayOneTrack(id) {
console.log("before ajax")

    $.ajax({
        url:"model/api.php",
        type: "POST",
        data: {
            id: id
        },
        success: function(data) {
            
            const trackInfo = JSON.parse(data);

            $("#txtID").text(trackInfo["TrackId"]);
            $("#txtTitle").text(trackInfo["Name"] + " this is the shiit");
        }
    });
}