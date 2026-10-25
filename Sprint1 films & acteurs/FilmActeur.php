<?php

require_once __DIR__ . '/Database.php';

class FilmActeur extends Database
{
    public function koppelActeur(int $filmId, int $acteurId): bool
    {
        $conn = $this->dbConnect();

        $sql = "INSERT IGNORE INTO filmacteur (filmId, acteurId)
                VALUES (:filmId, :acteurId)";

        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            ':filmId' => $filmId,
            ':acteurId' => $acteurId
        ]);
    }

    public function getOverzicht(): array
    {
        $conn = $this->dbConnect();

        $sql = "SELECT
                    film.filmId,
                    film.filmnaam,
                    film.genre,
                    GROUP_CONCAT(acteur.acteurnaam SEPARATOR ', ') AS acteurs
                FROM film
                LEFT JOIN filmacteur ON film.filmId = filmacteur.filmId
                LEFT JOIN acteur ON filmacteur.acteurId = acteur.acteurId
                GROUP BY film.filmId, film.filmnaam, film.genre
                ORDER BY film.filmId DESC";

        $stmt = $conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}