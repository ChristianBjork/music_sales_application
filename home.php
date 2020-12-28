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
        <div class="img-title">
            <img src="img/notes-logo.png" alt="notes-logo" id="notes-logo">
            <div class="home-title">
                <h1>Music Store</h1>
            </div>
        </div>
        <div class="user-signout">
            <i class="far fa-user fa-2x h-icon"></i>
            <i class="fas fa-sign-out-alt fa-2x h-icon" id="sign-out-btn"></i>
        </div>
    </header>
    <main>

        <h2 id="info-title">Tracks</h2>

        <div class="search-div">
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
                        <option value='25'>25</option>
                        <option value='50'>50</option>
                        <option value='100'>100</option>
                        <option value='1000'>1000</option>
                    </select>
                </div>
                <div class='pagination-info'></div>
            </div>
        </div>
        <table id="music-info-table">
            <thead id="track-thead">
                <tr>
                    <th>Track Title</th>
                    <th>Playtime</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Genre</th>
                    <th>Price</th>
                </tr>
            </thead>
            <thead id="album-thead">
                <tr>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Tracks</th>
                        <th>Price</th>
                    </tr>
            </thead>
            <thead id="artist-thead">
                <tr>
                        <th>Artist</th>
                        <th>Albums</th>
                        <th>Tracks</th>
                        <th>Genre</th>
                </tr>
            </thead>
            <tbody id="music-info">
            </tbody>
        </table>
        <div class="modal" id="track-modal">
            <div class="modal-content">
                <div class="title" id="track-modal-title">
                    <h3>Track Title - minutes</h3>
                    <span class="close"><i class="far fa-times-circle"></i></span>
                </div>
                <div id="album"><p>Album:</p><p></p></div>
                <div id="genre"><p>Genre:</p><p></p></div>
                <div id="playTime"><p>Playtime:</p><p></p></div>
                <div id="composer"><p>Composer:</p><p></p></div>
                <div id="mediaType"><p>Media Type:</p><p></p></div>
                <div id="fileSize"><p>Size:</p> <p></p></div>
            </div>
        </div>
        <div class="modal" id="album-modal">
            <div class="modal-content">
                <div class="title" id="album-modal-title">
                    <h3>Album Title - artist</h3>
                    <span class="close"><i class="far fa-times-circle"></i></span>
                </div>
                <div id="album-tracks"><p>Tracks:</p><p></p></div>
                <div id="album-genre"><p>Genre:</p><p></p></div>
                <div id="album-playTime"><p>Playtime:</p><p></p></div>
                <div id="album-composer"><p>Composer:</p> <p></p></div>
                <div id="album-mediaType"><p>Media Type:</p><p></p></div>
                <div id="album-fileSize"><p>Size:</p> <p></p></div>
            </div>
        </div>
        <div class="modal" id="artist-modal">
            <div class="modal-content">
                <div class="title" id="artist-modal-title">
                    <h3>artist Name</h3>
                    <span class="close"><i class="far fa-times-circle"></i></span>
                </div> 
                <div id="artist-albums"><p>Albums:</p><p></p></div>
                <div id="artist-tracks"><p>Tracks:</p><p></p></div>
                <div id="artist-genre"><p>Genre:</p><p></p></div>
            </div>
        </div>
    </main>

</body>

</html>