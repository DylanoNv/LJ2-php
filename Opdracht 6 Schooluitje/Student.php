<?php

namespace Schooltrip;

class Student extends Person
{
    private Group $className;
    private bool $paid;

    public function __construct(string $name, Group $className, bool $paid)
    {
        parent::__construct($name);

        $this->className = $className;
        $this->paid = $paid;
    }

    protected function setRole(): void
    {
        $this->setRoleName('Student');
    }

    public function getClassName(): Group
    {
        return $this->className;
    }

    public function getPaid(): bool
    {
        return $this->paid;
    }

    public function setPaid(bool $paid): void
    {
        $this->paid = $paid;
    }
}