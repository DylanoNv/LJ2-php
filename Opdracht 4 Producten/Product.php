<?php
namespace Webshop;

abstract class Product
{
    private string $name;
    private float $purchasePrice;
    private int $tax;
    private string $description;
    private float $profit;
    protected string $category;

    public function __construct(
        string $name,
        float $purchasePrice,
        int $tax,
        float $profit,
        string $description
    ) {
        $this->name = $name;
        $this->purchasePrice = $purchasePrice;
        $this->tax = $tax;
        $this->profit = $profit;
        $this->description = $description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSalesPrice(): float
    {
        return ($this->purchasePrice + $this->profit)
            * (1 + $this->tax / 100);
    }

    public function setProfit(float $profit): void
    {
        $this->profit = $profit;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    abstract public function getInfo(): array;

    abstract public function setCategory(): void;
}