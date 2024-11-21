<?php
include 'db.php';

// Atualização de status e responsável
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_solicitacao = $_POST['id_solicitacao'];
    $status = $_POST['status'];
    $id_funcionario = $_POST['id_funcionario'];

    $query = "UPDATE solicitacoes SET status='$status', id_funcionario='$id_funcionario' WHERE id_solicitacao='$id_solicitacao'";
    if ($conn->query($query) !== TRUE) {
        echo "<p>Erro ao atualizar a solicitação: " . $conn->error . "</p>";
    }
}

// Filtros
$filtro_status = $_GET['status'] ?? '';
$filtro_urgencia = $_GET['urgencia'] ?? '';

$query = "SELECT * FROM solicitacoes WHERE 1=1";
if (!empty($filtro_status)) {
    $query .= " AND status='$filtro_status'";
}
if (!empty($filtro_urgencia)) {
    $query .= " AND urgencia='$filtro_urgencia'";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/style.css">
    <title>Gerenciar Solicitações</title>
</head>
<body>
    <h1>Gerenciar Solicitações</h1>

    <form method="GET" action="gerenciar_solicitacoes.php">
        <label for="status">Filtrar por Status:</label>
        <select id="status" name="status">
            <option value="">Todos</option>
            <option value="pendente" <?= $filtro_status === 'pendente' ? 'selected' : '' ?>>Pendente</option>
            <option value="em andamento" <?= $filtro_status === 'em andamento' ? 'selected' : '' ?>>Em Andamento</option>
            <option value="finalizada" <?= $filtro_status === 'finalizada' ? 'selected' : '' ?>>Finalizada</option>
        </select>

        <label for="urgencia">Filtrar por Urgência:</label>
        <select id="urgencia" name="urgencia">
            <option value="">Todas</option>
            <option value="baixa" <?= $filtro_urgencia === 'baixa' ? 'selected' : '' ?>>Baixa</option>
            <option value="média" <?= $filtro_urgencia === 'média' ? 'selected' : '' ?>>Média</option>
            <option value="alta" <?= $filtro_urgencia === 'alta' ? 'selected' : '' ?>>Alta</option>
        </select>

        <button type="submit">Filtrar</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Descrição</th>
            <th>Urgência</th>
            <th>Status</th>
            <th>Responsável</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['id_solicitacao'] ?></td>
                <td><?= $row['id_cliente'] ?></td>
                <td><?= $row['descricao'] ?></td>
                <td><?= $row['urgencia'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['id_funcionario'] ?? 'Não atribuído' ?></td>
                <td>
                    <form method="POST" action="gerenciar_solicitacoes.php">
                        <input type="hidden" name="id_solicitacao" value="<?= $row['id_solicitacao'] ?>">
                        <select name="status">
                            <option value="pendente" <?= $row['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                            <option value="em andamento" <?= $row['status'] === 'em andamento' ? 'selected' : '' ?>>Em Andamento</option>
                            <option value="finalizada" <?= $row['status'] === 'finalizada' ? 'selected' : '' ?>>Finalizada</option>
                        </select>
                        <select name="id_funcionario">
                            <option value="">Não atribuído</option>
                            <!-- Exemplo: Substitua pelos dados reais da tabela funcionários -->
                            <option value="1">Funcionário 1</option>
                            <option value="2">Funcionário 2</option>
                        </select>
                        <button type="submit">Atualizar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
