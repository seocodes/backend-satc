<?php
$primeiro = $_POST['primeiro_nome'];
$sobrenome1 = $_POST['sobrenome1'];
$sobrenome2 = $_POST['sobrenome2'];
$nomeCompleto = $primeiro." ".$sobrenome1." ".$sobrenome2;

echo $nomeCompleto;
?>