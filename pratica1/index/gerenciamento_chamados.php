<?php
include 'db.php';

$status = $_GET['status'] ?? '';
$criticidade = $_GET['criticidade'] ?? '';
$colaborador = $_GET['colaborador'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $id_colaborador = $_POST['id_colaborador'] ?? null;

    $sql = "UPDATE Chamados SET Status = ?, ID_Colaborador = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $status, $id_colaborador, $id);
    if ($stmt->execute()) {
        echo "Chamado atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar chamado: " . $stmt->error;
    }
}

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
    <link rel="stylesheet" href="../style/style.css">
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
            <td>
                <form method="POST" action="gerenciamento_chamados.php">
                    <input type="hidden" name="id" value="<?php echo $chamado['ID']; ?>">
                    <select name="status">
                        <option value="aberto" <?php if ($chamado['Status'] == 'aberto') echo 'selected'; ?>>Aberto</option>
                        <option value="em andamento" <?php if ($chamado['Status'] == 'em andamento') echo 'selected'; ?>>Em Andamento</option>
                        <option value="resolvido" <?php if ($chamado['Status'] == 'resolvido') echo 'selected'; ?>>Resolvido</option>
                    </select>
                    <input type="number" name="id_colaborador" placeholder="ID Colaborador" value="<?php echo $chamado['ID_Colaborador']; ?>">
                    <button type="submit">Atualizar</button>
                </form>
            </td>

        </tbody>
    </table>
    <a href="cadastro_chamados.php">Inserir novo chamado.</a>
    <a href="cadastro_clientes.php">Inserir novo cliente.</a>
</body>

</html>