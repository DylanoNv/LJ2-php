<?php
namespace Shapes;

class Triangle extends Figure
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
        $middle = $this->width / 2;

        return '<polygon points="' .
               $middle . ',0 ' .
               '0,' . $this->height . ' ' .
               $this->width . ',' . $this->height .
               '" fill="' . $this->getColor() .
               '" stroke="black" stroke-width="2" />';
    }
}