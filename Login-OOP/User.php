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

    public function registerUser(
        string $username,
        string $password,
        string $email,
        string $role
    ): bool {
        $conn = $this->dbConnect();

        // Controleren of het e-mailadres al bestaat
        $sql = "SELECT id FROM user WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);

        if ($stmt->fetch()) {
            return false;
        }

        // Wachtwoord beveiligen
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Nieuwe gebruiker toevoegen
        $sql = "INSERT INTO user (username, password, email, role)
                VALUES (:username, :password, :email, :role)";

        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            ':username' => $username,
            ':password' => $hashedPassword,
            ':email' => $email,
            ':role' => $role
        ]);
    }

    public function loginUser(string $email, string $password): bool
    {
        $conn = $this->dbConnect();

        $sql = "SELECT * FROM user WHERE email = :email";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            return true;
        }

        return false;
    }

    public function isLoggedin(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user_id']);
    }

    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();
    }
}