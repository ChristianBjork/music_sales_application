$(document).ready(function () {
    const apiUrl = "api/api.php"
    $("#btn1").click(function () {
        console.log("Clicked");
        displayOneTrack(apiUrl, 2);
    });
});

function displayOneTrack(apiUrl, id) {
    console.log("DISPLAAAY");
    $.ajax({
        url: apiUrl,
        type: "POST",
        data: {
            entity: "track",
            action: "get",
            id: id
        },
        success: function (data) {
            console.log("SUCCESS");
            const trackInfo = JSON.parse(data);
            $("#txtID").text(trackInfo["TrackId"]);
            $("#txtTitle").text(trackInfo["Name"] + " this is the shiit");
        }
    });
}