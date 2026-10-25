<?php

class Database
{
    public function dbConnect(): PDO
    {
        $host = 'localhost';
        $dbname = 'films_acteurs';
        $username = 'root';
        $password = '';

        return new PDO(
            "mysql:host=$host;dbname=$dbname",
            $username,
            $password
        );
    }
}