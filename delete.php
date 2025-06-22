<?php
require_once 'config/conexao.php';

// Verificar se o ID foi passado pela URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Usar prepared statements
$stmt = $conexao->prepare("DELETE FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?status=excluido");
} else {
    echo "Erro ao excluir: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>