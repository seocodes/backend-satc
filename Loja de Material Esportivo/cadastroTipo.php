<?php
//fazer conexao com o banco de dados
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("loja");

//opcao de cadastro
if(isset($_POST['Cadastrar'])){
    //capturar as variaveis do html
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];

    //comando sql do banco de dados
    $sql = "INSERT INTO tipo(codigo, nome) values ('$codigo','$nome');";

    //manda executar o comando no BD
    $resultado = mysql_query($sql);
    
    if ($resultado == TRUE){
        echo "Dados gravados com sucesso.";
    }
    else{
        echo "Cadastro de dados falhou!";
    }
}

//opcao de alterar
if(isset($_POST['Alterar'])){
        //capturar as variaveis do html
        $codigo = $_POST['codigo'];
        $nome = $_POST['nome'];
    
        //comando sql do banco de dados
        $sql = "UPDATE tipo SET nome = '$nome'  WHERE codigo = '$codigo';";
    
        //manda executar o comando no BD
        $resultado = mysql_query($sql);
        
        if ($resultado == TRUE){
            echo "Dados alterados com sucesso.";
        }
        else{
            echo "Alteração de dados falhou!";
        }
}

//opcao de excluir
if(isset($_POST['Excluir'])){
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];

    //comando sql do banco de dados
    $sql = "DELETE FROM tipo WHERE codigo = '$codigo';";

    //manda executar o comando no BD
    $resultado = mysql_query($sql);
    
    if ($resultado == TRUE){
        echo "Dados excluídos com sucesso.";
    }
    else{
        echo "Exclusão de dados falhou!";
    }
}

//opcao de pesquisar
if(isset($_POST['Pesquisar'])){
        //comando sql do banco de dados
        $sql = "SELECT * FROM tipo;";

        //manda executar o comando no BD
        $resultado = mysql_query($sql);
        
        if ($resultado > 0){
            while ($linha = mysql_fetch_assoc($resultado)) {
                echo "Código: " . $linha['codigo'] . " - Nome: " . $linha['nome'] . "<br>";
        }
        }
        else{
            echo "Pesquisa de dados falhou!";
        }
    }

?>
