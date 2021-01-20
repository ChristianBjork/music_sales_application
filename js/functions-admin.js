//Globals for admin
const $regExInputAdmin = /^[A-Za-z0-9.,/_ ]*$/;

// Based on what is selected, this function returns the correct data, which will be created in the db
function getCreateData(entity){
    var data;
    switch(entity){
        case 'track':
            let name = $('#add-track-name').val();
            let albumId = $('#add-track-albumId').val();
            let mediaTypeId = $('#add-track-mediaTypeId').val();
            let genreId = $('#add-track-genreId').val();
            let composer = $('#add-track-composer').val();
            let milliseconds = $('#add-track-milliseconds').val();
            let bytes = $('#add-track-bytes').val();
            let unitPrice = $('#add-track-unitPrice').val();

            if(
                name.length === 0 || albumId.length === 0 || mediaTypeId.length === 0 || genreId.length === 0 || composer.length === 0 || 
                milliseconds.length === 0 || bytes.length === 0 || unitPrice.length === 0
            ) {
                $('div#snackbar').text('Please fill out all fields.');
                showSnackbar();
                return false;
            } else if(
                !name.match($regExInputAdmin) || !albumId.match($regExInputAdmin) || !mediaTypeId.match($regExInputAdmin) || !genreId.match($regExInputAdmin) || !composer.match($regExInputAdmin) || 
                !milliseconds.match($regExInputAdmin) || !bytes.match($regExInputAdmin) || !unitPrice.match($regExInputAdmin)
            ){
                $('div#snackbar').text("Please don't hack my application! ;-) ");
                showSnackbar();
                return false;
            } else {
                data = JSON.stringify({
                    name: name,
                    albumId: albumId,
                    mediaTypeId : mediaTypeId,
                    genreId: genreId,
                    composer: composer,
                    milliseconds: milliseconds,
                    bytes: bytes,
                    unitPrice: unitPrice
                });
                return data;
            }
        case 'album':
            let title = $('#add-album-title').val();
            let artistId = $('#add-album-artistId').val();

            if(
                title.length === 0 || artistId.length === 0 
            ) {
                $('div#snackbar').text('Please fill out all fields.');
                showSnackbar();
                return false;
            } else if(
                !title.match($regExInputAdmin) || !artistId.match($regExInputAdmin)
            ){
                $('div#snackbar').text("Please don't hack my application! ;-) ");
                showSnackbar();
                return false;
            } else {
                data = JSON.stringify({
                    title: title,
                    artistId: artistId
                });
                return data;
            }
        case 'artist':
            let artistName = $('#add-artist-name').val();

            if(
                artistName.length === 0
            ) {
                $('div#snackbar').text('Please fill out all fields.');
                showSnackbar();
                return false;
            } else if(
                !artistName.match($regExInputAdmin)
            ){
                $('div#snackbar').text("Please don't hack my application! ;-) ");
                showSnackbar();
                return false;
            } else {
                data = JSON.stringify({
                    name: artistName
                });
                return data;
            }
        }
}

// Based on what is selected, this function returns the correct data, which will be updated in the db
function getUpdateData(entity){
    var data;
    switch(entity){
        case 'track':
            let name = $('#update-track-name').val();
            let albumId = $('#update-track-albumId').val();
            let mediaTypeId = $('#update-track-mediaTypeId').val();
            let genreId = $('#update-track-genreId').val();
            let composer = $('#update-track-composer').val();
            let milliseconds = $('#update-track-milliseconds').val();
            let bytes = $('#update-track-bytes').val();
            let unitPrice = $('#update-track-unitPrice').val();

            if(
                name.length === 0 || albumId.length === 0 || mediaTypeId.length === 0 || genreId.length === 0 || composer.length === 0 || 
                milliseconds.length === 0 || bytes.length === 0 || unitPrice.length === 0
            ) {
                $('div#snackbar').text('Please fill out all fields.');
                showSnackbar();
                return false;
            } else if(
                !name.match($regExInputAdmin) || !albumId.match($regExInputAdmin) || !mediaTypeId.match($regExInputAdmin) || !genreId.match($regExInputAdmin) || !composer.match($regExInputAdmin) || 
                !milliseconds.match($regExInputAdmin) || !bytes.match($regExInputAdmin) || !unitPrice.match($regExInputAdmin)
            ){
                $('div#snackbar').text("Please don't hack my application! ;-) ");
                showSnackbar();
                return false;
            } else {
                data = JSON.stringify({
                    id: $('#update-trackId').attr('data-id'),
                    name: name,
                    albumId: albumId,
                    mediaTypeId : mediaTypeId,
                    genreId: genreId,
                    composer: composer,
                    milliseconds: milliseconds,
                    bytes: bytes,
                    unitPrice: unitPrice
                });
                return data;
            }
        case 'album':
            let title = $('#update-album-title').val();
            let artistId = $('#update-album-artistId').val();

            if(
                title.length === 0 || artistId.length === 0 
            ) {
                $('div#snackbar').text('Please fill out all fields.');
                showSnackbar();
                return false;
            } else if(
                !title.match($regExInputAdmin) || !artistId.match($regExInputAdmin)
            ){
                $('div#snackbar').text("Please don't hack my application! ;-) ");
                showSnackbar();
                return false;
            } else {
                data = JSON.stringify({
                    id: $('#update-albumId').attr('data-id'),
                    title: title,
                    artistId: artistId
                });
                return data;
            }
        case 'artist':
            let artistName = $('#update-artist-name').val();

            if(
                artistName.length === 0
            ) {
                $('div#snackbar').text('Please fill out all fields.');
                showSnackbar();
                return false;
            } else if(
                !artistName.match($regExInputAdmin)
            ){
                $('div#snackbar').text("Please don't hack my application! ;-) ");
                showSnackbar();
                return false;
            } else {
                data = JSON.stringify({
                    id: $('#update-artistId').attr('data-id'),
                    name: artistName
                });
                return data;
            }
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
                            $('div#snackbar').text('Track Cannot be deleted!');
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
                            $('#snackbar').text('Album Cannot be deleted!');
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
                            $('div#snackbar').text('Artist Cannot be deleted!');
                            showSnackbar();
                        }
                        break;
                    }
                }, failure: function(e) {
                    console.log('failure: ' + e);
                }, error: function(e) {
                console.log('error: ' + JSON.stringify(e));
            }
        });
    });
}

// Setting the url for the wanted api within ajax for admin calls
function setAdminApiUrl(entity, action) {
    switch(entity) {
        case 'track':
            switch(action){
                case 'create':
                    return '../api/track/create.php';
                case 'update':
                    return '../api/track/update.php';
                case 'delete':
                    return '../api/track/delete.php';
            }
        case "album":
            switch(action){
                case 'create':
                    return "../api/album/create.php";
                case 'update':
                    return "../api/album/update.php";
                case 'delete':
                    return "../api/album/delete.php";
            }
        case "artist":
            switch(action){
                case 'create':
                    return "../api/artist/create.php";
                case 'update':
                    return "../api/artist/update.php";
                case 'delete':
                    return "../api/artist/delete.php";
            }
        case "user":
            switch(action){
                case "create":
                    return "../api/user/create.php";
            }
    }
}
