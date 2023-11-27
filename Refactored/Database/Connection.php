<?php

namespace Database;

class Connection
{
    protected static function connect()
    {
        try {
            // Retrieve database credentials from environment variables
            $host = getenv('DB_HOST') ?: 'localhost';
            $dbname = getenv('DB_NAME') ?: 'artzoro';
            $username = getenv('DB_USERNAME') ?: 'root';
            $password = getenv('DB_PASSWORD') ?: '';

            // Create a PDO instance using the retrieved credentials
            $dbh = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);

            return $dbh;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
