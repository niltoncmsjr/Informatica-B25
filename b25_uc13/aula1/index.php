<?php


//variaveis
$nome = "Marquinho";
$altura = 1.60;
$peso = 70.2;

$lista = array("a", "b", "c");
$e_verdadeiro = false;
$numero_inteiro = 10;
define('nome_constante', 10);


$imc = $peso / ($altura * $altura);

echo "Nome: $nome <br>";
echo "Peso:  $peso <br>";
echo "Altura: $altura <br>";
echo "IMC: $imc <br> ";


if ($imc < 18.5) {
    echo "Classificação: Abaixo do Peso";
} else if (($imc >= 18.5) && ($imc <= 24.9)) {
    echo "Classificação: Peso normal";
} else if (($imc >= 25) && ($imc <= 29.9)) {
    echo "Classificação: Sobrepeso";
} else if (($imc >= 30) && ($imc <= 39.9)) {
    echo "Classificação: Obesidade";
} else {
    echo "Classificação: Obesidade Grave";
}






