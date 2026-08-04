<?php


 if(count($_GET) > 0){

    $nome = $_GET["nome"];
    $idade = $_GET["idade"];
    $email = $_GET["email"];

    echo "Eu sou o $nome, minha idade é $idade e esse é meu email: $email";
}

// if (isset($_GET["nome"])) {

//     $nome = $_GET["nome"];
//     $idade = $_GET["idade"];
//     $email = $_GET["email"];

//     echo "Eu sou o $nome, minha idade é $idade e esse é meu email: $email";

// }