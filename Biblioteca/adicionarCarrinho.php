<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conectar = mysqli_connect('localhost', 'root', '', 'livraria');
if (!$conectar) {
    die("Erro na conexão: " . mysqli_connect_error());
}

mysqli_set_charset($conectar, "utf8");

if (isset($_POST['id_livro'])) {
    $id_livro = mysqli_real_escape_string($conectar, $_POST['id_livro']);
    
    error_log("ID do livro recebido: " . $id_livro);
    
    $sql_livro = "SELECT l.codigo, l.titulo, l.preco, l.fotocapa1
                  FROM livro l
                  WHERE l.codigo = '$id_livro'";
    
    $resultado_livro = mysqli_query($conectar, $sql_livro);
    
    if (!$resultado_livro) {
        error_log("Erro na consulta do livro: " . mysqli_error($conectar));
        die('Erro na consulta do livro: ' . mysqli_error($conectar));
    }
    
    if (mysqli_num_rows($resultado_livro) == 0) {
        error_log("Livro não encontrado com código: " . $id_livro);
        die('Erro: Livro não encontrado');
    }
    
    $livro = mysqli_fetch_assoc($resultado_livro);
    
    error_log("Dados do livro: " . print_r($livro, true));
    
    $sql_verificar = "SELECT id, quantidade FROM carrinho WHERE codigo = '$id_livro'";
    $resultado_verificar = mysqli_query($conectar, $sql_verificar);
    
    if (!$resultado_verificar) {
        error_log("Erro na verificação do carrinho: " . mysqli_error($conectar));
        die('Erro na verificação do carrinho: ' . mysqli_error($conectar));
    }
    
    if (mysqli_num_rows($resultado_verificar) > 0) {
        $item_existente = mysqli_fetch_assoc($resultado_verificar);
        $nova_quantidade = $item_existente['quantidade'] + 1;
        
        $sql_update = "UPDATE carrinho SET quantidade = $nova_quantidade WHERE codigo = '$id_livro'";
        $resultado_update = mysqli_query($conectar, $sql_update);
        
        if (!$resultado_update) {
            error_log("Erro ao atualizar carrinho: " . mysqli_error($conectar));
            die('Erro ao atualizar item no carrinho: ' . mysqli_error($conectar));
        }
        
        error_log("Item atualizado no carrinho. Nova quantidade: " . $nova_quantidade);
        echo 'Item atualizado no carrinho com sucesso!';
        
    } else {
        $nome = mysqli_real_escape_string($conectar, $livro['titulo']);
        $codigo = mysqli_real_escape_string($conectar, $livro['codigo']);
        $preco = floatval($livro['preco']);
        $foto = !empty($livro['fotocapa1']) ? mysqli_real_escape_string($conectar, $livro['fotocapa1']) : '';
        
        error_log("Dados para inserção - Nome: $nome, Código: $codigo, Preço: $preco, Foto: $foto");
        
        $sql_insert = "INSERT INTO carrinho (nome, codigo, preco, quantidade, foto) 
                       VALUES ('$nome', '$codigo', $preco, 1, '$foto')";
        
        error_log("SQL de inserção: " . $sql_insert);
        
        $resultado_insert = mysqli_query($conectar, $sql_insert);
        
        if (!$resultado_insert) {
            error_log("Erro ao inserir no carrinho: " . mysqli_error($conectar));
            die('Erro ao adicionar item ao carrinho: ' . mysqli_error($conectar));
        }
        
        error_log("Item adicionado ao carrinho com sucesso!");
        echo 'Item adicionado ao carrinho com sucesso!';
    }
    
} else {
    error_log("Erro: id_livro não foi enviado via POST");
    error_log("POST recebido: " . print_r($_POST, true));
    die('Erro: Nenhum produto especificado');
}

mysqli_close($conectar);
?>