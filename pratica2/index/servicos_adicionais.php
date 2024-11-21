<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $descricao = "Serviço Adicional: " . $_POST['descricao'];
    $urgencia = $_POST['urgencia'];

    $query = "INSERT INTO solicitacoes (id_cliente, descricao, urgencia) VALUES ('$id_cliente', '$descricao', '$urgencia')";
    if ($conn->query($query) === TRUE) {
        echo "<p>Solicitação de serviço adicional registrada com sucesso!</p>";
    } else {
        echo "<p>Erro ao registrar solicitação: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/style.css">
    <title>Solicitação de Serviços Adicionais</title>
</head>
<body>
    <h1>Solicitação de Serviços Adicionais</h1>
    <form method="POST" action="servicos_adicionais.php">
        <label for="id_cliente">ID do Cliente:</label>
        <input type="text" id="id_cliente" name="id_cliente" required>

        <label for="descricao">Descrição do Serviço:</label>
        <textarea id="descricao" name="descricao" required></textarea>

        <label for="urgencia">Urgência:</label>
        <select id="urgencia" name="urgencia">
            <option value="baixa">Baixa</option>
            <option value="média">Média</option>
            <option value="alta">Alta</option>
        </select>

        <button type="submit">Enviar Solicitação</button>
    </form>
</body>
</html>
