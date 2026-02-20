<?php
session_start();
require_once __DIR__ . '/includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="connexion-body">


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
    <div class="container-form">
    <div class="logo">FlixThread</div>

    <form class="formulaire" action="./process/login_process.php" method="post">
        <h1 class="title">S'identifier</h1>
        
        <input class="input-formulaire" type="email" name="email" id="email" placeholder="Entrez votre email" required>
        <input class="input-formulaire" type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <button class="primary-button" type="submit">Se connecter</button>
        <div class="signup-link">
            <p>Nouveau sur FlixThread ?</p>
            <a href="register.php">Inscrivez-vous maintenant.</a>
        </div>
    </form>
</div>

</body>

</html>