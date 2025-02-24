<?php
$preco = $_POST['preco'];

$precoFinal = $preco+($preco*0.25)+($preco*0.3);

echo "Preco final: ".$precoFinal;
?>