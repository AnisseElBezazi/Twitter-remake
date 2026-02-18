<?php

session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';


    $errors = [];

    if (empty($email)) {
        $errors[] = "L'email est requis";
    }

    if (empty($password)) {
        $errors[] = "Le mot de passe est requis";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = implode('<br>', $errors);
        header('Location: ../login.php');
        exit;
    }

    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['pseudo'] = $user['pseudo'];
            $_SESSION['success'] = "Connexion réussie !"; 
            header('Location: ../index.php');
            exit;
        } else {
            $_SESSION['error'] = "Email ou mot de passe incorrect.";
            header('Location: ../login.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION["error"] = "Une erreur est survenue lors de la connexion.";
        header('Location: ../login.php');
        exit;
    }


} else {
    header('Location: ../login.php');
    exit;
}
?>