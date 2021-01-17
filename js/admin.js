$(document).ready(function(){
    openAdminAddModal();
    addNewMusic();
    switchAddModalContent();
});


function openAdminAddModal(){
    $('#admin-add-btn').on('click', function(){
        console.log("CLICKED");
        $('#admin-add-modal').show();
    })
}

function addNewMusic() {
    $('#add-music-btn').on('click', function(){
        const entity = $('#add-music-opt').val();
        const action = 'create';
        apiUrl = setAdminApiUrl(entity, action);
        var data = setCreateData(entity);
        $.ajax({
            url: apiUrl,
            type: POST,
            data: data,
            success: function(data){
                switch(entity) {
                    case 'track':
                        if(data.isTrackCreated) {
                            $('div#snackbar').text('Track was successfully added!');
                            showSnackbar();
                            $('input[type="text"]').val("");
                            $('#admin-add-modal').hide();
                        } else {
                            $('div#snackbar').text('Something went wrong, pls try again');
                            showSnackbar();
                        }
                        break;
                    case 'album':
                        if(data.isAlbumCreated) {
                            $('#snackbar').text('Album was successfully added!');
                            showSnackbar();
                            $('input[type="text"]').val("");
                            $('#admin-add-modal').hide();
                        } else {
                            $('#snackbar').text('Something went wrong, pls try again');
                            showSnackbar();
                        }
                        break;
                    case 'artist':
                        if(data.isArtistCreated) {
                            $('#snackbar').text('Artist was successfully added!');
                            showSnackbar();
                            $('input[type="text"]').val("");
                            $('#admin-add-modal').hide();
                        } else {
                            $('div#snackbar').text('Something went wrong, pls try again');
                            showSnackbar();
                        }
                        break;
                }
            }
        });
    });
}

function switchAddModalContent(){
    $("#add-music-opt").on('change', function () {
        switch(this.value) {
            case 'track':
                $('.track-modal-add').show();
                $('.album-modal-add').hide();
                $('.artist-modal-add').hide();
                break;
            case 'album':
                $('.track-modal-add').hide();
                $('.album-modal-add').show();
                $('.artist-modal-add').hide();
                break;
            case 'artist':
                $('.track-modal-add').hide();
                $('.album-modal-add').hide();
                $('.artist-modal-add').show();
                break;
        }
    });
}
