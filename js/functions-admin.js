// Based on what is selected, this function adds the correct data, which will be created in the db
function setCreateData(entity){
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

// Setting the url for the wanted api within ajax for admin calls
function setAdminApiUrl(entity, action) {
    switch(entity) {
        case "track":
            switch(action){
                case 'create':
                    return "api/track/create.php";
            }
        case "album":
            switch(action){
                case 'create':
                    return "api/album/create.php";
            }
        case "artist":
            switch(action){
                case 'create':
                    return "api/artist/create.php";
            }
        case "user":
            switch(action){
                case "create":
                    return "api/user/create.php";
            }
    }
}

//Snackbar
function showSnackbar(){
    console.log("SNACKITY");
    let snackbar = document.getElementById("snackbar");
    snackbar.className = "show";

    setTimeout(function(){snackbar.className = snackbar.className.replace("show", ""); }, 3000);
    
}