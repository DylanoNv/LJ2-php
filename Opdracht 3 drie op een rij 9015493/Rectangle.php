<?php
namespace Shapes;

class Rectangle extends Figure
{
    private int $height;
    private int $width;

    public function __construct(
        string $color,
        int $height,
        int $width
    ) {
        parent::__construct($color);

        $this->height = $height;
        $this->width = $width;
    }

    public function draw(): string
    {
        return '<rect width="' . $this->width .
               '" height="' . $this->height .
               '" fill="' . $this->getColor() .
               '" stroke="black" stroke-width="2" />';
    }
}