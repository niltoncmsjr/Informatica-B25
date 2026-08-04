<?php

include("conexao.php");

$codigo_sql = "SELECT * FROM clientes";
$consulta_clientes = $conexao->query($codigo_sql) or die($conexao->error);

$num_linhas = $consulta_clientes->num_rows;

include("menu.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Lista de Clientes</title>
</head>

<body>
    <div class="container-clientes">
        <div class="titulo-table">
            <h1>Lista de Clientes</h1>
            <p>Todos os Clientes cadastrados no sistema</p>
        </div>

        <div class="tabela">
            <table border="1" cellpadding="10">
                <thead>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Nascimento</th>
                    <th>Data Cadastro</th>
                    <th>Nivel</th>
                    <th>Ultima Alteração</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                    <?php if ($num_linhas == 0) { ?>
                        <tr>
                            <td colspan="7">Nenhum Cliente foi cadastrado!</td>
                        </tr>
                        <?php
                    } else {
                        while ($cliente = $consulta_clientes->fetch_assoc()) {
                            //alterando o formato de exibicao do telefone
                            if (!empty($cliente["telefone"])) {
                                $ddd = substr($cliente["telefone"], 0, 2);
                                $parte1 = substr($cliente["telefone"], 2, 5);
                                $parte2 = substr($cliente["telefone"], 7, 4);

                                $telefone = "($ddd) $parte1-$parte2";
                            }

                            // if(!empty($cliente["nascimento"])) {
                            //     $dividir = explode('-',$cliente['nascimento']);
                            //     $nascimento = implode('/', array_reverse( $dividir));
                            // }

                            //alterando formato da data de nascimento
                            if (!empty($cliente['nascimento'])) {
                                $nascimento = new DateTime($cliente['nascimento']);
                            }

                            //alterando o formato da data de cadastro
                            $data_cadastro = date("d/m/Y H:i", strtotime($cliente["data_cadastro"]));


                            //alterando o formato da data de alteracao
                            $ultima_alteracao = date("d/m/Y H:i", strtotime($cliente["ultima_alteracao"]));


                        ?>
                            <tr>
                                <td><?php echo $cliente['id']; ?></td>
                                <td><?php echo $cliente['nome']; ?></td>
                                <td><?php echo $cliente['email']; ?></td>
                                <td><?php echo $telefone; ?></td>
                                <td><?php echo $nascimento->format('d/m/Y'); ?></td>
                                <td><?php echo $data_cadastro; ?></td>
                                <td>
                                    <?php
                                    if ($cliente['nivel'] == "admin") {
                                        echo "Administrador";
                                    } else {
                                        echo "Usuário Comum";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $ultima_alteracao; ?></td>
                                <td>
                                    <div class="acoes">
                                        <button id="botao-editar"><a id="botao-editar"
                                                href="editar_cliente.php?id=<?php echo $cliente['id']; ?>">Editar</a></button>


                                        <!-- Formulário responsável por enviar o ID do cliente para exclusão -->
                                        <form action="deletar_cliente.php" method="POST"
                                            onsubmit="return confirm('Confirma a Exclusão do(a) <?php echo $cliente['nome']; ?>? ');">
                                            <!-- Exibe uma caixa de confirmação antes de enviar o formulário.
                                            Se o usuário clicar em "Cancelar", o envio é interrompido. -->


                                            <!-- Campo oculto que armazena o ID do cliente.
                                            Esse valor será enviado via POST para o arquivo deletar_cliente.php -->
                                            <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

                                            <!-- Botão que envia o formulário e inicia o processo de exclusão -->
                                            <button id="botao-deletar" type="submit">Deletar</button>

                                        </form>

                                    </div>

                                </td>
                            </tr>

                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>