<?php
include 'config/database.php';

$id = $_GET['id'] ?? null;

if ($id !== null) {
    $stmt = $pdo->prepare("DELETE FROM livros WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;