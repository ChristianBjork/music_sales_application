<?php
    require_once('../db_handler/db_connection.php');

    class Track extends DB {

        /**
         * @param text - parameter which is used in the search query
         * @return an - array with track information
         * 
         */

        function get($id) {
            $query = <<<'SQL'
            SELECT TrackId, Name, Composer 
            FROM track 
            WHERE TrackId = ?;
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$id]);
            $results = $stmt->fetch();

            $this->disconnect();

            return $results;
        }
    }
?>