<?php

require_once 'config/conexao.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];


    $stmt = $conexao->prepare("INSERT INTO clientes (nome, telefone, endereco) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $telefone, $endereco);

    if ($stmt->execute()) {

        header("Location: index.php?status=sucesso");
    } else {

        echo "Erro ao cadastrar: " . $stmt->error;

    }

    $stmt->close();
    $conexao->close();
} else {

    header("Location: index.php");
}
?>