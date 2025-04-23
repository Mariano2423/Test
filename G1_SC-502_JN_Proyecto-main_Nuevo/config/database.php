<?php
class Database {
    public static function connect() {
        // conexión usando PDO
        $host = 'localhost';
        $dbname = 'proyecto';
        $username = 'grupo10';
        $password = 'root';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
