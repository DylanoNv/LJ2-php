<?php

require_once __DIR__ . '/Person.php';
require_once __DIR__ . '/Patient.php';
require_once __DIR__ . '/Staff.php';
require_once __DIR__ . '/Doctor.php';
require_once __DIR__ . '/Nurse.php';
require_once __DIR__ . '/Appointment.php';

use Hospital\Patient;
use Hospital\Doctor;
use Hospital\Nurse;
use Hospital\Appointment;


// PATIENTS

$patient1 = new Patient(
    'Jantje',
    'Patient',
    100
);

$patient2 = new Patient(
    'Piet',
    'Patient',
    100
);

$patient3 = new Patient(
    'Klaas',
    'Patient',
    100
);


// DOCTORS

$doctor1 = new Doctor(
    'Mohammed',
    'Doctor',
    75
);

$doctor2 = new Doctor(
    'Pieter',
    'Doctor',
    80
);


// NURSES

$nurse1 = new Nurse(
    'Jennifer',
    'Nurse',
    800,
    25
);

$nurse2 = new Nurse(
    'Kelly',
    'Nurse',
    800,
    25
);

$nurse3 = new Nurse(
    'Xenia',
    'Nurse',
    800,
    25
);


// APPOINTMENT 1

$appointment1 = new Appointment(
    $patient1,
    $doctor1,
    '2025-04-06 12:00',
    '2025-04-06 13:00'
);

$appointment1->addNurse($nurse1);
$appointment1->addNurse($nurse2);


// APPOINTMENT 2

$appointment2 = new Appointment(
    $patient2,
    $doctor2,
    '2025-04-07 14:00',
    '2025-04-07 16:00'
);

$appointment2->addNurse($nurse2);
$appointment2->addNurse($nurse3);


// APPOINTMENT 3

$appointment3 = new Appointment(
    $patient3,
    $doctor2,
    '2025-04-09 15:00',
    '2025-04-09 17:00'
);

$appointment3->addNurse($nurse3);


// SALARIES

$doctor1->setSalary(1);
$doctor2->setSalary(4);

$nurse1->setSalary(1);
$nurse2->setSalary(3);
$nurse3->setSalary(4);

?>

<!DOCTYPE html>
<html lang="nl">

<head>

    <meta charset="UTF-8">

    <title>Ziekenhuis</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eeeeee;
        }

    </style>

</head>

<body>

<h1>Afspraken ziekenhuis</h1>

<table>

    <tr>
        <th>Doctor</th>
        <th>Patient</th>
        <th>Nurses</th>
        <th>Begin</th>
        <th>End</th>
        <th>Price</th>
    </tr>

    <?php foreach (Appointment::getAppointments() as $appointment): ?>

        <tr>

            <td>
                <?= htmlspecialchars(
                    $appointment->getDoctor()->getName()
                ) ?>
            </td>

            <td>
                <?= htmlspecialchars(
                    $appointment->getPatient()->getName()
                ) ?>
            </td>

            <td>

                <?php

                $nurseNames = [];

                foreach ($appointment->getNurses() as $nurse) {
                    $nurseNames[] = $nurse->getName();
                }

                echo htmlspecialchars(
                    implode(', ', $nurseNames)
                );

                ?>

            </td>

            <td>
                <?= $appointment->getBeginTime() ?>
            </td>

            <td>
                <?= $appointment->getEndTime() ?>
            </td>

            <td>
                € <?= number_format(
                    $appointment->getCosts(),
                    2,
                    ',',
                    '.'
                ) ?>
            </td>

        </tr>

    <?php endforeach; ?>

</table>


<h2>Salarissen</h2>

<table>

    <tr>
        <th>Medewerker</th>
        <th>Rol</th>
        <th>Salaris</th>
    </tr>

    <?php

    $staffMembers = [
        $doctor1,
        $doctor2,
        $nurse1,
        $nurse2,
        $nurse3
    ];

    ?>

    <?php foreach ($staffMembers as $staff): ?>

        <tr>

            <td>
                <?= htmlspecialchars($staff->getName()) ?>
            </td>

            <td>
                <?= htmlspecialchars($staff->determineRole()) ?>
            </td>

            <td>
                € <?= number_format(
                    $staff->getSalary(),
                    2,
                    ',',
                    '.'
                ) ?>
            </td>

        </tr>

    <?php endforeach; ?>

</table>

</body>

</html>