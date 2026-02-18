

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>

<body>

    <?php
    if (isset($_SESSION['pseudo'])):
        ?>
        <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['pseudo']); ?> !</h1>

        <form action="./process/logout.php" method="post">
            <button type="submit">Se déconnecter</button>
        </form>
    <?php endif; ?>

</body>

</html>