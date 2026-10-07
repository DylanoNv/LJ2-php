<?php

namespace Schooltrip;

abstract class Person
{
    private string $name;
    private string $role;

    public function __construct(string $name)
    {
        $this->setName($name);
        $this->setRole();
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setRoleName(string $role): void
    {
        $this->role = $role;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    abstract protected function setRole(): void;
}