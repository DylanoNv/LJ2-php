<?php
namespace Hospital;

require_once __DIR__ . '/Staff.php';

class Doctor extends Staff
{
    private float $hourlyRate;

    public function __construct(
        string $name,
        string $role,
        float $hourlyRate
    ) {
        parent::__construct($name, $role, 0);
        $this->hourlyRate = $hourlyRate;
    }

    public function getHourlyRate(): float
    {
        return $this->hourlyRate;
    }

    public function setHourlyRate(float $hourlyRate): void
    {
        $this->hourlyRate = $hourlyRate;
    }

    public function setSalary(float $hours): void
    {
        $this->updateSalary($hours * $this->hourlyRate);
    }

    public function determineRole(): string
    {
        return 'Doctor';
    }
}