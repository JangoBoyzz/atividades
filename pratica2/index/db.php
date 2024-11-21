<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'sistema_solicitacoes';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}
