<?php
require_once 'config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    // Validar se o ID não está vazio
    if (empty($id)) {
        header("Location: index.php?status=erro");
        exit;
    }

    // Usar prepared statements
    $stmt = $conexao->prepare("UPDATE clientes SET nome = ?, telefone = ?, endereco = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nome, $telefone, $endereco, $id);

    if ($stmt->execute()) {
        header("Location: index.php?status=atualizado");
    } else {
        echo "Erro ao atualizar: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
} else {
    header("Location: index.php");
}
?>