<?php

include('conexao.php');

$erro = false;

if (count($_POST) > 0) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $codigo_sql = "SELECT * FROM clientes WHERE email = '$email'";
    $consulta = $conexao->query($codigo_sql) or die($conexao->error);
    $resultado = $consulta->num_rows;

    if ($resultado == 0) {
        $erro = "E-mail não cadastrado!";
    } else {
        $usuario = $consulta->fetch_assoc();

        if (!password_verify($senha, $usuario['senha'])) {
            $erro = "Senha incorreta";
        } else {

            if (!isset($_SESSION)) {
                session_start();

                $_SESSION['usuario'] = $usuario['id'];
                $_SESSION['nivel'] = $usuario['nivel'];
                $_SESSION['email'] = $usuario['email'];
                header("Location: clientes.php");
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>

    <div class="container-login">
        <div class="div-login">
            <h1>T.i - B25</h1>
            <form action="" method="POST">
                <div class="campo-login">
                    <label for="">E-mail</label>
                    <input type="email" name="email" required>
                </div>
                <div class="campo-login">
                    <label for="">Senha</label>
                    <input type="text" name="senha" required>
                </div>
                <div class="campo-login">
                    <button type="submit">Entrar</button>
                </div>
                <div class="campo-login">
                    <?php if (!isset($erro)) $erro = false;
                    echo $erro; ?>
                </div>
            </form>
        </div>
    </div>
</body>

</html>