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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </style>
</head>

<body>

    <header>
        <div>
            <img src="img/notes-logo.png" alt="notes-logo" id="notes-logo">
            <!-- <i class="fas fa-music"></i> -->
        </div>
        <h1>Music Store</h1>
    </header>
    <main>
        
        <h2 id="info-title">Tracks</h2>

        <div>
            <select name="search-opt" id="search-opt">
                <option value="track">Track</option>
                <option value="album">Album</option>
                <option value="artist">Artist</option>
            </select>
            <input id="search-val" type="text" placeholder="search">
            <button id="search" type="button">Search</button>
        </div>

        <div class='pagination'>
            <div class='search-results-box'>
                <p class='search-results'></p>
            </div>
            <div class='page-count'>
                <div class="show-per-page">
                    <label>Show per page:</label>
                    <select class='row-per-page'>
                        <option value='15'>15</option>
                        <option value='25'>25</option>
                        <option value='50'>50</option>
                        <option id="showAllTop" value='1000'>All</option>
                    </select>
                </div>
                <div class='pagination-info'></div>
            </div>
        </div>
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