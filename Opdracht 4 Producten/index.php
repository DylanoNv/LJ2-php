
<?php
// Gemaakt door Dylano Nietveld 9015493

require_once __DIR__ . '/Product.php';
require_once __DIR__ . '/Music.php';
require_once __DIR__ . '/Movie.php';
require_once __DIR__ . '/Game.php';
require_once __DIR__ . '/ProductList.php';

use Webshop\Music;
use Webshop\Movie;
use Webshop\Game;
use Webshop\ProductList;

// Productlijst aanmaken
$productList = new ProductList();

// Muziek
$music1 = new Music(
    'White Pony', 10.00, 21, 3.00,
    'Muziekalbum', 'Deftones'
);

$music1->addNumber('Digital Bath');
$music1->addNumber('Change');

$music2 = new Music(
    'Souvlaki', 12.00, 21, 3.00,
    'Muziekalbum', 'Slowdive'
);

$music2->addNumber('Alison');
$music2->addNumber('When the Sun Hits');

// Films
$movie1 = new Movie(
    'Interstellar', 10.00, 21, 3.00,
    'Sciencefictionfilm', 'Blu-ray'
);

$movie2 = new Movie(
    'Fight Club', 8.00, 21, 2.00,
    'Thriller', 'DVD'
);

// Games
$game1 = new Game(
    'Minecraft', 15.00, 21, 5.00,
    'Minimale hardware-eisen',
    'Survival'
);

$game1->addRequirements('8 GB RAM');
$game1->addRequirements('Intel Core i5');

$game2 = new Game(
    'Red Dead Redemption 2', 25.00, 21, 5.00,
    'Minimale hardware-eisen',
    'Action Adventure'
);

$game2->addRequirements('12 GB RAM');
$game2->addRequirements('GTX 1060');

// Producten toevoegen
$productList->addProduct($music1);
$productList->addProduct($music2);
$productList->addProduct($movie1);
$productList->addProduct($movie2);
$productList->addProduct($game1);
$productList->addProduct($game2);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Opdracht 4 - Producten</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #eeeeee;
        }
    </style>
</head>

<body>

<h1>Producten</h1>

<table>
    <tr>
        <th>Categorie</th>
        <th>Naam product</th>
        <th>Verkoopprijs</th>
        <th>Info</th>
    </tr>

    <?php foreach ($productList->getProducts() as $product): ?>
        <tr>
            <td>
                <?= htmlspecialchars($product->getCategory()) ?>
            </td>

            <td>
                <?= htmlspecialchars($product->getName()) ?>
            </td>

            <td>
                &euro; <?= number_format(
                    $product->getSalesPrice(), 2, ',', '.'
                ) ?>
            </td>

            <td>
                <ul>
                    <?php foreach ($product->getInfo() as $info): ?>
                        <li><?= htmlspecialchars($info) ?></li>
                    <?php endforeach; ?>
                </ul>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
