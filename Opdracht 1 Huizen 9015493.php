<?php

class Huis
{
    // Properties
    private int $aantalVerdiepingen;
    private int $aantalKamers;
    private float $breedte;
    private float $hoogte;
    private float $diepte;

    // Constructor
    public function __construct(
        int $aantalVerdiepingen,
        int $aantalKamers,
        float $breedte,
        float $hoogte,
        float $diepte
    ) {
        $this->aantalVerdiepingen = $aantalVerdiepingen;
        $this->aantalKamers = $aantalKamers;
        $this->breedte = $breedte;
        $this->hoogte = $hoogte;
        $this->diepte = $diepte;
    }

    // Volume berekenen
    public function berekenVolume(): float
    {
        return $this->breedte * $this->hoogte * $this->diepte;
    }

    // Prijs berekenen
    public function berekenPrijs(): float
    {
        return $this->berekenVolume() * 1500;
    }

    // Details weergeven
    public function toonDetails(): void
    {
        echo "Dit huis heeft " . $this->aantalVerdiepingen .
            " verdiepingen, " . $this->aantalKamers .
            " kamers en heeft een volume van " .
            $this->berekenVolume() . " m3.<br>";

        echo "De prijs van het huis is: €" .
            $this->berekenPrijs() . "<br><br>";
    }
}


// 3 verschillende huizen maken

$huis1 = new Huis(2, 4, 5, 4, 5);
$huis2 = new Huis(3, 6, 5, 5, 6);
$huis3 = new Huis(2, 3, 5, 3, 5);


// Details van de huizen tonen

$huis1->toonDetails();
$huis2->toonDetails();
$huis3->toonDetails();

?>