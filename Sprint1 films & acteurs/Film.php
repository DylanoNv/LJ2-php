<?php

require_once __DIR__ . '/Database.php';

class Film extends Database
{
    public function addFilm(string $filmnaam, string $genre): bool
    {
        $conn = $this->dbConnect();

        $sql = "INSERT INTO film (filmnaam, genre)
                VALUES (:filmnaam, :genre)";

        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            ':filmnaam' => $filmnaam,
            ':genre' => $genre
        ]);
    }

    public function getFilms(): array
    {
        $conn = $this->dbConnect();

        $sql = "SELECT * FROM film ORDER BY filmId DESC";
        $stmt = $conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}