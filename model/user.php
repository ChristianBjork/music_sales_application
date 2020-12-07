<?php
    require_once('../db_handler/db_connection.php');

    class User extends DB {

        // public int $userID;
        // public string $firstName;
        // public string $lastName;
        // public string $password;
        // public string $company;
        // public string $address;
        // public string $city;
        // public string $state;
        // public string $country;
        // public string $postalCode;
        // public string $phone;
        // public string $fax;
        // public string $email;

        /**
         * CREATE NEW USER
         * 
         * @param firstName
         * @param lastName
         * @param password
         * @param company
         * @param address
         * @param city
         * @param state
         * @param country
         * @param postalCode
         * @param phone
         * @param fax
         * @param email
         * @return  true if the user is create and false if the user already exists
         */

        function create($firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email) {
            // Check if the user email already exist
            $query = <<<'SQL'
                SELECT COUNT(*) AS emailTotal FROM customer WHERE Email = ?;
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$email]);
            if ($stmt->fetch()['emailTotal'] > 0) {
                return false;
            }

            $password = password_hash($password, PASSWORD_DEFAULT);

            $query = <<<'SQL'
                INSERT INTO customer (FirstName, LastName, Password, Company, Address, City, State, Country, PostalCode, Phone, Fax, Email) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
SQL;
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email]);

            $this->disconnect();

            return true;
        }

        /**
         * VALIDATE USER LOGIN
         * 
         * @param email
         * @param password
         * @return true if password is valid
         */

        function validate($email, $password) {
            //Select user data
            $query = "SELECT CustomerId, FirstName, LastName, Password FROM customer WHERE Email = ?;";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$email]);
            if ($stmt->rowCount() === 0) {
                return false;
            }

            $row = $stmt->fetch();

            return (password_verify($password, $row['Password']));
         }
    }
?>