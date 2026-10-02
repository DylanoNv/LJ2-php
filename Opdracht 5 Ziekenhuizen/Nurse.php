<?php
namespace Hospital;

require_once __DIR__ . '/Staff.php';

class Nurse extends Staff
{
    private float $fixedSalary;
    private float $hourlyRate;

    public function __construct(
        string $name,
        string $role,
        float $fixedSalary,
        float $hourlyRate
    ) {
        parent::__construct($name, $role, $fixedSalary);

        $this->fixedSalary = $fixedSalary;
        $this->hourlyRate = $hourlyRate;
    }

    public function getFixedSalary(): float
    {
        return $this->fixedSalary;
    }

    public function getHourlyRate(): float
    {
        return $this->hourlyRate;
    }

    public function setSalary(float $appointmentHours): void
    {
        $salary = $this->fixedSalary
            + ($appointmentHours * $this->hourlyRate);

        $this->updateSalary($salary);
    }

    public function determineRole(): string
    {
        return 'Nurse';
    }
}