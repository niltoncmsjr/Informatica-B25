<?php


function primeira_funcao()
{
    echo "UC13 - PHP";
}

function funcao_soma($numero1, $numero2)
{
    $soma = $numero1 + $numero2;

    echo "$numero1 + $numero2 = " . $soma;

}

function funcao_media($numero1, $numero2, $numero3)
{
    $soma = $numero1 + $numero2 + $numero3;
    $média = $soma / 3;

    echo "<hr>";

    echo "Soma dos numeros $numero1 + $numero2 + $numero3 = " . $soma;
    echo " <br> Média é $média";
}



function funcao_parImpar($numero)
{
    if ($numero % 2 == 0) {
        echo "$numero é PAR";
    } else {
        echo "$numero é IMPAR";
    }


}

