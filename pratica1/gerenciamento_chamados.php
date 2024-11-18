<?php
include 'db.php';

$status = $_GET['status'] ?? '';
$criticidade = $_GET['criticidade'] ?? '';
$colaborador = $_GET['colaborador'] ?? '';

// busca chamados
$sql = "SELECT * FROM Chamados WHERE 1=1";
$params = [];
$types = "";

if ($status) {
    $sql .= " AND Status = ?";
    $params[] = $status;
    $types .= "s";
}

if ($criticidade) {
    $sql .= " AND Criticidade = ?";
    $params[] = $criticidade;
    $types .= "s";
}

if ($colaborador) {
    $sql .= " AND ID_Colaborador = ?";
    $params[] = $colaborador;
    $types .= "i";
}


$stmt = $conn->prepare($sql);

if ($params) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
$chamados = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Chamados</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Gerenciamento de Chamados</h2>

    <form method="GET" action="gerenciamento_chamados.php">
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="">Todos</option>
            <option value="aberto" <?php if ($status == 'aberto') echo 'selected'; ?>>Aberto</option>
            <option value="em andamento" <?php if ($status == 'em andamento') echo 'selected'; ?>>Em Andamento</option>
            <option value="resolvido" <?php if ($status == 'resolvido') echo 'selected'; ?>>Resolvido</option>
        </select>

        <label for="criticidade">Criticidade:</label>
        <select name="criticidade" id="criticidade">
            <option value="">Todas</option>
            <option value="baixa" <?php if ($criticidade == 'baixa') echo 'selected'; ?>>Baixa</option>
            <option value="média" <?php if ($criticidade == 'média') echo 'selected'; ?>>Média</option>
            <option value="alta" <?php if ($criticidade == 'alta') echo 'selected'; ?>>Alta</option>
        </select>

        <button type="submit">Filtrar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Descrição</th>
                <th>Criticidade</th>
                <th>Status</th>
                <th>Colaborador</th>
                <th>Data de Abertura</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($chamados as $chamado): ?>
                <tr>
                    <td><?php echo $chamado['ID']; ?></td>
                    <td><?php echo $chamado['ID_Cliente']; ?></td>
                    <td><?php echo $chamado['Descricao']; ?></td>
                    <td><?php echo $chamado['Criticidade']; ?></td>
                    <td><?php echo $chamado['Status']; ?></td>
                    <td><?php echo $chamado['ID_Colaborador']; ?></td>
                    <td><?php echo $chamado['Data_Abertura']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
