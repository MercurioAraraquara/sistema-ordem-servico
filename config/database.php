<?php
$host = "localhost";
$banco = "sistema_os";
$usuario = "root";
$senha = ""; // Coloque a senha do seu MySQL se houver

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
