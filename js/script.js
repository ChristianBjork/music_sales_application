$(document).ready(function () {
    //const apiUrl = "api/api.php";
    getTableInfo(0, 1);
    searchMusic();
});

function getTableInfo(from, currentPage){
    const apiUrl = "api/api.php";
    let searchVal = $("#search-val").val();
    let searchOpt = $.trim($("#search-opt").val());
    let offset = $(".row-per-page").val();
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
                    searchVal: searchVal,
                    offset: offset,
                    from: from
                },
                success: function(data) {
                    console.log("DATA: " + data);
                    let trackData = JSON.parse(data);
                    console.log("DATA-parsed: " + data);
                    setupTrackTable(trackData, offset, from, currentPage);
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
}

function searchMusic() {
    $("#search").click(function() {
        console.log("SØG!");
        getTableInfo();
    });
    //Set table Name
    $("#search-opt").on('change', function(){
        switch(this.value){
            case "track":
                $("#info-title").text("Tracks");
                break;
            case "album":
                $("#info-title").text("Albums");
                break;
            case "artist":
                $("#info-title").text("Artists");
                break;
        }
    });
    
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

$(document).on('click', '.pagination-page-left, .pagination-page-right', function(){
    var i = ($(this).hasClass('pagination-page-left')) ? -1 : 1;
    var newCurrentPage = parseInt($('.current-page').attr('data-current')) + i;
    var offset = $(".row-per-page").val();
    var from = (newCurrentPage - 1) * offset;

    // if ($(this).closest('.pagination').hasClass('pagination-bottom')) $('html, body').scrollTop(0);

    //searchAndUpdate is defined in the local js files
    getTableInfo(from, newCurrentPage);
});