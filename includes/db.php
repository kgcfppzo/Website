<?php
class Database {
    private $pdo;

    public function __construct() {
        try {
            global $dbName, $dbHost, $dbUser, $dbPass;
            $this->pdo = new PDO(
                // 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, 
                'mysql:host=' . $dbHost . ';dbname=' . $dbName, 
                $dbUser, 
                $dbPass
            );
            // Set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    // Method to execute a SELECT query
    public function select($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to execute an INSERT, UPDATE, DELETE query
    public function execute($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
// $db;
// if(!$db){
    $db = new Database();
// }
?>
