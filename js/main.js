$(document).ready(function () {
    getTableInfo(0, 1);
    enableMusicSearch();
    enableModalAction();
    signOut();
    signIn();
});

//Search music info on select change
function enableMusicSearch() {
    $('#artist-thead').hide();
    $('#album-thead').hide();
    $('#search').click(function () {
        getTableInfo(0, 1);
    });

    //Set table entity & update table
    $('#search-opt').on('change', function () {
        switch (this.value) {
            case 'track':
                getTableInfo(0, 1);
                break;
            case 'album':
                getTableInfo(0, 1);
                break;
            case 'artist':
                getTableInfo(0, 1);
                break;
        }
    });
}

//Used for both search & getting all information
function getTableInfo(from, currentPage) {
    let offset = $('.row-per-page').val();
    let searchVal = $.trim($('#search-val').val());
    let entity = $.trim($('#search-opt').val());
    let action;
    if (searchVal.length === 0) {
        action = 'getAll';
    } else {
        action = 'search';
    }
    
    if(!searchVal.match($regExInput)) {
        $('div#snackbar').text("Please don't hack my application! ;-) ");
        showSnackbar();
    }else {
        apiUrl = setApiUrl(entity, action);
        $.ajax({
            url: apiUrl,
            type: GET,
            data:{
                searchVal: searchVal,
                offset: offset,
                from: from
            },
            success: function (data) {
                switch (entity) {
                    case 'track':
                        $('#track-thead').show();
                        $('#artist-thead').hide();
                        $('#album-thead').hide();
                        $('#info-title').text('Tracks');
                        setupTrackTable(data);
                        break;
                    case 'album':
                        $('#track-thead').hide();
                        $('#album-thead').show();
                        $('#artist-thead').hide();
                        $('#info-title').text('Albums');
                        setupAlbumTable(data);
                        break;
                    case 'artist':
                        $('#track-thead').hide();
                        $('#album-thead').hide();
                        $('#artist-thead').show();
                        $('#info-title').text('Artists');
                        setupArtistTable(data);
                        break;
                }
                updatePagination(data[data.length - 1], offset, currentPage);

                //Make last table-row unclickable 
                $('#music-info').on('click', 'td:last-child', function (e) {
                    e.stopPropagation();
                });

            }, failure: function(e) {
                console.log('failure: ' + e);
            }, error: function(e) {
                console.log('error: ' + e);
                console.log(JSON.stringify(e));
            }
        });
    }
}



//Pagination 
$(document).on('click', '.pagination-page-left, .pagination-page-right', function () {
    var i = ($(this).hasClass('pagination-page-left')) ? -1 : 1;
    var newCurrentPage = parseInt($('.current-page').attr('data-current')) + i;
    var offset = $(".row-per-page").val();
    var from = (newCurrentPage - 1) * offset;

    if ($(this).closest('.pagination').hasClass('pagination-bottom')) $('html, body').scrollTop(0);

    getTableInfo(from, newCurrentPage);
});

//Update number of rows
$(document).on('change', '.row-per-page', function () {
    $('.row-per-page').val($(this).val());
    if ($(this).closest('.pagination').hasClass('pagination-bottom')) $('html, body').scrollTop(0);
    getTableInfo(0, 1);
});

//MODAL 
function enableModalAction() {
    $('#music-info').on('click', 'tr', function () {
        let trackId = $(this).attr('data-id');
        let entity = $(this).attr('id');
        let apiUrl = setApiUrl(entity, 'getById');
        $.ajax({
            url: apiUrl,
            type: GET,
            data: {
                id: trackId
            },
            success: function(data) {
                switch (entity) {
                    case 'track':
                        setupTrackModal(data);
                        break;
                    case 'album':
                        setupAlbumModal(data);
                        break;
                    case 'artist':
                        setupArtistModal(data);
                        break;
                }
            }, failure: function(e) {
                console.log('failure: ' + e);
            }, error: function(e) {
                console.log('error: ' + e);
                console.log(JSON.stringify(e));
            }
        });
    });

    // When the user clicks on (x), close the modal
    $('.close').on('click', function () {
        $(".modal").hide();
    });

    // When the user clicks anywhere outside of the modal, close it
    $(window).click(function(e) {
        var track = document.getElementById('track-modal');
        var album = document.getElementById('album-modal');
        var artist = document.getElementById('artist-modal');

        switch(e.target) {
            case track:
                $('#track-modal').hide();
                break;
            case album:
                $('#album-modal').hide();
                break;
            case artist:
                $('#artist-modal').hide();
                break;
            default:
                break;
        }
    });
}

function enablePurchase(){
    $('#music-info').on('click', 'td:last-child', function (e) {
        console.log("THIS IS GOOOOOD");
    });
}