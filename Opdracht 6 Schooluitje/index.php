<?php

require_once __DIR__ . '/Person.php';
require_once __DIR__ . '/Group.php';
require_once __DIR__ . '/Student.php';
require_once __DIR__ . '/Teacher.php';
require_once __DIR__ . '/SchooltripList.php';
require_once __DIR__ . '/Schooltrip.php';

use Schooltrip\Group;
use Schooltrip\Student;
use Schooltrip\Teacher;
use Schooltrip\SchooltripList;
use Schooltrip\Schooltrip;

$groupA = new Group('sod2a');
$groupB = new Group('sod2b');

$teacher1 = new Teacher('Koningstein');
$teacher2 = new Teacher('Brugge');
$teacher3 = new Teacher('Drimmelen');

$student1 = new Student('Piet', $groupA, false);
$student2 = new Student('Jan', $groupA, true);
$student3 = new Student('Kees', $groupB, true);

$student4 = new Student('Klaas', $groupB, true);
$student5 = new Student('Mohammed', $groupA, false);
$student6 = new Student('Eefje', $groupB, true);

$student7 = new Student('Martijn', $groupB, false);
$student8 = new Student('Pieter', $groupA, true);

$list1 = new SchooltripList();
$list1->setTeacher($teacher1);
$list1->addStudentList($student1);
$list1->addStudentList($student2);
$list1->addStudentList($student3);

$list2 = new SchooltripList();
$list2->setTeacher($teacher2);
$list2->addStudentList($student4);
$list2->addStudentList($student5);
$list2->addStudentList($student6);

$list3 = new SchooltripList();
$list3->setTeacher($teacher3);
$list3->addStudentList($student7);
$list3->addStudentList($student8);

$schooltrip = new Schooltrip('Pretpark');

$schooltrip->addSchooltripList($list1);
$schooltrip->addSchooltripList($list2);
$schooltrip->addSchooltripList($list3);

foreach ($schooltrip->getSchooltripLists() as $list) {
    foreach ($list->getStudentList() as $student) {
        $schooltrip->addStudent($student);
    }
}

Schooltrip::setCostList(50);
Schooltrip::setAmount(
    Schooltrip::getCountStudent() * Schooltrip::getCostList()
);

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Schooluitje</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px 15px;
            text-align: left;
        }

        th {
            background-color: #eeeeee;
        }
    </style>
</head>

<body>

<h1><?= htmlspecialchars($schooltrip->getName()) ?></h1>

<table>
    <tr>
        <th>Docent</th>
        <th>Student</th>
        <th>Klas</th>
        <th>Betaald</th>
    </tr>

    <?php foreach ($schooltrip->getSchooltripLists() as $list): ?>

        <tr>
            <td><?= htmlspecialchars($list->getTeacher()->getName()) ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

        <?php foreach ($list->getStudentList() as $student): ?>

            <tr>
                <td></td>
                <td><?= htmlspecialchars($student->getName()) ?></td>
                <td><?= htmlspecialchars($student->getClassName()->getName()) ?></td>
                <td><?= $student->getPaid() ? 'Ja' : 'Nee' ?></td>
            </tr>

        <?php endforeach; ?>

    <?php endforeach; ?>

</table>

<h2>Overzicht</h2>

<p>
    Aantal betalende studenten:
    <?= Schooltrip::getCountStudent() ?>
</p>

<p>
    Bedrag per student:
    € <?= number_format(Schooltrip::getCostList(), 2, ',', '.') ?>
</p>

<p>
    Totaal ingezameld:
    € <?= number_format(Schooltrip::getAmount(), 2, ',', '.') ?>
</p>

</body>
</html>