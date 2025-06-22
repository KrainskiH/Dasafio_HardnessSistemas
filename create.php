<?php
// Incluir o arquivo de conexão
require_once 'config/conexao.php';

// Verificar se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    // Usar prepared statements para evitar SQL injection
    $stmt = $conexao->prepare("INSERT INTO clientes (nome, telefone, endereco) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $telefone, $endereco);

    if ($stmt->execute()) {
        // Redirecionar para a página inicial com uma mensagem de sucesso (opcional)
        header("Location: index.php?status=sucesso");
    } else {
        // Redirecionar com uma mensagem de erro (opcional)
        echo "Erro ao cadastrar: " . $stmt->error;
        // header("Location: index.php?status=erro");
    }

    $stmt->close();
    $conexao->close();
} else {
    // Se não for um POST, redireciona para a página inicial
    header("Location: index.php");
}
?>