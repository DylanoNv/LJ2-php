<?php
include ("./src/Cube.php");
include ("./src/CubeList.php");
include ("./src/Game.php");
include ("./src/GameList.php");
include ("./src/Hint.php");
include ("./src/HintList.php");
include ("./src/Turn.php");
include ("./src/TurnList.php");
include ("./src/Play.php");

session_start();

// start new Game
if(isset($_SESSION['play'])){
    $play = $_SESSION['play'];
}

// clear everything like scores etc
// Dylano Nietveld 9015493 Project5
if(isset($_POST['newGame']))
{
    $play = new Play();
    $play->reset();
    $_SESSION['play'] = $play;
    $_SESSION['totalWrong'] = 0;
}

$message = '';
$hint = '';

if(isset($play))
{
    if(isset($_POST['newPlay']))
    {
        if(!empty($_POST['name'])){
            $play->setPlayerName($_POST['name']);
        }
    }

    if(isset($_POST['cubes']))
    {
        $amount = filter_var($_POST['cubes'], FILTER_VALIDATE_INT);

        if($amount !== false && $amount >= 3 && $amount <= 8)
        {
            // aanmaken nieuwe game
            $game = new Game($amount);
            // registeren voor deze speler
            $play->addGame($game);
        }else{
            $message = 'Kies tussen de 3 en 8 dobbelstenen.';
        }
    }

    if(isset($_POST['guess']) && isset($_SESSION['status']) && $_SESSION['status'] == 'start')
    {
        $iceHoles = filter_var($_POST['iceholes'] ?? null, FILTER_VALIDATE_INT);
        $polarBears = filter_var($_POST['polarbears'] ?? null, FILTER_VALIDATE_INT);
        $penguins = filter_var($_POST['penguins'] ?? null, FILTER_VALIDATE_INT);

        if($iceHoles !== false && $polarBears !== false && $penguins !== false &&
           $iceHoles >= 0 && $polarBears >= 0 && $penguins >= 0)
        {
            $play->addGuess($iceHoles, $polarBears, $penguins);
            $message = $play->checkScore();

            if($message == 'helaas fout')
            {
                $_SESSION['totalWrong']++;

                if($_SESSION['totalWrong'] % 3 == 0)
                {
                    // 3x fout geraden, dus random hint laten zien.
                    $hint = $play->getHint();
                }
            }
        }else{
            $message = 'Vul bij alle drie de velden een geldig getal in.';
        }
    }

    if(isset($_POST['answer']) && isset($_SESSION['status']) && $_SESSION['status'] == 'start')
    {
        $play->getAnswer();
    }

    $_SESSION['play'] = $play;
}
?>
<!doctype html>
<html lang="nl" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Wakken, IJsberen en Pinguins</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Custom page CSS
        -------------------------------------------------- */
        /* Not required for template or sticky footer method. */

        main > .container {
            padding: 60px 15px 0;
        }

        .dice {
            display: flex;
            flex-wrap: wrap;
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">

<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Wakken, Ijsberen en Pinguins</a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <form action="" method="post">
                            <button type="submit" name="newGame" value="newGame" class="btn btn-primary">
                                Start new Game
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Begin page content -->
<main class="flex-shrink-0">
    <div class="container">
        <h1></h1>

        <div class="alert alert-secondary" role="alert">
            De bedoeling van Wakken, Ijsberen en Pinguins is: <br>
            Dat je er achter moet komen hoe het spel werkt.
            Dit doe je door middel van raden, goed nadenken en lezen van de hints als je het fout hebt geraden.
            Je kan tevens het antwoord krijgen van een game, maar dan is de game wel meteen voorbij en kan je de volgende game starten.
        </div>

        <!-- CONTENT -->

        <?php if(!isset($play)): ?>

            <form action="" method="post">
                <button type="submit" name="newGame" value="newGame" class="btn btn-primary">
                    Start new Game
                </button>
            </form>

        <?php else: ?>

            <?php
            if($message != '')
            {
                $type = $message == 'correct geraden' ? 'success' : 'danger';
                echo "<div class='alert alert-$type' role='alert'>".$message."</div>";
            }

            if($hint != '')
            {
                echo "<div class='alert alert-info' role='alert'>Hint: ".$hint."</div>";
            }
            ?>

            <?php if(isset($_POST['newGame'])): ?>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Naam Speler</label>
                        <input name="name" type="text" id="name" class="form-control" required>
                    </div>
                    <button type="submit" name="newPlay" value="newPlay" class="btn btn-primary">
                        Play
                    </button>
                </form>

            <?php endif; ?>

            <?php
            // Start new Play
            if(isset($_POST['newPlay']) ||
               (isset($_SESSION['status']) &&
               ($_SESSION['status'] == 'correct' ||
                $_SESSION['status'] == 'wrong' ||
                $_SESSION['status'] == 'answer')))
            {
            ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="cubes" class="form-label">Aantal dobbelstenen</label>
                        <input name="cubes" type="number" min="3" max="8" id="cubes" class="form-control" required>
                    </div>
                    <button type="submit" name="Submit" class="btn btn-primary">
                        Gooi Dobbelstenen
                    </button>
                </form>
            <?php
            }
            ?>

            <?php
            if(isset($_SESSION['status']) &&
               ($_SESSION['status'] == 'start' ||
                $_SESSION['status'] == 'wrong' ||
                $_SESSION['status'] == 'correct' ||
                $_SESSION['status'] == 'answer'))
            {
            ?>
                <div class="dice">
                    <?php $play->draw(); ?>
                </div>
            <?php
            }
            ?>

            <?php
            if(isset($_SESSION['status']) && $_SESSION['status'] == 'start')
            {
            ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="iceholes" class="form-label">Raad Wakken</label>
                        <input name="iceholes" type="number" min="0" id="iceholes" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="polarbears" class="form-label">Raad Ijsberen</label>
                        <input name="polarbears" type="number" min="0" id="polarbears" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="penguins" class="form-label">Raad Pinguins</label>
                        <input name="penguins" type="number" min="0" id="penguins" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <button type="submit" name="guess" value="guess" class="btn btn-primary">Raad</button>
                        <button type="submit" name="answer" value="answer" class="btn btn-primary" formnovalidate>
                            Geef oplossing
                        </button>
                    </div>
                </form>
            <?php
            }
            ?>

            <?php
            if(isset($_SESSION['status']) && $_SESSION['status'] == 'answer')
            {
                $answers = $play->getAnswer();
            ?>
                <h3>Antwoord</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Aantal Wakken</th>
                            <th scope="col">Aantal Ijsberen</th>
                            <th scope="col">Aantal Pinguins</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            foreach($answers as $answer)
                            {
                                echo "<td>$answer</td>";
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            <?php
            }
            ?>

            <h3>Huidige game</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Fout geraden</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php
                            if(isset($_SESSION['wrong']))
                            {
                                echo $_SESSION['wrong'];
                            }else{
                                echo 0;
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>

            <h3>Vorige games</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Aantal beurten</th>
                        <th scope="col">Fout geraden</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($play->getPreviousGames() as $game)
                    {
                    ?>
                        <tr>
                            <td>Game</td>
                            <td><?php echo $game->getGameTurns(); ?></td>
                            <td><?php echo $game->getWrongAnswers(); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="3">Score: <?php echo $play->getScore(); ?></td>
                    </tr>
                </tbody>
            </table>

            <h3>Statistieken</h3>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Aantal gespeelde games</th>
                        <td><?php echo $play->getAmountGames(); ?></td>
                    </tr>
                    <tr>
                        <th>Aantal raadpogingen</th>
                        <td><?php echo $play->getAmountTurns(); ?></td>
                    </tr>
                    <tr>
                        <th>Goed geraden</th>
                        <td><?php echo $play->getScore(); ?></td>
                    </tr>
                    <tr>
                        <th>Fout geraden totaal</th>
                        <td><?php echo $_SESSION['totalWrong'] ?? 0; ?></td>
                    </tr>
                </tbody>
            </table>

        <?php endif; ?>

        <!-- END CONTENT -->
    </div>
</main>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <span class="text-muted">Wakken, Ijsberen en Pinguins</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>