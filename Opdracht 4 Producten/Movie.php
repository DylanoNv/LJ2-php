<?php
namespace Webshop;

class Movie extends Product
{
    private string $quality;

    public function __construct(
        string $name,
        float $purchasePrice,
        int $tax,
        float $profit,
        string $description,
        string $quality
    ) {
        parent::__construct(
            $name,
            $purchasePrice,
            $tax,
            $profit,
            $description
        );

        $this->setQuality($quality);
        $this->setCategory();
    }

    public function setQuality(string $quality): void
    {
        $this->quality = $quality;
    }

    public function getInfo(): array
    {
        return [
            'Kwaliteit: ' . $this->quality,
            $this->getDescription()
        ];
    }

    public function setCategory(): void
    {
        $this->category = 'Movie';
    }
}