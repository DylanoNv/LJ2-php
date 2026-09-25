<?php
namespace Shapes;

class Circle extends Figure
{
    private int $length;

    public function __construct(string $color, int $length)
    {
        parent::__construct($color);
        $this->length = $length;
    }

    public function draw(): string
    {
        return '<circle cx="40" cy="40" r="' .
               $this->length .
               '" fill="' . $this->getColor() .
               '" stroke="black" stroke-width="3" />';
    }
}