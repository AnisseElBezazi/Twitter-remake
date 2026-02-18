<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>

    <?php 
    if (isset($_SESSION['success'])) {
        echo '<div style="color: green;">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['pseudo'])): ?>
        <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['pseudo']); ?> !</h1>
    <?php endif; ?>


</body>
</html>