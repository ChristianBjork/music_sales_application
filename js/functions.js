function setupTrackTable(data, offset, currentPage) {
    let table = ''
    console.log(data[data.length - 1]);

    data.forEach( function(trackInfo, idx, array) {
        if (idx !== array.length - 1) {
            table += "<tr data-track_id='" + trackInfo.TrackId + "'>";
                    table += "<td>" + trackInfo.title + "</td>";
                    table += "<td>" + trackInfo.artist + "</td>";
                    table += "<td>" + trackInfo.album + "</td>";
                    table += "<td>" + trackInfo.genre + "</td>";
                    table += "<td>" + trackInfo.price + "$</td>";
                    table += "<td><button>Info</button></td>";
            table += "</tr>";
        }
    });
    $("#music-info-table").find("tbody").html(table);

    updatePagination(data[data.length - 1], offset, currentPage);
}


function updatePagination(maxRows, offset, currentPage){
    
    $('.search-results').html(maxRows + ' Results');
    var totalPages = Math.ceil(maxRows / offset)
    if (totalPages == 0) currentPage = 0;
    var returnHTML = "";
    returnHTML += (currentPage == 1 || currentPage == 0) ? "<p>Page:</p><p class='pagination-page-disable'><i class='fas fa-angle-left'></i></p>" : "<p>Page</p><p class='pagination-page-left'><i class='fas fa-angle-left'></i></p>";
    returnHTML += "<p class='current-page' data-current='" + currentPage + "' data-total='" + totalPages + "'>" + currentPage + " / " + totalPages + "</p>";
    returnHTML += (currentPage == totalPages) ? "<p class='pagination-page-disable'><i class='fas fa-angle-right'></i></p>" : "<p class='pagination-page-right'><i class='fas fa-angle-right'></i></p>";
    $('.pagination-info').html(returnHTML);
}