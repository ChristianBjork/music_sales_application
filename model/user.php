<?php
    require_once('../db_handler/db_connection.php');

    class User extends DB {

        function create($firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email) {
            try {
            // Check if the user email already exist
            $query = <<<SQL
                SELECT COUNT(*) AS emailTotal FROM customer WHERE Email = ?;
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$email]);
            if ($stmt->fetch()['emailTotal'] > 0) {
                return false;
            }

            $password = password_hash($password, PASSWORD_DEFAULT);

            $query = <<<SQL
                INSERT INTO customer (FirstName, LastName, Password, Company, Address, City, State, Country, PostalCode, Phone, Fax, Email) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email]);

            $this->disconnect();
        } catch (PDOException $e) {
            die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
            exit();
        }

            return true;
        }

        function validate($email, $password) {
            //Select user data
            $query = "SELECT CustomerId, FirstName, LastName, Password FROM customer WHERE Email = ?;";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$email]);
            if ($stmt->rowCount() === 0) {
                return false;
            }

            $row = $stmt->fetch();

            if(password_verify($password, $row['Password'])) {
                $_SESSION['userId'] = $row['CustomerId'];
                $_SESSION['firstName'] = $row['FirstName'];
                $_SESSION['lastName'] = $row['LastName'];
                $_SESSION['email'] = $email;
                return true;
            } else {
                return false;
            }
        }


        function signOut(){
            session_destroy();

            return "User logged out";
        }
         
    }
?>