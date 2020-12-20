$(document).ready(function () {
    getTableInfo(0, 1);
    searchMusic();
    enableModalAction();
    signout();
});

//Search --------------------
function searchMusic() {
    $("#artist-thead").hide();
    $("#album-thead").hide();
    $("#search").click(function() {
        console.log("SØG!");
        getTableInfo(0, 1);
    });
    //Set table Name
    $("#search-opt").on('change', function(){
        switch(this.value){
            case "track":
                $("#track-thead").show();
                $("#artist-thead").hide();
                $("#album-thead").hide();
                $("#info-title").text("Tracks");
                break;
            case "artist":
                $("#track-thead").hide();
                $("#artist-thead").show();
                $("#album-thead").hide();
                $("#info-title").text("Artists");
                break;
            case "album":
                $("#track-thead").hide();
                $("#artist-thead").hide();
                $("#album-thead").show();
                $("#info-title").text("Album");
                break;
        }
    });
}

function getTableInfo(from, currentPage){
    let searchVal = $("#search-val").val();
    let searchOpt = $.trim($("#search-opt").val());
    let offset = $(".row-per-page").val();
    if (search.length === 0) search = '';
    console.log(searchOpt + " --- " + searchVal);
    switch(searchOpt){
        case "track":
            $.ajax({
                url: apiUrl,
                type: post,
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
                    setupTrackTable(trackData, offset, currentPage);
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

//Sign Out --------------------
function signout() {
    $("#sign-out-btn").on('click', function() {
        $.ajax({
            url: apiUrl,
            type: post,
            data: {
                entity: "user",
                action: "sign-out"
            },
            success: function(){
                window.location.reload();
            }
        })
    });
}

//Pagination --------------------
$(document).on('click', '.pagination-page-left, .pagination-page-right', function(){
    var i = ($(this).hasClass('pagination-page-left')) ? -1 : 1;
    var newCurrentPage = parseInt($('.current-page').attr('data-current')) + i;
    var offset = $(".row-per-page").val();
    var from = (newCurrentPage - 1) * offset;

    // if ($(this).closest('.pagination').hasClass('pagination-bottom')) $('html, body').scrollTop(0);

    getTableInfo(from, newCurrentPage);
});

//Update number of rows
$(document).on('change', '.show-per-page', function(){
    $('.navigator-number').val($(this).val());
    if ($(this).closest('.pagination').hasClass('pagination-bottom')) $('html, body').scrollTop(0);
    getTableInfo(0, 1);
});

//MODAL --------------------
function enableModalAction() {
    $("#music-info" ).on("click", "tr", function(){
        let entity = $(this).attr("id");
        console.log("ID: " + entity);
        switch(entity) {
            case "track":
                let trackId = $(this).attr("data-trackId");
                console.log("TRACKID: " + trackId);
                console.log("first col: " + $(this).find("td:eq(0)").text());
                let title = $(this).find("td:eq(0)").text();
                let playTime = $(this).find("td:eq(1)").text();
                let artist = $(this).find("td:eq(2)").text();
                $.ajax({
                    url: apiUrl,
                    type: post,
                    data: {
                        entity: entity,
                        action: 'getModalInfo',
                        id: trackId
                    },
                    success: function(data) {
                        let modalInfo = JSON.parse(data);
                        console.log("COMPOSER: " + modalInfo.composer);
                        console.log("MEDIATYOE: " + modalInfo.mediatype);
                        console.log("TITLE" + title);
                        $("#track-modal-title h3").text(title + " - (" + artist + ")");
                        $("#playTime").find("p:eq(1)").text(playTime);
                        $("#mediaType").find("p:eq(1)").text(modalInfo.mediatype);
                        $("#track-modal").show();
                    }
                });
                break;
            case "artist":
                break;
            case "album":
                break;
        }   
    });

    $('#music-info').on('click', 'td:last-child', function(e) {
        e.stopPropagation();
    });

    // When the user clicks on (x), close the modal
    $(".close").on("click", function() {
        $("#track-modal").hide();
    });
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(e) {
        var modal = document.getElementById("track-modal");
        if (e.target == modal) {
            $("#track-modal").hide();
        }
    }
}



