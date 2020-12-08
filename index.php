<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Store</title>
    <link rel="stylesheet" href="css/styles.css">
    </style>
</head>

<body>

    <header>
        <div>
            <img src="img/notes-logo.png" alt="notes-logo" id="notes-logo">
        </div>
        <h1>Music Store</h1>
    </header>
    <main>
        <div>
            <select name="search-opt" id="search-opt">
                <option value="track">Track</option>
                <option value="album">Album</option>
                <option value="artist">Artist</option>
            </select>
            <input id="search-val" type="text" placeholder="search">
            <button id="search" type="button">Search</button>
        </div>
        
        <h2 id="info-title">Tracks</h2>
        <table id="music-info-table">
            <thead id="track-thead">
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Genre</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <thead id="album-head" hidden>
                <tr>
                        <th>Title</th>
                        <th>Artist</th>
                        <th></th>
                        <th></th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
            </thead>

            <tbody>
                
            </tbody>
        </table>
    </main>

</body>

</html>