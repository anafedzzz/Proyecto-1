<?php

class DBConnection {

    public static function connection($host = 'localhost', $user = 'root', $password = 'informatica_1', $database = 'restaurant') {

        $connection = new mysqli($host, $user, $password, $database);
        if($connection === false) {
            die("Error: $connection->connect_error");
        }
        $connection-> query("SET NAMES 'utf8'");
        return $connection;

    }

}