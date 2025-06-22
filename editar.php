<?php
require_once 'config/conexao.php';

// Verificar se o ID foi passado pela URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Buscar os dados do cliente no banco
$stmt = $conexao->prepare("SELECT nome, telefone, endereco FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Cliente não encontrado!";
    exit;
}

$cliente = $resultado->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Editar Cliente</h1>
    <div class="form-container">
        <form action="update.php" method="POST">
            <!-- Campo oculto para enviar o ID do cliente -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($cliente['telefone']); ?>">

            <label for="endereco">Endereço:</label>
            <textarea name="endereco" id="endereco" rows="3"><?php echo htmlspecialchars($cliente['endereco']); ?></textarea>

            <button type="submit">Atualizar</button>
            <a href="index.php" class="btn-back">Voltar</a>
        </form>
    </div>
</div>

</body>
</html>