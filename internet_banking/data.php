<?php
// Obtém o ID do usuário da query string
$usuarioId = $_GET['id'];

// Realize a conexão com o banco de dados e execute a consulta para obter os dados do usuário
// Substitua as informações de conexão com o banco de dados pelas suas próprias configurações
require_once("../banco.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta para obter os dados do usuário
$query = "SELECT id, saldo FROM contas WHERE id = $usuarioId";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Usuário encontrado
    $usuario = $result->fetch_assoc();

    // Consulta para obter as transações do usuário
    $transacoesQuery = "SELECT descricao, valor, chave_pix FROM transacoes WHERE usuario_origem = $usuarioId";
    $transacoesResult = $conn->query($transacoesQuery);

    $transacoes = array();
    while ($row = $transacoesResult->fetch_assoc()) {
        $transacoes[] = $row;
    }

    // Monta o objeto JSON com os dados do usuário e suas transações
    $data = array(
        "id" => $usuario['id'],
        "saldo" => $usuario['saldo'],
        "transacoes" => $transacoes
    );

    // Define o cabeçalho da resposta como JSON
    header('Content-Type: application/json');

    // Retorna o objeto JSON
    echo json_encode($data);
} else {
    // Usuário não encontrado
    echo json_encode(array("error" => "Usuário não encontrado."));
}

$conn->close();
