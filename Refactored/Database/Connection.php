<?php

namespace Database;

class Connection
{
    protected $username;
    protected $password;
    protected $database;


    protected static function connect()
    {
        try {
            $username = "root";
            $password = "";
            $dbh = new \PDO('mysql:host=localhost;dbname=artzoro', $username, $password);
            return $dbh;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
