<?php

// login oop afmaken 9015493
require_once __DIR__ . '/User.php';

$user = new User();

$message = '';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    if ($user->registerUser($username, $password, $email, $role)) {
        $message = 'Registratie gelukt!';
    } else {
        $message = 'Registratie mislukt.';
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->loginUser($email, $password)) {
        $message = 'Login gelukt!';
    } else {
        $message = 'Login mislukt.';
    }
}

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

    <h2>Registreren</h2>

    <form method="post">

        <label>Gebruikersnaam:</label><br>
        <input type="text" name="username" required>

        <br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email" required>

        <br><br>

        <label>Wachtwoord:</label><br>
        <input type="password" name="password" required>

        <br><br>

        <label>Rol:</label><br>
        <input type="text" name="role" value="user" required>

        <br><br>

        <button type="submit" name="register">
            Registreren
        </button>

    </form>


    <hr>


    <h2>Inloggen</h2>

    <form method="post">

        <label>E-mail:</label><br>
        <input type="email" name="email" required>

        <br><br>

        <label>Wachtwoord:</label><br>
        <input type="password" name="password" required>

        <br><br>

        <button type="submit" name="login">
            Inloggen
        </button>

    </form>

<?php endif; ?>

</body>

</html>