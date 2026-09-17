<?php

class Kamer
{
    private float $lengte;
    private float $breedte;
    private float $hoogte;

    public function __construct(float $lengte, float $breedte, float $hoogte)
    {
        $this->lengte = $lengte;
        $this->breedte = $breedte;
        $this->hoogte = $hoogte;
    }

    public function getLengte(): float
    {
        return $this->lengte;
    }

    public function getBreedte(): float
    {
        return $this->breedte;
    }

    public function getHoogte(): float
    {
        return $this->hoogte;
    }

    public function getVolume(): float
    {
        return $this->lengte * $this->breedte * $this->hoogte;
    }
}


class Huis
{
    private array $kamers = [];

    public function addKamer(Kamer $kamer): void
    {
        $this->kamers[] = $kamer;
    }

    public function getKamers(): array
    {
        return $this->kamers;
    }

    public function getTotaalVolume(): float
    {
        $totaal = 0;

        foreach ($this->kamers as $kamer) {
            $totaal += $kamer->getVolume();
        }

        return $totaal;
    }

    public function getPrijs(): float
    {
        return $this->getTotaalVolume() * 3000;
    }
}


// Huis aanmaken
$huis = new Huis();


// Kamers aanmaken
$kamer1 = new Kamer(5.2, 5.1, 5.5);
$kamer2 = new Kamer(4.8, 4.6, 4.9);
$kamer3 = new Kamer(5.9, 2.5, 3.1);


// Kamers toevoegen aan het huis
$huis->addKamer($kamer1);
$huis->addKamer($kamer2);
$huis->addKamer($kamer3);


// Kamers weergeven
echo "<h3>Inhoud Kamers:</h3>";

echo "<ul>";

foreach ($huis->getKamers() as $kamer) {
    echo "<li>";
    echo "Lengte: " . $kamer->getLengte() . "m ";
    echo "Breedte: " . $kamer->getBreedte() . "m ";
    echo "Hoogte: " . $kamer->getHoogte() . "m";
    echo "</li>";
}

echo "</ul>";


// Totaal en prijs weergeven
echo "Volume Totaal = " . round($huis->getTotaalVolume()) . "m3<br>";
echo "Prijs van het huis is = " . round($huis->getPrijs()) . "Euro";

?>