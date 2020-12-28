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
    $("#search").click(function () {
        console.log("SØG!");
        getTableInfo(0, 1);
    });

    //Set table entity & update table
    $("#search-opt").on('change', function () {
        switch (this.value) {
            case "track":
                console.log("ALBUM SEARCH");
                getTableInfo(0, 1);
                break;
            case "album":
                console.log("ALBUM SEARCH");
                getTableInfo(0, 1);
                break;
            case "artist":
                console.log("ARTIST SEARCH");
                getTableInfo(0, 1);
                break;
            
        }
    });
}

function getTableInfo(from, currentPage) {
    let offset = $(".row-per-page").val();
    let searchVal = $("#search-val").val();
    let searchOpt = $.trim($("#search-opt").val());
    if (search.length === 0) search = '';
    console.log(searchOpt + " --- " + searchVal);
    $.ajax({
        url: apiUrl,
        type: post,
        data: {
            entity: searchOpt,
            action: "get",
            searchVal: searchVal,
            offset: offset,
            from: from
        },
        success: function (data) {
            console.log(data);
            data = JSON.parse(data);
            
            switch (searchOpt) {
                case "track":
                    console.log("TRACK SEARCH");
                    $("#track-thead").show();
                    $("#artist-thead").hide();
                    $("#album-thead").hide();
                    $("#info-title").text("Tracks");
                    setupTrackTable(data);
                    break;
                case "album":
                    console.log("ALBUM SEARCH");
                    $("#track-thead").hide();
                    $("#album-thead").show();
                    $("#artist-thead").hide();
                    $("#info-title").text("Albums");
                    setupAlbumTable(data);
                    break;
                case "artist":
                    console.log("ARTIST SEARCH");
                    $("#track-thead").hide();
                    $("#album-thead").hide();
                    $("#artist-thead").show();
                    $("#info-title").text("Artists");
                    setupArtistTable(data);
                    break;
            }
            updatePagination(data[data.length - 1], offset, currentPage);
        }
    });
}

//Sign Out --------------------
function signout() {
    $("#sign-out-btn").on('click', function () {
        $.ajax({
            url: apiUrl,
            type: post,
            data: {
                entity: "user",
                action: "sign-out"
            },
            success: function () {
                window.location.reload();
            }
        })
    });
}

//Pagination --------------------
$(document).on('click', '.pagination-page-left, .pagination-page-right', function () {
    var i = ($(this).hasClass('pagination-page-left')) ? -1 : 1;
    var newCurrentPage = parseInt($('.current-page').attr('data-current')) + i;
    var offset = $(".row-per-page").val();
    var from = (newCurrentPage - 1) * offset;

    // if ($(this).closest('.pagination').hasClass('pagination-bottom')) $('html, body').scrollTop(0);

    getTableInfo(from, newCurrentPage);
});

//Update number of rows
$(document).on('change', '.show-per-page', function () {
    $('.navigator-number').val($(this).val());
    if ($(this).closest('.pagination').hasClass('pagination-bottom')) $('html, body').scrollTop(0);
    getTableInfo(0, 1);
});

//MODAL --------------------
function enableModalAction() {
    $("#music-info").on("click", "tr", function () {
        let trackId = $(this).attr("data-id");
        let entity = $(this).attr("id");
        console.log("ID: " + entity);

        $.ajax({
            url: apiUrl,
            type: post,
            data: {
                entity: entity,
                action: 'getModalInfo',
                id: trackId
            },
            success: function(data) {
                console.log(data);
                switch (entity) {
                    case "track":
                        setupTrackModal(data);
                        break;
                    case "album":
                        setupAlbumModal(data);
                        break;
                    case "artist":
                        setupArtistModal(data);
                        break;
                }
            }
        });
    });


    $('#music-info').on('click', 'td:last-child', function (e) {
        e.stopPropagation();
    });

    // When the user clicks on (x), close the modal
    $(".close").on("click", function () {
        $(".modal").hide();
    });

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (e) {
        var modal = document.getElementById("track-modal");
        if (e.target == modal) {
            $("#track-modal").hide();
        }
    }
}
