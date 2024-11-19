<?php
include 'db.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = "E-mail inválido.";
    } else {

        $sql = "INSERT INTO Clientes (Nome, Email, Telefone) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $telefone);

        if ($stmt->execute()) {
            $mensagem = "Cliente cadastrado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar cliente: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <h2>Cadastro de Clientes</h2>
    <form method="POST" action="cadastro_clientes.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone">
        <br>

        <button type="submit">Cadastrar</button>
    </form>
    <?php if ($mensagem): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>
    <a href="cadastro_chamados.php">Inserir novo chamado.</a>
    <a href="gerenciamento_chamados.php">Gerenciamento de Chamados</a>
</body>

</html>