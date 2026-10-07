<?php

namespace Schooltrip;

class Teacher extends Person
{
    private float $salary;

    public function __construct(string $name, float $salary = 0)
    {
        parent::__construct($name);
        $this->setSalary($salary);
    }

    protected function setRole(): void
    {
        $this->setRoleName('Teacher');
    }

    public function setSalary(float $salary): void
    {
        $this->salary = $salary;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }
}