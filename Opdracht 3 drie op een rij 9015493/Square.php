<?php
namespace Shapes;

class Square extends Figure
{
    private int $length;

    public function __construct(string $color, int $length)
    {
        parent::__construct($color);
        $this->length = $length;
    }

    public function draw(): string
    {
        return '<rect width="' . $this->length .
               '" height="' . $this->length .
               '" fill="' . $this->getColor() .
               '" stroke="black" stroke-width="3" />';
    }
}