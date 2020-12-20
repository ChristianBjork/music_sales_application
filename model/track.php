<?php
    require_once('../db_handler/db_connection.php');

    class Track extends DB {

        /**
         * @param text - parameter which is used in the search query
         * @return an - array with track information
         * 
         */

        function get($searchVal, $offset, $from) {
            $search = '%' . $searchVal . '%';
            $offset = (int)$offset;
            $from = (int)$from;
            $counter = 0;
            $result = array();

            try {
                //If search is empty retrive all information
                //else search by track name
                if($search == '%%') {
                    $query = <<<SQL
                    SELECT SQL_CALC_FOUND_ROWS TrackId, T.Name AS title, T.Milliseconds AS playtime, A.Name AS artist, AL.Title AS album, G.Name AS genre, T.UnitPrice as price 
                    FROM track T
                    INNER JOIN album AL ON T.AlbumId = AL.AlbumId
                    INNER JOIN artist A ON AL.ArtistId = A.ArtistId
                    INNER JOIN genre G ON T.GenreId = G.GenreId
                    LIMIT $from, $offset;
SQL;
                    $stmt = $this->pdo->prepare($query);
                    $stmt->execute([]);
                } else {
                    $query = <<<SQL
                    SELECT SQL_CALC_FOUND_ROWS TrackId, T.Name AS title, T.Milliseconds AS playtime, A.Name AS artist, AL.Title AS album, G.Name AS genre, T.UnitPrice as price 
                    FROM track T
                    INNER JOIN album AL ON T.AlbumId = AL.AlbumId
                    INNER JOIN artist A ON AL.ArtistId = A.ArtistId
                    INNER JOIN genre G ON T.GenreId = G.GenreId
                    WHERE CONCAT_WS('', TrackId, T.Name, T.Milliseconds, A.Name, AL.Title, G.Name, T.UnitPrice) LIKE ?
                    LIMIT $from, $offset;
SQL;
                    $stmt = $this->pdo->prepare($query);
                    $stmt->execute([$search]);
                }

                //$results = $stmt->fetchAll();
                //PDO::FETCH_ASSOC if not work
                while ($row = $stmt->fetch()){ 
                    extract($row);
                    $result[$counter]['TrackId'] = $row['TrackId'];
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

        function getModalInfo($id) {
            try {
                $query = <<<SQL
                SELECT T.Composer AS composer, M.Name AS mediatype 
                FROM track T
                INNER JOIN mediatype M ON T.MediaTypeId = M.MediaTypeId     
                WHERE T.TrackId = ?           
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