<?php

session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = trim($_POST['pseudo'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';


    $errors = [];

    if (empty($pseudo)) {
        $errors[] = 'Le pseudo est requis';
    } elseif (strlen($pseudo) < 3) {
        $errors[] = 'Le pseudo doit faire au moins 3 caractères';
    }

    if (empty($email)) {
        $errors[] = "L'email est requis";
    }

    if (empty($password)) {
        $errors[] = "Le mot de passe est requis";
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

        $insertStmt = $pdo->prepare("INSERT INTO users (pseudo, email, password) VALUES (:pseudo, :email, :password)");
        $insertStmt->execute([
            ':pseudo' => $pseudo,
            ':email' => $email,
            ':password' => $passwordhash
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