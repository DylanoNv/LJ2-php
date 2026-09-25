<?php
// Gemaakt door Dylano Nietveld 9015493

require_once __DIR__ . '/Figure.php';
require_once __DIR__ . '/Square.php';
require_once __DIR__ . '/Circle.php';
require_once __DIR__ . '/Rectangle.php';
require_once __DIR__ . '/Triangle.php';

use Shapes\Square;
use Shapes\Circle;
use Shapes\Rectangle;
use Shapes\Triangle;

// Kleuren
$colors = ['cyan', 'mediumslateblue', 'limegreen'];

// Figuren aanmaken
$figures = [];

foreach ($colors as $color) {
    $figures[] = new Square($color, 70);
    $figures[] = new Circle($color, 35);
    $figures[] = new Rectangle($color, 40, 70);
    $figures[] = new Triangle($color, 60, 70);
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Opdracht 3 - Drie op een rij</title>
</head>
<body>

<h1>Drie op een rij</h1>

<?php
for ($type = 0; $type < 4; $type++) {
    echo '<div style="display:flex; gap:5px;">';

    for ($color = 0; $color < 3; $color++) {
        $figure = $figures[$color * 4 + $type];

        echo '<svg width="85" height="85">';
        echo $figure->draw();
        echo '</svg>';
    }

    echo '</div>';
}
?>

</body>
</html>