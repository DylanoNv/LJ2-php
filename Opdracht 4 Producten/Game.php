<?php
namespace Webshop;

class Game extends Product
{
    private string $genre;
    private array $requirements = [];

    public function __construct(
        string $name,
        float $purchasePrice,
        int $tax,
        float $profit,
        string $description,
        string $genre
    ) {
        parent::__construct(
            $name,
            $purchasePrice,
            $tax,
            $profit,
            $description
        );

        $this->setGenre($genre);
        $this->setCategory();
    }

    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    public function addRequirements(string $requirement): void
    {
        $this->requirements[] = $requirement;
    }

    public function getInfo(): array
    {
        return [
            'Genre: ' . $this->genre,
            $this->getDescription(),
            ...$this->requirements
        ];
    }

    public function setCategory(): void
    {
        $this->category = 'Game';
    }
}