<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db("loja");

if (!$conectar || !$banco) {
    die("Erro ao conectar ao banco de dados: " . mysql_error());
}

if (isset($_POST['id_produto'])) {
    $id_produto = mysql_real_escape_string($_POST['id_produto']);

    $query = "SELECT id FROM carrinho_itens WHERE id_produto = '$id_produto'";
    $result = mysql_query($query);
    
    if (!$result) {
        die('Erro ao consultar o carrinho: ' . mysql_error());
    }

    if (mysql_num_rows($result) > 0) {
        $item = mysql_fetch_assoc($result);
        $item_id = $item['id'];
        $query = "UPDATE carrinho_itens SET quantidade = quantidade + 1 WHERE id = '$item_id'";
    } else {
        $query = "INSERT INTO carrinho_itens (id_produto, quantidade) VALUES ('$id_produto', 1)";
    }

    $result = mysql_query($query);

    if (!$result) {
        die('Erro ao adicionar item: ' . mysql_error());
    }
    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    die('Erro: Nenhum produto especificado');
}
?>
