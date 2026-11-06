<?php

class GameList
{
    private array $games = [];

    public function addGame(Game $game): void
    {
        $this->games[] = $game;
    }

    public function getGames(): array
    {
        return $this->games;
    }

    public function getCurrentGame(): Game
    {
        return $this->games[count($this->games) - 1];
    }
}