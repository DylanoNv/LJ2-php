<?php

class Database
{
    public function dbConnect(): PDO
    {
        $host = 'localhost';
        $dbname = 'login';
        $username = 'root';
        $password = '';

        return new PDO(
            "mysql:host=$host;dbname=$dbname",
            $username,
            $password
        );
    }
}