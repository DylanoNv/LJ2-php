<?php
namespace Hospital;

require_once __DIR__ . '/Person.php';

abstract class Staff extends Person
{
    private float $salary;

    public function __construct(
        string $name,
        string $role,
        float $salary
    ) {
        parent::__construct($name, $role);
        $this->salary = $salary;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    protected function updateSalary(float $salary): void
    {
        $this->salary = $salary;
    }

    abstract public function setSalary(float $amount): void;
}