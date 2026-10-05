<?php

class User
{
    private string $username;
    private string $password;
    private string $email;
    private string $role;

    public function dbConnect(): PDO
    {
        $host = 'localhost';
        $dbname = 'login';
        $username = 'root';
        $password = '';

        $conn = new PDO(
            "mysql:host=$host;dbname=$dbname",
            $username,
            $password
        );

        return $conn;
    }
}