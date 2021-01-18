let apiUrl;
const POST = "POST";
const GET = "GET";

// Setup Tables
function setupTrackTable(data) {
    let table = ''
    data.forEach( function(trackInfo, idx, array) {
        if (idx !== array.length - 1) {
            playtime = millisecondsToMinutes(trackInfo.playtime);
            table += '<tr data-id="' + trackInfo.trackId + '" id="track">';
                table += "<td>" + trackInfo.title + "</td>";
                table += "<td>" + playtime + "</td>";
                table += "<td>" + trackInfo.artist + "</td>";
                table += "<td>" + trackInfo.album + "</td>";
                table += "<td>" + (trackInfo.genre == null ? "Unknown" : trackInfo.genre) + "</td>";
                table += "<td>" + (trackInfo.price == null ? "0" : trackInfo.price) + "$</td>";
                table +=  "<?php> if(isset($_SESSION['ADMIN'])){?>"
                table += '<td id="purchase-column"><span><i class="fas fa-shopping-basket" id="purchase-icon"></i></span></td>';
                table += "<?php } ?>";
            table += "</tr>";
        }
    });
    $("#music-info-table").find("tbody").html(table);
}

function setupAlbumTable(data){
    let table = '';
    data.forEach( function(albumInfo, idx, array) {
        if (idx !== array.length - 1) {
            table += '<tr data-id="' + albumInfo.albumId + '" id="album">';
                    table += "<td>" + albumInfo.title + "</td>";
                    table += "<td>" + albumInfo.artist + "</td>";
                    table += "<td>" + albumInfo.numOfTracks + "</td>";
                    table += "<td>" + (albumInfo.albumPrice == null ? "0" : albumInfo.albumPrice) + "$</td>";
                    table += '<td id="purchase-column"><span><i class="fas fa-shopping-basket" id="purchase-icon"></i></span></td>';
            table += "</tr>";
        }
    });
    $("#music-info-table").find("tbody").html(table);
}

function setupArtistTable(data){
    let table = '';
    data.forEach( function(artistInfo, idx, array) {
        if (idx !== array.length - 1) {
            table += '<tr data-id="' + artistInfo.artistId + '" id="artist">';
                    table += "<td>" + artistInfo.artist + "</td>";
                    table += "<td>" + artistInfo.numOfAlbums + "</td>";
                    table += "<td>" + artistInfo.numOfTracks + "</td>";
                    table += "<td>" + (artistInfo.genres == null ? "Unknown" : artistInfo.genres) + "</td>";
            table += "</tr>";
        }
    });
    $("#music-info-table").find("tbody").html(table);
}

function updatePagination(maxRows, offset, currentPage){
    $('.search-results').html(maxRows + ' Results');
    var totalPages = Math.ceil(maxRows / offset)
    if (totalPages == 0) currentPage = 0;
    var returnHTML = "";
    returnHTML += (currentPage == 1 || currentPage == 0) ? "<p>Page:</p><p class='pagination-page-disable'><i class='fas fa-angle-left'></i></p>" : "<p>Page:</p><p class='pagination-page-left'><i class='fas fa-angle-left'></i></p>";
    returnHTML += "<p class='current-page' data-current='" + currentPage + "' data-total='" + totalPages + "'>" + currentPage + " / " + totalPages + "</p>";
    returnHTML += (currentPage == totalPages) ? "<p class='pagination-page-disable'><i class='fas fa-angle-right'></i></p>" : "<p class='pagination-page-right'><i class='fas fa-angle-right'></i></p>";
    $('.pagination-info').html(returnHTML);
}

// Setup Modals
function setupTrackModal(data) {
    let playtime = millisecondsToMinutes(data.playtime);
    $("#track-modal-title h3").text(data.title + " - (" + data.artist + ")");
    $("#album").find("p:eq(1)").text(data.album);
    $("#genre").find("p:eq(1)").text(data.genre);
    $("#playTime").find("p:eq(1)").text(playtime);
    $("#mediaType").find("p:eq(1)").text(data.mediatype);
    if(data.composer == null) {
        $("#composer").find("p:eq(0)").text("No composers credited for this song.");

    } else if(data.composer.split(",").length > 1) {
        $("#composer").find("p:eq(0)").text("Composers:");
    } else {
        $("#composer").find("p:eq(0)").text("Composer:");
    }
    $("#composer").find("p:eq(1)").text(data.composer);
    let fileSize = bytesToSize(data.fileSize);
    $("#fileSize").find("p:eq(1)").text(fileSize);

    $("#track-modal").show();
}

function setupAlbumModal(data) {
    $("#album-modal-title h3").text(data.title + " - (" + data.artist + ")");
    $("#album-tracks").find("p:eq(1)").text(data.tracks);
    $("#album-genre").find("p:eq(1)").text(data.genre);
    let playtime = millisecondsToMinutes(data.totalPlaytime);
    $("#album-playTime").find("p:eq(1)").text(playtime);
    if(data.composer == null) {
        $("#album-composer").find("p:eq(0)").text("No composers credited for this album.");  
    } else if(data.composer.split(",").length > 1) {
        $("#album-composer").find("p:eq(0)").text("Composers:");
    } else {
        $("#album-composer").find("p:eq(0)").text("Composer:");
    }
    $("#album-composer").find("p:eq(1)").text(data.composer);
    $("#album-mediaType").find("p:eq(1)").text(data.mediatype);
    let totalFileSize = bytesToSize(data.totalFileSize);
    $("#album-fileSize").find("p:eq(1)").text(totalFileSize);

    $("#album-modal").show();
}

function setupArtistModal(data) {
    $("#artist-modal-title h3").text(data.title);
    $("#artist-albums").find("p:eq(1)").text(data.albums);
    $("#artist-tracks").find("p:eq(1)").text(data.tracks);
    $("#artist-genre").find("p:eq(1)").text(data.genre);

    $("#artist-modal").show();
}

function millisecondsToMinutes(ms) {
    var minutes = Math.floor(ms / 60000);
    var seconds = ((ms % 60000) / 1000).toFixed(0);
    return (seconds == 60 ? (minutes+1) + ":00" : minutes + ":" + (seconds < 10 ? "0" : "") + seconds + " min");
}

function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return '0 Byte';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

// setting the url for the wanted api within ajax calls
function setApiUrl(entity, action) {
    switch(entity) {
        case "track":
            switch(action){
                case "getAll":
                    return "api/track/getAll.php";
                case 'getById':
                    return "api/track/getById.php";
                case 'search':
                    return "api/track/search.php";
                }
            break;
        case "album":
            switch(action){
                case "getAll":
                    return "api/album/getAll.php";
                case 'getById':
                    return "api/album/getById.php";
                case 'search':
                    return "api/album/search.php";
                }
            break;
        case "artist":
            switch(action){
                case "getAll":
                    return "api/artist/getAll.php";
                case 'getById':
                    return "api/artist/getById.php";
                case 'search':
                    return "api/artist/search.php";
                }
            break;
        case "user":
            switch(action){
                case "create":
                    return "api/user/create.php";
                case "validate":
                    return "api/user/validate.php";
                case "sign-out":
                    return "api/user/sign-out.php";
            }
            break;
    }
}
