<?php

class TurnList
{
    private array $turns = [];

    public function addTurn(Turn $turn): void
    {
        $this->turns[] = $turn;
    }

    public function getCurrentTurn(): Turn
    {
        return $this->turns[count($this->turns) - 1];
    }

    public function getAmountTurns(): int
    {
        return count($this->turns);
    }
}