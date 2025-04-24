<!-- endpoint que processa a ação de adicionar itens ao carrinho la no database -->
<!-- API simples -->
<?php
    session_start();
    $conectar = mysql_connect('localhost','root','');
    $banco = mysql_select_db("loja");

    if (!isset($_SESSION['sessao_carrinho'])) {
        $_SESSION['sessao_carrinho'] = session_id();
    }

$sessao = $_SESSION['sessao_carrinho'];
//sla oq é curdate()
$query = "SELECT id FROM carrinho WHERE sessao = '$sessao' AND DATE(data_criacao) = CURDATE()";
$result = mysql_query($query);
if (!$result) {
    die('Erro na consulta SQL: ' . mysql_error());
};
$carrinho = mysql_fetch_assoc($result);

//criar carrinho se não existir
if (!$carrinho) {
    $query = "INSERT INTO carrinho (sessao) VALUES ('$sessao')";
    mysql_query($query);
    $id_carrinho = mysql_insert_id();
} else {
    $id_carrinho = $carrinho['id'];
}

//add/atualizar item no carirnho
$id_produto = mysql_real_escape_string($_POST['id_produto']);

//verificar se o produto já está no carrinho
$query = "SELECT * FROM carrinho_itens 
          WHERE id_carrinho = $id_carrinho AND id_produto = $id_produto";
$result = mysql_query($query);

if (mysql_num_rows($result) > 0) {
    //atualizar quantidade
    $query = "UPDATE carrinho_itens 
              SET quantidade = quantidade + 1 
              WHERE id_carrinho = $id_carrinho 
              AND id_produto = $id_produto";
} else {
    //inserir novo item
    $query = "INSERT INTO carrinho_itens (id_carrinho, id_produto) 
              VALUES ($id_carrinho, $id_produto)";
}

mysql_query($query);
header("Location: ".$_SERVER['HTTP_REFERER']);
exit;

?>