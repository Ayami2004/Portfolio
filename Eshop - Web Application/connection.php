<?php
    // Static Connection
    class Database {
        public static $connection;

        public static function setUpConnection() {
            if (!isset(Database::$connection)) {
                Database::$connection = new mysqli("localhost", "root", "BibbidyBoo8999%", "eshop", "3306");
            }
        }

        public static function iud($q) { //iud = insert, update, delete
            Database::setUpConnection();
            Database::$connection->query($q);
        }

        public static function search($q) {
            Database::setUpConnection();
            $resultset = Database::$connection->query($q);
            return $resultset;
        }
    }

?>