<?php

namespace Database;

class Connection
{


    protected static function connect()
    {
        try {
            $username = "root";
            $password = "";
            $dbh = new \PDO('mysql:host=localhost;dbname=artzoro', $username, '');
            return $dbh;
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
