function setupTrackTable(data) {
    let table = ''
    console.log("TRACK NAME" + data[1].title);
    data.forEach( trackInfo => {
        console.log(trackInfo.price);
        table += "<tr data-track_id='" + trackInfo.TrackId + "'>";
                table += "<td>" + trackInfo.title + "</td>";
                table += "<td>" + trackInfo.artist + "</td>";
                table += "<td>" + trackInfo.album + "</td>";
                table += "<td>" + trackInfo.genre + "</td>";
                table += "<td>" + trackInfo.price + "$</td>";
                table += "<td><button>Info</button></td>";
        table += "</tr>";
    });
    $("#music-info-table").find("tbody").html(table);
}