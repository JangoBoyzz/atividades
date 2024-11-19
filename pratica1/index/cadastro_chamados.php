<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $descricao = $_POST['descricao'];
    $criticidade = $_POST['criticidade'];
    $id_colaborador = !empty($_POST['id_colaborador']) ? $_POST['id_colaborador'] : null;


    if ($id_cliente && $descricao && $criticidade) {
        $sql = "INSERT INTO Chamados (ID_Cliente, Descricao, Criticidade, ID_Colaborador) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($id_colaborador) {
            $stmt->bind_param("issi", $id_cliente, $descricao, $criticidade, $id_colaborador);
        } else {
            $stmt->bind_param("isss", $id_cliente, $descricao, $criticidade, $id_colaborador);
        }

        $stmt->bind_param("issi", $id_cliente, $descricao, $criticidade, $id_colaborador);
        if ($stmt->execute()) {
            echo "Chamado cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar chamado: " . $stmt->error;
        }
    } else {
        echo "Preencha todos os campos obrigatórios!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Chamados</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <h2>Cadastro de Chamados</h2>
    <form method="POST" action="cadastro_chamados.php">
        <label for="id_cliente">Cliente (ID):</label>
        <input type="number" name="id_cliente" id="id_cliente" required>

        <label for="descricao">Descrição do Problema:</label>
        <textarea name="descricao" id="descricao" required></textarea>

        <label for="criticidade">Criticidade:</label>
        <select name="criticidade" id="criticidade" required>
            <option value="baixa">Baixa</option>
            <option value="média">Média</option>
            <option value="alta">Alta</option>
        </select>

        <label for="id_colaborador">Colaborador Responsável (Opcional):</label>
        <select name="id_colaborador" id="id_colaborador">
            <option value="">Nenhum</option>
            <?php
            $result = $conn->query("SELECT ID, Nome FROM Colaboradores");
            while ($colaborador = $result->fetch_assoc()) {
                echo "<option value='{$colaborador['ID']}'>{$colaborador['Nome']} (ID: {$colaborador['ID']})</option>";
            }
            ?>
        </select>

        <button type="submit">Cadastrar Chamado</button>
    </form>

    <a href="gerenciamento_chamados.php">Gerenciamento de Chamados</a>
    <a href="cadastro_clientes.php">Inserir novo cliente.</a>
</body>

</html>