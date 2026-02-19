<?php
session_start();
require_once __DIR__ . '/includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>

    <?php
    if (isset($_SESSION['error'])) {
        echo '<div style="color: red; margin-bottom: 10px;">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo '<div style="color: green; margin-bottom: 10px;">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    ?>

    <form action="./process/register_process.php" method="post">

        <label for="name">Nom & Prénom</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" required>
        <br>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">S'inscrire</button>
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

        <p>Déja un compte ? </p>
        <a href="login.php">Se connecter</a>

    </form>

</body>

</html>