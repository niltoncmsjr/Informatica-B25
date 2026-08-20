<?php

include("menu.php");

if(!isset($_SESSION['nivel'])){
    header("Location: index.php");
    die();
}

if($_SESSION['nivel'] != "admin"){
    header("Location: clientes.php");
    die();
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">


    <title>Cadastro de Clientes</title>
</head>

<body>

    <div class="container">
        <form method="post" action="">
            <div class="div-cadastrar">
                <div class="campo-titulo">
                    <h2>Cadastro de Clientes</h2>
                </div>
                <div class="campo">
                    <label for="nome">Nome<span class="obrigatorio">*</span></label>
                    <input name="nome" type="text" required>
                </div>

                <div class="campo">
                    <label for="telefone">Telefone</label>
                    <input name="telefone" type="text" id="tel">
                </div>

                <div class="campo">
                    <label for="email">E-mail<span class="obrigatorio">*</span></label>
                    <input name="email" type="email" required>
                </div>

                <div class="campo">
                    <label for="nascimento">Data de Nascimento</label>
                    <input name="nascimento" type="date">
                </div>
                <div class="campo">
                    <label for="senha">Senha<span class="obrigatorio">*</span></label>
                    <input name="senha" type="text">
                </div>
                <div class="campo">
                    <div class="div-nivel">
                        <label for="senha">Nivel de Acesso</label>
                        <div id="nivel">
                            <input name="nivel" value="admin" type="radio">Administrador
                            <input name="nivel" value="usuario" id="input-comum" type="radio" checked>Usuário Comum
                        </div>
                    </div>
                </div>
                <div class="campo-div">
                    <div class="campo-botao">
                        <button>Cadastrar</button>
                    </div>

                    <div class="campo-msg">
                        <?php

                        $erro = false;

                        if (count($_POST) > 0) {
                            include("conexao.php");

                            $nome = $_POST["nome"];
                            $email = $_POST["email"];
                            $telefone = $_POST["telefone"];
                            $nascimento = $_POST["nascimento"];
                            $senha = $_POST["senha"];
                            $nivel = $_POST["nivel"];

                            //Verificando se o email ja existe no banco 
                            $sql_email = "SELECT email FROM clientes WHERE email = '$email'";
                            $query_email = $conexao->query($sql_email) or die($conexao->error);

                            //Contando o numero de linhas da consulta no banco
                            $num_email = $query_email->num_rows;

                            if ($num_email == 1) {
                                $erro = "E-mail ja cadastrado!";
                            }

                            $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);


                            if ($erro == true) {
                                echo $erro;
                                header("refresh: 2; cadastrar_cliente.php");
                            } else {
                                $codigo_sql = "INSERT INTO clientes (nome,email,senha,telefone,nascimento,nivel,data_cadastro)
                            VALUES ('$nome', '$email', '$senha_criptografada', '$telefone', '$nascimento', '$nivel',NOW())";
                                $deu_certo = $conexao->query($codigo_sql) or die($conexao->error);

                                if ($deu_certo) {
                                    echo "Cliente Cadastrado com Sucesso!";
                                    unset($_POST); //limpando o $POST
                                    //header("refresh: 2; clientes.php");
                                }
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>



</body>

</html>