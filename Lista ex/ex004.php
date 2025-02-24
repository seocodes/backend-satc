<?php
$nome = $_POST['nome'];
$n1 = $_POST['nota1'];
$n2 = $_POST['nota2'];
$n3 = $_POST['nota3'];

$media = ($n1 + $n2 + $n3)/3;

echo $nome." sua media: ".$media;
?>