<?php
$host = "localhost";
$dbname = "catalogodelivros";
$charset = "utf8mb4";
$usuario = "root";
$senha = "";

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

try {
    $pdo = new PDO($dsn, $usuario, $senha, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "Bem vindo ao Catálogo de Livros!";
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}