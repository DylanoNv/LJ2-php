<?php
namespace Hospital;

require_once __DIR__ . '/Person.php';

class Patient extends Person
{
    private float $payment;

    public function __construct(
        string $name,
        string $role,
        float $payment
    ) {
        parent::__construct($name, $role);
        $this->payment = $payment;
    }

    public function getPayment(): float
    {
        return $this->payment;
    }

    public function setPayment(float $payment): void
    {
        $this->payment = $payment;
    }

    public function determineRole(): string
    {
        return 'Patient';
    }
}