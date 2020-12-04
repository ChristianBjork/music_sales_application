<?php
    require_once('handler_db/db_connection.php');

    class track extends DB {

        /**
         * @param text - parameter which is used in the search query
         * @return an - array with track information
         * 
         */

        function get($id) {

            //Could use "heredoc" but for some reason it results in an error
            // $id = 1;
            $query = <<<'SQL'
            SELECT TrackId, Name, Composer 
            FROM chinook_abridged.track 
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