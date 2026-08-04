<?php


$local = "localhost";
$banco = "db_clientes";
$usuario = "root";
$senha = "";

$conexao = new mysqli($local, $usuario, $senha, $banco);
if ($conexao->connect_error) {
    die("Falha na conexao");
}