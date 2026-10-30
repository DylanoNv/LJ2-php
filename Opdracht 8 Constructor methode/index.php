<?php
// Dylano Nietveld 9015943

// Opdracht 1 - Constructor
class Auto {
    private $merk;
    private $bouwjaar;

    public function __construct($merk, $bouwjaar) {
        $this->merk = $merk;
        $this->bouwjaar = $bouwjaar;
    }

    public function toonAuto() {
        echo "Merk: $this->merk<br>";
        echo "Bouwjaar: $this->bouwjaar<br>";
    }
}

// Opdracht 2 - Overriden methods
class Vervoermiddel {
    public function geluid() {
        return "Onbekend geluid";
    }
}

class Fiets extends Vervoermiddel {
    public function geluid() {
        return "Ring ring";
    }
}

class Trein extends Vervoermiddel {
    public function geluid() {
        return "Tuut tuut";
    }
}

class Vliegtuig extends Vervoermiddel {
    public function geluid() {
        return "Whoosh";
    }
}

// Opdracht 4 - Static members
class Converter {
    public static function kmNaarMiles($km) {
        return $km * 0.621371;
    }
}
?>

<h1>Opdracht 8 - OOP</h1>

<h2>1. Constructor</h2>
<?php
$auto = new Auto("Nissan", 2011);
$auto->toonAuto();
?>

<h2>2. Overriden methods</h2>
<?php
echo (new Fiets())->geluid() . "<br>";
echo (new Trein())->geluid() . "<br>";
echo (new Vliegtuig())->geluid() . "<br>";
?>

<h2>3. Polymorfisme</h2>
<?php
$vervoermiddelen = [new Fiets(), new Trein(), new Vliegtuig()];

foreach ($vervoermiddelen as $vervoermiddel) {
    echo $vervoermiddel->geluid() . "<br>";
}
?>

<h2>4. Static members</h2>
<?php
echo "10 kilometer = " . Converter::kmNaarMiles(10) . " miles";
?>