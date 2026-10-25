<?php

// classes laden en sessie starten
require_once __DIR__ . '/Dice.php';
require_once __DIR__ . '/Game.php';

session_start();

// nieuwe game maken
if (!isset($_SESSION['game']) || !($_SESSION['game'] instanceof Game)) {
    $_SESSION['game'] = new Game();
}

$game = $_SESSION['game'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['reset'])) {
        $game = new Game();
    } elseif (isset($_POST['throw'])) {
        $game->play();
    }

    $_SESSION['game'] = $game;

    header('Location: index.php');
    exit;
}

$history = $game->getHistory();

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Dobbelspel</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #d1b0b0;
            text-align: center;
            padding: 40px;
        }

        .container {
            background: white;
            max-width: 750px;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
        }

        .dice {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            margin: 20px 0;
        }

        .round {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        button {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            background: #555;
            color: white;
            cursor: pointer;
            margin: 5px;
        }

        button:hover {
            background: #333;
        }

        button:disabled {
            background: #aaa;
            cursor: not-allowed;
        }

        .message {
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Dobbelspel</h1>

    <p>Gooi 5 dobbelstenen. Je mag max 3 keer gooien.</p>

    <h3>Worpen: <?= $game->getThrowCount() ?> / 3</h3>

    <form method="post">

        <button type="submit" name="throw"
            <?= $game->isFinished() ? 'disabled' : '' ?>>
            Gooien
        </button>

        <button type="submit" name="reset">
            Nieuw game
        </button>

    </form>

    <?php foreach ($history as $index => $values): ?>

        <div class="round">

            <h3>Worp <?= $index + 1 ?></h3>

            <div class="dice">

                <?php
                $counts = array_count_values($values);

                foreach ($values as $value) {
                    // extra functie dat gelijke dobbelstenen groen worden
                    $color = $counts[$value] > 1 ? '#a8d5a2' : '#ffffff';

                    echo $game->getDiceSvg($value, $color);
                }
                ?>

            </div>

            <p>Totaal: <?= array_sum($values) ?></p>

        </div>

    <?php endforeach; ?>

    <?php if ($game->isFinished()): ?>

        <p class="message">
            Game klaar! Je hebt 3 keer gethrowed.
        </p>

    <?php endif; ?>

    <p>
        <small>
            Extra functie: dobbelstenen met hetzelfde aantal ogen
            worden groen.
        </small>
    </p>

</div>

</body>
</html>