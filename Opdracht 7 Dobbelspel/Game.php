<?php

require_once __DIR__ . '/Dice.php';

class Game
{
    private array $dice = [];
    private int $throwCount = 0;
    private array $history = [];

    public function __construct()
    {
        for ($i = 0; $i < 5; $i++) {
            $this->dice[] = new Dice();
        }
    }

    public function play(): void
    {
        if ($this->throwCount >= 3) {
            return;
        }

        $values = [];

        foreach ($this->dice as $die) {
            $die->throwDice();
            $values[] = $die->getFaceValue();
        }

        $this->throwCount++;
        $this->history[] = $values;
    }

    public function getThrowCount(): int
    {
        return $this->throwCount;
    }

    public function getHistory(): array
    {
        return $this->history;
    }

    public function isFinished(): bool
    {
        return $this->throwCount >= 3;
    }

    public function getDiceSvg(int $value, string $color = '#ffffff'): string
    {
        $positions = [
            1 => [[50, 50]],
            2 => [[30, 30], [70, 70]],
            3 => [[30, 30], [50, 50], [70, 70]],
            4 => [[30, 30], [70, 30], [30, 70], [70, 70]],
            5 => [[30, 30], [70, 30], [50, 50], [30, 70], [70, 70]],
            6 => [[30, 30], [50, 30], [70, 30], [30, 70], [50, 70], [70, 70]]
        ];

        $svg = '<svg width="65" height="65" viewBox="0 0 100 100"
                 xmlns="http://www.w3.org/2000/svg">';

        $svg .= '<rect x="2" y="2" width="96" height="96"
                 rx="12" fill="' . $color . '" stroke="#333" stroke-width="3"/>';

        foreach ($positions[$value] as $position) {
            $svg .= '<circle cx="' . $position[0] . '"
                     cy="' . $position[1] . '"
                     r="8" fill="#222"/>';
        }

        $svg .= '</svg>';

        return $svg;
    }
}