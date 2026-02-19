<?php

session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $_SESSION['error'] = 'Token CSRF invalide. Veuillez réessayer.';
        header('Location: ../register.php');
        exit;
    }

    $name = trim ($_POST['name'] ??'');
    $pseudo = trim($_POST['pseudo'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';


    $errors = [];

    if (empty($name)) {
        $errors[] = "Les noms et prénoms sont obligatoires";
    }

    if (empty($pseudo)) {
        $errors[] = 'Le pseudo est requis';
    } elseif (strlen($pseudo) < 3) {
        $errors[] = 'Le pseudo doit faire au moins 3 caractères';
    }

    if (empty($email)) {
        $errors[] = "L'email est requis";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Merci de rentrer un e-mail valide";
    }

if (empty($password)) {
    $errors[] = "Le mot de passe est requis.";
} else {
    if (strlen($password) < 8) {
        $errors[] = "Le mot de passe doit faire au moins 8 caractères.";
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Il faut au moins une lettre majuscule.";
    } elseif (!preg_match('/[#?!@$%^&*-]/', $password)) {
        $errors[] = "Il faut au moins un caractère spécial.";
    }
}


    if (!empty($errors)) {
        $_SESSION['error'] = implode('<br>', $errors);
        header('Location: ../register.php');
        exit;
    }

    try {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email OR pseudo = :pseudo');
        $stmt->execute([
            ':email' => $email,
            ':pseudo' => $pseudo
        ]);

        if ($stmt->fetch()) {
            $_SESSION['error'] = "Le pseudo ou l'email est déja utilisé";
            header('Location: ../register.php');
            exit;
        }

        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        $insertStmt = $pdo->prepare("INSERT INTO users (pseudo, email, password, real_name) VALUES (:pseudo, :email, :password, :real_name)");
        $insertStmt->execute([
            ':pseudo' => $pseudo,
            ':email' => $email,
            ':password' => $passwordhash,
            ':real_name' => $name
        ]);

        $_SESSION['success'] = 'Inscription réussie';
        header('Location: ../index.php');
        exit;

    } catch (PDOException $e) {
        $_SESSION['error'] = 'Une erreur est survenue lors de l\'inscription';
        header('Location: ../register.php');
        exit;
    }

} else {
    header('Location: ../register.php');
    exit;
}
?>