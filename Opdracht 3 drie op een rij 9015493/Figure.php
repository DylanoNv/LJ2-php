<?php

namespace Shapes;

abstract class Figure
{
    private string $color;

    public function __construct(string $color)
    {
        $this->color = $color;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    abstract public function draw(): string;
}