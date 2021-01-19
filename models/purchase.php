<?php
require_once('../../db_handler/db_connection.php');
class Purchase extends DB{

    function createInvoice($userId, $invoiceDate, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $price) {
        $result = array();
        try {
        $query =<<<'SQL'
                INSERT INTO invoice(
                CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, Total)
                VALUES (?,?,?,?,?,?,?,?);
SQL;
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$userId, $invoiceDate, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $price]);

                
                $affectedRows = $stmt->rowCount();
                
                if ($affectedRows == 0) {
                    $result['isInvoiceCreated'] = false;
                } else {
                    $result['isInvoiceCreated'] = true;
                }
                $result['affectedRows'] = $affectedRows;
                $this->disconnect();
                
            } catch (PDOException $e) {
                die('{"status": "error", "connection": "' . $e->getMessage() . '"}');
                exit();
            }
                return $result;
        }
    }

    
?>