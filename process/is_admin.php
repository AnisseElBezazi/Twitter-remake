<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['pseudo'])) {
    http_response_code(403);
    exit('Non autorisé.');
}

echo json_encode([
    'is_admin' => (isset($_SESSION['user_id']) && isset($_SESSION['pseudo'])) ? (
        ($pdo->query("SELECT role FROM users WHERE id = " . intval($_SESSION['user_id']))->fetchColumn() === 'admin')
    ) : false
]);
