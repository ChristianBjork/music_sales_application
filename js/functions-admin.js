// Based on what is selected, this function returns the correct data, which will be created in the db
function getCreateData(entity){
    var data;
    switch(entity){
        case 'track':
            data = JSON.stringify({
                name: $('#add-track-name').val(),
                albumId: $('#add-track-albumId').val(),
                mediaTypeId : $('#add-track-mediaTypeId').val() ,
                genreId: $('#add-track-genreId').val(),
                composer: $('#add-track-composer').val(),
                milliseconds: $('#add-track-milliseconds').val(),
                bytes: $('#add-track-bytes').val(),
                unitPrice: $('#add-track-unitPrice').val()
            });
            return data;
        case 'album':
            data = JSON.stringify({
                title: $('#add-album-title').val(),
                artistId: $('#add-album-artistId').val()
            });
            return data;

        case 'artist':
            data = JSON.stringify({
                name: $('#add-artist-name').val()
            });
            return data;
    }
}

// Based on what is selected, this function returns the correct data, which will be updated in the db
function getUpdateData(entity){
    var data;
    switch(entity){
        case 'track':
            data = JSON.stringify({
                id: $('#update-trackId').attr('data-id'),
                name: $('#update-track-name').val(),
                albumId: $('#update-track-albumId').val(),
                mediaTypeId : $('#update-track-mediaTypeId').val() ,
                genreId: $('#update-track-genreId').val(),
                composer: $('#update-track-composer').val(),
                milliseconds: $('#update-track-milliseconds').val(),
                bytes: $('#update-track-bytes').val(),
                unitPrice: $('#update-track-unitPrice').val()
            });
            return data;
        case 'album':
            data = JSON.stringify({
                id: $('#update-albumId').attr('data-id'),
                title: $('#update-album-title').val(),
                artistId: $('#update-album-artistId').val()
            });
            return data;
        case 'artist':
            data = JSON.stringify({
                id: $('#update-artistId').attr('data-id'),
                name: $('#update-artist-name').val()
            });
            return data;
    }
}

// Get id for the music which is to be deleted
function getDeleteId(entity) {
    switch(entity){
        case 'track':
            data = JSON.stringify({
                id: $('#update-trackId').attr('data-id')
            });
            return data;
        case 'album':
            data = JSON.stringify({
                id: $('#update-albumId').attr('data-id')
            });
            return data;
        case 'artist':
            data = JSON.stringify({
                id: $('#update-artistId').attr('data-id')
            });
            return data;
    }
}

// Setup Admin Modals
function trackModalUpdate(data) {
    $('#update-trackId').attr('data-id', data.trackId);
    $('#update-track-name').val(data.name);
    $('#update-track-albumId').val(data.albumId);
    $('#update-track-mediaTypeId').val(data.mediaTypeId);
    $('#update-track-genreId').val(data.genreId);
    if(data.composer == null) {
        $('#update-track-composer').val('');
    } else {
        $('#update-track-composer').val(data.composer);
    } 
    $('#update-track-milliseconds').val(data.playtime);
    $('#update-track-bytes').val(data.fileSize);
    $('#update-track-unitPrice').val(data.price);

    $('#admin-update-track-modal').show();
}

function albumModalUpdate(data){
    $('#update-albumId').attr('data-id', data.albumId);
    $('#update-album-title').val(data.title);
    $('#update-album-artistId').val(data.artistId);

    $('#admin-update-album-modal').show();
}

function artistModalUpdate(data) {
    $('#update-artistId').attr('data-id', data.artistId);
    $('#update-artist-name').val(data.name);

    $('#admin-update-artist-modal').show();
}

function enableDeleteBtn(buttonId, entity) {
    $(buttonId).on('click', function(){
        const action = 'delete';
        apiUrl = setAdminApiUrl(entity, action);
        let data = getDeleteId(entity);
        console.log(data);
        $.ajax({
            url: apiUrl,
            type: POST,
            data: data,
            success: function(data){
                switch(entity){
                    case 'track':
                        if(data.isTrackDeleted) {
                            $('div#snackbar').text('Track was successfully deleted!');
                            showSnackbar();
                            $('input[type="text"]').val("");
                            $('#admin-update-track-modal').hide();
                            getTableInfo(0, 1);
                        } else {
                            $('div#snackbar').text('Something went wrong, pls try again');
                            showSnackbar();
                        }
                        break;
                    case 'album':
                        if(data.isAlbumDeleted) {
                            $('#snackbar').text('Album was successfully deleted!');
                            showSnackbar();
                            $('input[type="text"]').val("");
                            $('#admin-update-album-modal').hide();
                            getTableInfo(0, 1);
                        } else {
                            $('#snackbar').text('Something went wrong, pls try again');
                            showSnackbar();
                        }
                        break;
                        case 'artist':
                        if(data.isArtistDeleted) {
                            $('#snackbar').text('Artist was successfully deleted!');
                            showSnackbar();
                            $('input[type="text"]').val("");
                            $('#admin-update-artist-modal').hide();
                            getTableInfo(0, 1);
                        } else {
                            $('div#snackbar').text('Something went wrong, pls try again');
                            showSnackbar();
                        }
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
}

//Snackbar
function showSnackbar(){
    let snackbar = document.getElementById("snackbar");
    snackbar.className = "show";
    
    setTimeout(function(){snackbar.className = snackbar.className.replace("show", ""); }, 3000);
    
}
// Setting the url for the wanted api within ajax for admin calls
function setAdminApiUrl(entity, action) {
    switch(entity) {
        case 'track':
            switch(action){
                case 'create':
                    return 'api/track/create.php';
                case 'update':
                    return 'api/track/update.php';
                case 'delete':
                    return 'api/track/delete.php';
            }
        case "album":
            switch(action){
                case 'create':
                    return "api/album/create.php";
                case 'update':
                    return "api/album/update.php";
                case 'delete':
                    return "api/album/delete.php";
            }
        case "artist":
            switch(action){
                case 'create':
                    return "api/artist/create.php";
                case 'update':
                    return "api/artist/update.php";
                case 'delete':
                    return "api/artist/delete.php";
            }
        case "user":
            switch(action){
                case "create":
                    return "api/user/create.php";
            }
    }
}
