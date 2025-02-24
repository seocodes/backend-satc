<?php
$salario = $_POST['salario'];
$vendas = $_POST['vendas'];

$salarioFinal = $salario + ($vendas*0.05);

echo "Salário final = ".$salarioFinal;
?>