<?php

require_once 'User.php';

$user = new User();
$conn = $user->dbConnect();

echo 'Database verbinding werkt';