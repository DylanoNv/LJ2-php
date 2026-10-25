<?php

require_once __DIR__ . '/Film.php';
require_once __DIR__ . '/Acteur.php';
require_once __DIR__ . '/FilmActeur.php';

$film = new Film();
$acteur = new Acteur();
$filmActeur = new FilmActeur();

$message = '';

if (isset($_POST['addFilm'])) {
    $filmnaam = trim($_POST['filmnaam']);
    $genre = trim($_POST['genre']);

    if ($filmnaam !== '' && $genre !== '') {
        if ($film->addFilm($filmnaam, $genre)) {
            $message = 'Film toegevoegd!';
        }
    }
}

if (isset($_POST['addActeur'])) {
    $acteurnaam = trim($_POST['acteurnaam']);

    if ($acteurnaam !== '') {
        if ($acteur->addActeur($acteurnaam)) {
            $message = 'Acteur toegevoegd!';
        }
    }
}

if (isset($_POST['koppelActeur'])) {
    $filmId = (int) $_POST['filmId'];
    $acteurId = (int) $_POST['acteurId'];

    if ($filmId > 0 && $acteurId > 0) {
        if ($filmActeur->koppelActeur($filmId, $acteurId)) {
            $message = 'Acteur gekoppeld aan film!';
        }
    }
}

$films = $film->getFilms();
$acteurs = $acteur->getActeurs();
$overzicht = $filmActeur->getOverzicht();

$pagina = $_GET['pagina'] ?? 'home';

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films & Acteurs</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>Films & Acteurs</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="index.php?pagina=film">Film toevoegen</a>
    <a href="index.php?pagina=acteur">Acteur toevoegen</a>
</nav>

<main>

    <?php if ($message !== ''): ?>
        <p class="message">
            <?= htmlspecialchars($message) ?>
        </p>
    <?php endif; ?>

    <?php if ($pagina === 'home'): ?>

        <h2>Overzicht films</h2>

        <table>
            <tr>
                <th>Film</th>
                <th>Genre</th>
                <th>Acteurs</th>
            </tr>

            <?php foreach ($overzicht as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['filmnaam']) ?></td>
                    <td><?= htmlspecialchars($item['genre']) ?></td>
                    <td><?= htmlspecialchars($item['acteurs'] ?? 'Geen acteurs') ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <p>
            <a class="button" href="index.php?pagina=acteur">
                Acteur koppelen
            </a>
        </p>

    <?php elseif ($pagina === 'film'): ?>

        <h2>Film toevoegen</h2>

        <form method="post" action="index.php?pagina=film">

            <label>Filmnaam</label>
            <input type="text" name="filmnaam" required>

            <label>Genre</label>
            <input type="text" name="genre" required>

            <button type="submit" name="addFilm">
                Film opslaan
            </button>

        </form>

    <?php elseif ($pagina === 'acteur'): ?>

        <h2>Acteur toevoegen</h2>

        <form method="post" action="index.php?pagina=acteur">

            <label>Naam acteur</label>
            <input type="text" name="acteurnaam" required>

            <button type="submit" name="addActeur">
                Acteur opslaan
            </button>

        </form>

        <h2>Acteur koppelen aan film</h2>

        <form method="post" action="index.php?pagina=acteur">

            <label>Selecteer film</label>
            <select name="filmId" required>
                <option value="">Kies een film</option>

                <?php foreach ($films as $item): ?>
                    <option value="<?= $item['filmId'] ?>">
                        <?= htmlspecialchars($item['filmnaam']) ?>
                    </option>
                <?php endforeach; ?>

            </select>

            <label>Selecteer acteur</label>
            <select name="acteurId" required>
                <option value="">Kies een acteur</option>

                <?php foreach ($acteurs as $item): ?>
                    <option value="<?= $item['acteurId'] ?>">
                        <?= htmlspecialchars($item['acteurnaam']) ?>
                    </option>
                <?php endforeach; ?>

            </select>

            <button type="submit" name="koppelActeur">
                Koppelen
            </button>

        </form>

    <?php endif; ?>

</main>

</body>
</html>