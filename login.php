<?php
session_start();
require_once __DIR__ . '/includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection</title>
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

    <form action="./process/login_process.php" method="post">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Se connecter</button>
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

        <p>Pas encore de compte ? </p>
        <a href="register.php">S'inscrire</a>

    </form>

</body>

</html>