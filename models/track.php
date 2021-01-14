<?php
    require_once('../../db_handler/db_connection.php');

    class Track extends DB {
        
        function create($name, $albumId, $mediaTypeId, $genreId, $composer, $milliseconds, $bytes, $unitPrice) {
            $result = array();
            try {
                $query = <<<SQL
                    INSERT INTO track (Name, AlbumId, MediaTypeId, GenreId, Composer, Milliseconds, Bytes, UnitPrice) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?);
SQL;
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$name, $albumId, $mediaTypeId, $genreId, $composer, $milliseconds, $bytes, $unitPrice]);
    
                $affectedRows = $stmt->rowCount();
                if ($affectedRows == 0) {
                    $result['isTrackCreated'] = false;
                } else {
                    $result['isTrackCreated'] = true;
                }
                $result['affectedRows'] = $affectedRows;
                $this->disconnect();
                
            } catch (PDOException $e) {
                die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
                exit();
                return false;
            }
                return $result;
        }

        function getAll($offset, $from) {
            $offset = (int)$offset;
            $from = (int)$from;
            $counter = 0;
            $result = array();

            try {
                
                $query = <<<SQL
                SELECT SQL_CALC_FOUND_ROWS T.TrackId AS trackId, T.Name AS title, T.Milliseconds AS playtime, A.Name AS artist, AL.Title AS album, G.Name AS genre, T.UnitPrice as price 
                FROM track T
                INNER JOIN album AL ON T.AlbumId = AL.AlbumId
                INNER JOIN artist A ON AL.ArtistId = A.ArtistId
                INNER JOIN genre G ON T.GenreId = G.GenreId
                LIMIT $from, $offset;
SQL;
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
            
                while ($row = $stmt->fetch()){ 
                    extract($row);
                    $result[$counter]['trackId'] = $row['trackId'];
                    $result[$counter]['title'] = $row['title'];
                    $result[$counter]['playtime'] = $row['playtime'];
                    $result[$counter]['artist'] = $row['artist'];
                    $result[$counter]['album'] = $row['album'];
                    $result[$counter]['genre'] = $row['genre'];
                    $result[$counter]['price'] = $row['price'];
                    $counter++;
                }

                $stmt = $this->pdo->prepare("SELECT FOUND_ROWS()");
                $stmt->execute();
                $maxRows = $stmt->fetchColumn();
                array_push($result, $maxRows);

                $this->disconnect();
            } catch (PDOException $e) {
                die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
                exit();
            }
            return $result;
        }

        function update($id, $name, $albumId, $mediaTypeId, $genreId, $composer, $milliseconds, $bytes, $unitPrice) {
            $result = array();
            try {
                $query = <<<SQL
                    UPDATE track 
                    SET Name = ?, AlbumId = ?, MediaTypeId = ?, GenreId = ?, Composer = ?, Milliseconds = ?, Bytes = ?, UnitPrice = ?
                    WHERE TrackId = ?
SQL;
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$name, $albumId, $mediaTypeId, $genreId, $composer, $milliseconds, $bytes, $unitPrice, $id]);
    
                $affectedRows = $stmt->rowCount();
                
                if ($affectedRows == 0) {
                    $result['isTrackUpdated'] = false;
                } else {
                    $result['isTrackUpdated'] = true;
                }
                $result['affectedRows'] = $affectedRows;
                $this->disconnect();

            } catch (PDOException $e) {
                die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
                exit();
                return false;
            }
                return $result;
        }

        function delete($id) {
            $result = array();
            try {
                $query = <<<SQL
                DELETE FROM track WHERE TrackId = ?;
SQL;
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$id]);
                $deletedRows = $stmt->rowCount();
                
                if ($deletedRows == 0) {
                    $result['isTrackDeleted'] = false;
                } else {
                    $result['isTrackDeleted'] = true;
                }

                $result['deletedRows'] = $deletedRows;
                $this->disconnect();

            } catch (PDOException $e) {
                die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
                exit();
                return false;
            }
            return $result;
        }

        function getById($id) {
            try {
                $query = <<<SQL
                SELECT TrackId, T.Name AS title, T.Milliseconds AS playtime, A.Name AS artist, AL.Title AS album, G.Name AS genre, T.UnitPrice as price, T.Composer AS composer, T.Bytes AS fileSize, M.Name AS mediatype 
                FROM track T
                INNER JOIN album AL ON T.AlbumId = AL.AlbumId
                INNER JOIN artist A ON AL.ArtistId = A.ArtistId
                INNER JOIN genre G ON T.GenreId = G.GenreId
                INNER JOIN mediatype M ON T.MediaTypeId = M.MediaTypeId     
                WHERE T.TrackId = ?;           
        SQL;
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$id]);
            
                $result = $stmt->fetch();
        
                $this->disconnect();
            } catch (PDOException $e) {
                die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
                exit();
            }
            return $result;
        }
        
        function searchTrack($searchVal, $offset, $from) {
            $search = '%' . $searchVal . '%';
            $offset = (int)$offset;
            $from = (int)$from;
            $counter = 0;
            $result = array();

            try {
                $query = <<<SQL
                SELECT SQL_CALC_FOUND_ROWS T.TrackId AS trackId, T.Name AS title, T.Milliseconds AS playtime, A.Name AS artist, AL.Title AS album, G.Name AS genre, T.UnitPrice as price 
                FROM track T
                INNER JOIN album AL ON T.AlbumId = AL.AlbumId
                INNER JOIN artist A ON AL.ArtistId = A.ArtistId
                INNER JOIN genre G ON T.GenreId = G.GenreId
                WHERE CONCAT_WS('', T.TrackId, T.Name, T.Milliseconds, A.Name, AL.Title, G.Name, T.UnitPrice) LIKE ?
                LIMIT $from, $offset;
SQL;
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$search]);

                while ($row = $stmt->fetch()){ 
                    extract($row);
                    $result[$counter]['trackId'] = $row['trackId'];
                    $result[$counter]['title'] = $row['title'];
                    $result[$counter]['playtime'] = $row['playtime'];
                    $result[$counter]['artist'] = $row['artist'];
                    $result[$counter]['album'] = $row['album'];
                    $result[$counter]['genre'] = $row['genre'];
                    $result[$counter]['price'] = $row['price'];
                    $counter++;
                }

                $stmt = $this->pdo->prepare("SELECT FOUND_ROWS()");
                $stmt->execute();
                $maxRows = $stmt->fetchColumn();
                array_push($result, $maxRows);

                $this->disconnect();
            } catch (PDOException $e) {
                die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
                exit();
            }
            
            return $result;
        }

    }
?>