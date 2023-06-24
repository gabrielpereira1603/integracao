<?php
$serverName = "DELL_JC";  // Nome do servidor
$instanceName = "SQLEXPRESS";  // Nome da instância
$port = 1433;  // Porta do SQL Server
$database = "teste";  // Nome do banco de dados
$username = "gabi";  // Nome de usuário
$password = "123";  // Senha

$connectionOptions = array(
    "Database" => $database,
    "Uid" => $username,
    "PWD" => $password
);

// Concatena o nome do servidor com o nome da instância e a porta
$serverName .= "\\" . $instanceName . "," . $port;

$conexao = sqlsrv_connect($serverName, $connectionOptions);

if (!$conexao) {
    die(print_r(sqlsrv_errors(), true));
}
?>
