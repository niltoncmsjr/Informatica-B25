<?php

// Inclui o arquivo responsável pela conexão com o banco de dados
include("conexao.php");

if(!isset($_SESSION['nivel'])){
    header("Location: index.php");
    die();
}

if($_SESSION['nivel'] != "admin"){
    header("Location: clientes.php");
    die();
}

// Verifica se a página foi acessada através do método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Verifica se o ID foi enviado pelo formulário.
    // Caso exista, converte o valor para inteiro.
    // Caso contrário, atribui o valor 0.
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    // Verifica se o ID recebido é válido.
    // Se for menor ou igual a zero, interrompe a execução do script.
    if ($id <= 0) {
        echo "ID inválido";
        die();
    }
}

// Cria o comando SQL para excluir o cliente correspondente ao ID informado
$codigo_sql = "DELETE FROM clientes WHERE id = $id";

// Executa o comando SQL no banco de dados
if ($conexao->query($codigo_sql)) {

    // Caso a exclusão seja realizada com sucesso,
    // exibe uma mensagem e retorna para a lista de clientes.
    echo "
    <script>
        alert('Cliente excluído com sucesso');
        window.location.href='clientes.php';
    </script>";

} else {

    // Caso ocorra algum erro durante a exclusão,
    // exibe uma mensagem de erro e retorna para a lista de clientes.
    echo "
    <script>
        alert('Erro ao excluir o cliente');
        window.location.href='clientes.php';
    </script>";
}