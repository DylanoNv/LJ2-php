<?php

// Login OOP bonusopdracht 9015493
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/classes/User.php';

$user = new User();

$message = '';

if (isset($_POST['logout'])) {
    $user->logout();

    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Login OOP</title>
</head>

<body>

<h1>Login OOP</h1>

<?php if ($message !== ''): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<?php if ($user->isLoggedin()): ?>

    <h2>Je bent ingelogd</h2>

    <p>
        Welkom <?= htmlspecialchars($_SESSION['username']) ?>
    </p>

    <p>
        Rol: <?= htmlspecialchars($_SESSION['role']) ?>
    </p>

    <form method="post">
        <button type="submit" name="logout">
            Uitloggen
        </button>
    </form>

<?php else: ?>

    <h2>Je bent niet ingelogd</h2>

    <p>
        <a href="login_form.php">Inloggen</a>
    </p>

    <p>
        <a href="register_form.php">Registreren</a>
    </p>

<?php endif; ?>

</body>

</html>