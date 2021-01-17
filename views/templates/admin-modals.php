<div class="modal" id="admin-add-modal">
    <div class="form" id="admin-add">
        <span class="close"><i class="far fa-times-circle"></i></span>
        <div class="modal-add-selector">
            <h3>Add new</h3>
            <select name="add-music-opt" id="add-music-opt">
                <option value="track">Track</option>
                <option value="album">Album</option>
                <option value="artist">Artist</option>
            </select>
        </div>
        <div class="track-modal-add">    
            <input type="text" id="add-track-name" placeholder="Track Title" />
            <input type="text" id="add-track-albumId" placeholder="Album" />
            <input type="text" id="add-track-mediaTypeId" placeholder="Media" />
            <input type="text" id="add-track-genreId" placeholder="Genre" />
            <input type="text" id="add-track-composer" placeholder="Composer/Composers" />
            <input type="text" id="add-track-milliseconds" placeholder="Playtime" />
            <input type="text" id="add-track-bytes" placeholder="Size" />
            <input type="text" id="add-track-unitPrice" placeholder="Price"/>
        </div>
        <div class="album-modal-add">    
            <input type="text" id="add-album-title" placeholder="Album Title" />
            <input type="text" id="add-album-artistId" placeholder="Artist" />
        </div>
        <div class="artist-modal-add">    
            <input type="text" id="add-artist-name" placeholder="Artist Name" />
        </div>

        <button id="add-music-btn" type="button">Save</button>
    </div>
</div>