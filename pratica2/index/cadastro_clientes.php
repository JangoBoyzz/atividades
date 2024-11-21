<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if (!empty($nome) && !empty($cpf) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $query = "INSERT INTO clientes (nome, cpf, email, telefone) VALUES ('$nome', '$cpf', '$email', '$telefone')";
        if ($conn->query($query) === TRUE) {
            echo "<p>Cliente cadastrado com sucesso!</p>";
        } else {
            echo "<p>Erro ao cadastrar cliente: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>Por favor, preencha os campos corretamente!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/style.css">
    <title>Cadastro de Clientes</title>
</head>
<body>
    <h1>Cadastro de Clientes</h1>
    <form method="POST" action="cadastro_clientes.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required pattern="\d{11}" title="Digite um CPF válido (11 números).">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone">
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
