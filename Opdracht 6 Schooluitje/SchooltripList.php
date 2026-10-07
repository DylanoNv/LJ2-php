<?php

namespace Schooltrip;

class SchooltripList
{
    private array $studentList = [];
    private ?Teacher $teacher = null;

    public function addStudentList(Student $student): void
    {
        $this->studentList[] = $student;
    }

    public function getStudentList(): array
    {
        return $this->studentList;
    }

    public function setTeacher(Teacher $teacher): void
    {
        $this->teacher = $teacher;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }
}