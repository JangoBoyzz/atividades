<?php
$host = 'localhost';
$user = 'root';
$password = 'root';
$database = 'sistema_chamados';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}
