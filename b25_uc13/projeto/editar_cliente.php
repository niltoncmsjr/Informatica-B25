<?php
include("conexao.php");
include("menu.php");

if(!isset($_SESSION['nivel'])){
    header("Location: index.php");
    die();
}

if($_SESSION['nivel'] != "admin"){
    header("Location: clientes.php");
    die();
}

$id = intval($_GET["id"]);

if (count($_POST) > 0) {

    $erro = false;
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $nascimento = $_POST["nascimento"];
    $senha = $_POST["senha"];
    $nivel = $_POST["nivel"];

    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
}


$codigo_sql = "SELECT * FROM clientes WHERE id = '$id'";
$consulta_clientes = $conexao->query($codigo_sql) or die($conexao->error);
$cliente = $consulta_clientes->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">


    <title>Editar Cliente</title>
</head>

<body>
    <div class="container">
        <form method="post" action="">
            <div class="div-cadastrar">
                <div class="campo-titulo">
                    <h2>Editar Informações</h2>
                </div>
                <div class="campo">
                    <label for="nome">Nome<span class="obrigatorio">*</span></label>
                    <input name="nome" type="text"
                        value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : $cliente['nome']; ?>" required>
                </div>

                <div class="campo">
                    <label for="telefone">Telefone</label>
                    <input name="telefone" type="text" id="tel" value="<?php echo isset($_POST['telefone']) ? $_POST['telefone'] : $cliente['telefone']; ?>">
                </div>

                <div class="campo">
                    <label for="email">E-mail<span class="obrigatorio">*</span></label>
                    <input name="email" type="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $cliente['email']; ?>" required>
                </div>

                <div class="campo">
                    <label for="nascimento">Data de Nascimento</label>
                    <input name="nascimento" type="date" value="<?php echo isset($_POST['nascimento']) ? $_POST['nascimento'] : $cliente['nascimento']; ?>">
                </div>
                <div class="campo">
                    <label for="senha">Senha<span class="obrigatorio">*</span></label>
                    <input name="senha" type="text">
                </div>
                <div class="campo">
                    <div class="div-nivel">
                        <label for="senha">Nivel de Acesso</label>
                        <div id="nivel">
                            <input name="nivel" value="admin" type="radio" <?php echo ($cliente['nivel']) == "admin" ? 'checked' : ''; ?>>Administrador
                            <input name="nivel" value="usuario" id="input-comum" type="radio" <?php echo ($cliente['nivel']) == "usuario" ? 'checked' : ''; ?>>Usuário Comum
                        </div>
                    </div>
                </div>
                <div class="campo-div">
                    <div class="campo-botao">
                        <button>Alterar</button>
                    </div>

                    <div class="campo-msg">
                        <?php

                        if (!isset($erro)) {
                            $erro = false;
                        } else if ($erro == true) {
                            echo $erro;
                        } else {

                            if (empty($senha)) {
                                $codigo_sql = "UPDATE clientes
                                SET nome = '$nome',
                                email = '$email',                                
                                telefone = '$telefone',
                                nascimento = '$nascimento',
                                nivel = '$nivel',
                                ultima_alteracao = NOW()
                                WHERE id = '$id'";

                            } else {                                
                                $codigo_sql = "UPDATE clientes
                                SET nome = '$nome',
                                email = '$email',
                                senha = '$senha_criptografada',
                                telefone = '$telefone',
                                nascimento = '$nascimento',
                                nivel = '$nivel',
                                ultima_alteracao = NOW()
                                WHERE id = '$id'";
                                
                            }

                            $deu_certo = $conexao->query($codigo_sql) or die($conexao->error);

                            if ($deu_certo) {
                                echo "Cliente atualizado com sucesso!";
                                unset($_POST);
                                header("refresh: 1; clientes.php");
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