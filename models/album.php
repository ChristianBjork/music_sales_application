<?php
    require_once('../../db_handler/db_connection.php');

    class Album extends DB {

        function getAll($offset, $from) {
            $offset = (int)$offset;
            $from = (int)$from;
            $counter = 0;
            $result = array();

            try {
                $query = <<<SQL
                SELECT SQL_CALC_FOUND_ROWS AL.AlbumId AS albumId, AL.Title AS title, A.Name AS artist, COUNT(T.AlbumId) AS numOfTracks, SUM(T.UnitPrice) AS albumPrice  
                FROM album AL
                LEFT JOIN track T ON T.AlbumId = AL.AlbumId
                INNER JOIN artist A ON A.ArtistId = AL.ArtistId
                GROUP BY AL.Title
                LIMIT $from, $offset;
SQL;
                $stmt = $this->pdo->prepare($query);
                $stmt->execute();
                
                while ($row = $stmt->fetch()){ 
                    extract($row);
                    $result[$counter]['albumId'] = $row['albumId'];
                    $result[$counter]['title'] = $row['title'];
                    $result[$counter]['artist'] = $row['artist'];
                    $result[$counter]['numOfTracks'] = $row['numOfTracks'];
                    $result[$counter]['albumPrice'] = $row['albumPrice'];
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

        function searchAlbum($searchVal, $offset, $from) {
            $search = '%' . $searchVal . '%';
            $offset = (int)$offset;
            $from = (int)$from;
            $counter = 0;
            $result = array();

            try {
                $query = <<<SQL
                SELECT SQL_CALC_FOUND_ROWS AL.AlbumId AS albumId, AL.Title AS title, A.Name AS artist, COUNT(T.TrackId) AS numOfTracks, SUM(T.UnitPrice) AS albumPrice  
                FROM album AL
                LEFT JOIN track T ON T.AlbumId = AL.AlbumId
                INNER JOIN artist A ON A.ArtistId = AL.ArtistId
                WHERE CONCAT_WS('', AL.Title, A.Name) LIKE ?
                GROUP BY AL.Title        
                LIMIT $from, $offset;
SQL;
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$search]);

                while ($row = $stmt->fetch()){ 
                    extract($row);
                    $result[$counter]['albumId'] = $row['albumId'];
                    $result[$counter]['title'] = $row['title'];
                    $result[$counter]['artist'] = $row['artist'];
                    $result[$counter]['numOfTracks'] = $row['numOfTracks'];
                    $result[$counter]['albumPrice'] = $row['albumPrice'];
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

        function getById($id) {
            try {
                $query = <<<SQL
                SELECT AL.AlbumId, AL.Title AS title, A.Name as artist, SUM(T.Milliseconds) AS totalPlaytime, GROUP_CONCAT(T.Name SEPARATOR ', ') AS tracks, G.Name AS genre, T.Composer AS composer, SUM(T.Bytes) AS totalFileSize, M.Name AS mediatype, SUM(T.UnitPrice) AS albumPrice  
                FROM album AL
                INNER JOIN track T ON T.AlbumId = AL.AlbumId
                INNER JOIN artist A ON A.ArtistId = AL.ArtistId
                INNER JOIN genre G ON G.GenreId = T.GenreId
                INNER JOIN mediatype M ON M.MediaTypeId  = T.MediaTypeId   
                WHERE AL.AlbumId = ?;           
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

    }
?>