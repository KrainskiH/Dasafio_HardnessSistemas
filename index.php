<?php
// Incluir o arquivo de conexão
require_once 'config/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Cadastro de Clientes</h1>

    <!-- Formulário de Cadastro -->
    <div class="form-container">
        <h2>Adicionar Novo Cliente</h2>
        <form action="create.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone">

            <label for="endereco">Endereço:</label>
            <textarea name="endereco" id="endereco" rows="3"></textarea>

            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <!-- Tabela de Clientes -->
    <div class="table-container">
        <h2>Clientes Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query para selecionar todos os clientes
                $sql = "SELECT id, nome, telefone, endereco FROM clientes ORDER BY nome";
                $resultado = $conexao->query($sql);

                if ($resultado->num_rows > 0) {
                    // Loop através dos resultados e exibi-los na tabela
                    while ($cliente = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($cliente['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['telefone']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['endereco']) . "</td>";
                        echo "<td class='actions'>";
                        echo "<a href='editar.php?id=" . $cliente['id'] . "' class='btn-edit'>Editar</a> ";
                        echo "<a href='delete.php?id=" . $cliente['id'] . "' class='btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir este cliente?\")'>Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum cliente cadastrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Fechar a conexão
$conexao->close();
?>

</body>
</html>