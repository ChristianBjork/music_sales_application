<?php
    require_once('../db_handler/db_connection.php');

    class Track extends DB {

        /**
         * @param text - parameter which is used in the search query
         * @return an - array with track information
         * 
         */

        function get($searchVal) {
            $search = '%' . $searchVal . '%';

            try {
                if($search == '%%') {
                    $query = <<<'SQL'
                    SELECT TrackId, T.Name AS title, A.Name AS artist, AL.Title AS album, G.Name AS genre, T.UnitPrice as price 
                    FROM track T
                    INNER JOIN album AL ON T.AlbumId = AL.AlbumId
                    INNER JOIN artist A ON AL.ArtistId = A.ArtistId
                    INNER JOIN genre G ON T.GenreId = G.GenreId
SQL;
                    $stmt = $this->pdo->prepare($query);
                    $stmt->execute();
                } else {
                    $query = <<<'SQL'
                    SELECT TrackId, track.Name AS Title, Artist, Album, genre.Name AS Genre, Price 
                    FROM track T
                    INNER JOIN album AL ON T.AlbumId = AL.AlbumId
                    INNER JOIN artist A ON AL.ArtistId = A.ArtistId
                    INNER JOIN genre G ON T.GenreId = G.GenreId
                    WHERE Name LIKE ?;
SQL;
                    $stmt = $this->pdo->prepare($query);
                    $stmt->execute([$search]);
                }

                $results = $stmt->fetchAll();
    
                $this->disconnect();
            } catch (PDOException $e) {
                die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
                exit();
            }
            

            return $results;
        }
    }
?>