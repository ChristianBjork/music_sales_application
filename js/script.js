$(document).ready(function () {
    const apiUrl = "api/api.php"
    search(apiUrl);
});

function search(apiUrl) {
    $("#search").click(function() {
        console.log("SØG!");
        let searchVal = $("#search-val").val();
        let searchOpt = $("#search-opt").val();
        if (search.length === 0) search = '';
        console.log(searchOpt + " --- " + searchVal);
        switch(searchOpt){
            case "track":
                $.ajax({
                    url: apiUrl,
                    type: "POST",
                    data: {
                        entity: "track",
                        action: "get",
                        searchVal: searchVal
                    },
                    success: function(data) {
                        let trackData = JSON.parse(data);
                        console.log(trackData);
                        setupTrackTable(trackData);
                    }
                });
                break;
            case "album":
                console.log("ALBUM SEARCH");
                break;
            case "artist":
                console.log("ARTIST SEARCH");
                break;
        }
    })
    
}

function displayOneTrack(apiUrl, id) {
    $.ajax({
        url: apiUrl,
        type: "POST",
        data: {
            entity: "track",
            action: "get",
            id: id
        },
        success: function (data) {
            console.log(data);
            const trackInfo = JSON.parse(data);
            $("#txtID").text(trackInfo["TrackId"]);
            $("#txtTitle").text(trackInfo["Name"] + " this is the shiit");
        }
    });
}