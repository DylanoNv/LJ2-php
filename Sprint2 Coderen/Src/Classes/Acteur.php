<?php

require_once __DIR__ . '/Database.php';

class Acteur extends Database
{
    public function addActeur(string $acteurnaam): bool
    {
        $conn = $this->dbConnect();

        $sql = "INSERT INTO acteur (acteurnaam)
                VALUES (:acteurnaam)";

        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            ':acteurnaam' => $acteurnaam
        ]);
    }

    public function getActeurs(): array
    {
        $conn = $this->dbConnect();

        $sql = "SELECT * FROM acteur ORDER BY acteurnaam";
        $stmt = $conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}