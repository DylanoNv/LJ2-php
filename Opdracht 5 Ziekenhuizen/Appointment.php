<?php
namespace Hospital;

require_once __DIR__ . '/Patient.php';
require_once __DIR__ . '/Doctor.php';
require_once __DIR__ . '/Nurse.php';

class Appointment
{
    private Patient $patient;
    private Doctor $doctor;
    private array $nurses = [];
    private \DateTime $beginTime;
    private \DateTime $endTime;

    private static array $appointments = [];

    public function __construct(
        Patient $patient,
        Doctor $doctor,
        string $beginTime,
        string $endTime
    ) {
        $this->patient = $patient;
        $this->doctor = $doctor;
        $this->beginTime = new \DateTime($beginTime);
        $this->endTime = new \DateTime($endTime);

        self::$appointments[] = $this;
    }

    public function addNurse(Nurse $nurse): void
    {
        $this->nurses[] = $nurse;
    }

    public function getPatient(): Patient
    {
        return $this->patient;
    }

    public function getDoctor(): Doctor
    {
        return $this->doctor;
    }

    public function getNurses(): array
    {
        return $this->nurses;
    }

    public function getBeginTime(): string
    {
        return $this->beginTime->format('d-m-Y H:i');
    }

    public function getEndTime(): string
    {
        return $this->endTime->format('d-m-Y H:i');
    }

    public function getDuration(): float
    {
        $seconds = $this->endTime->getTimestamp()
            - $this->beginTime->getTimestamp();

        return $seconds / 3600;
    }

    public function getCosts(): float
    {
        $hours = $this->getDuration();

        $costs = $this->patient->getPayment();

        $costs += $hours * $this->doctor->getHourlyRate();

        foreach ($this->nurses as $nurse) {
            $costs += $hours * $nurse->getHourlyRate();
        }

        return $costs;
    }

    public static function getAppointments(): array
    {
        return self::$appointments;
    }
}