<?php

namespace Schooltrip;

class Schooltrip
{
    private string $name;
    private array $schooltripLists = [];

    private static int $countStudent = 0;
    private static float $costList = 0;
    private static float $amount = 0;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addSchooltripList(SchooltripList $schooltripList): void
    {
        $this->schooltripLists[] = $schooltripList;
    }

    public function addStudent(Student $student): void
    {
        if ($student->getPaid()) {
            self::$countStudent++;
        }
    }

    public function getSchooltripLists(): array
    {
        return $this->schooltripLists;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function getCountStudent(): int
    {
        return self::$countStudent;
    }

    public static function setCostList(float $cost): void
    {
        self::$costList = $cost;
    }

    public static function getCostList(): float
    {
        return self::$costList;
    }

    public static function setAmount(float $amount): void
    {
        self::$amount = $amount;
    }

    public static function getAmount(): float
    {
        return self::$amount;
    }
}