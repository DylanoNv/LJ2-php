<?php
namespace Webshop;

class Music extends Product
{
    private string $artist;
    private array $numbers = [];

    public function __construct(
        string $name,
        float $purchasePrice,
        int $tax,
        float $profit,
        string $description,
        string $artist
    ) {
        parent::__construct(
            $name,
            $purchasePrice,
            $tax,
            $profit,
            $description
        );

        $this->setArtist($artist);
        $this->setCategory();
    }

    public function setArtist(string $artist): void
    {
        $this->artist = $artist;
    }

    public function addNumber(string $number): void
    {
        $this->numbers[] = $number;
    }

    public function getInfo(): array
    {
        return [
            'Artiest: ' . $this->artist,
            $this->getDescription(),
            ...$this->numbers
        ];
    }

    public function setCategory(): void
    {
        $this->category = 'Music';
    }
}