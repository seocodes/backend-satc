<?php
//fazer conexao com o banco de dados
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("escola1");

//opcao de cadastro
if(isset($_POST['Cadastrar'])){
    //capturar as variaveis do html
    $codCoordenador = $_POST['codCoordenador'];
    $nomeCoordenador = $_POST['nomeCoordenador'];

    //comando sql do banco de dados
    $sql = "INSERT INTO coordenador(codigo, nome) values ('$codCoordenador','$nomeCoordenador');";

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
        $codCoordenador = $_POST['codCoordenador'];
        $nomeCoordenador = $_POST['nomeCoordenador'];
    
        //comando sql do banco de dados
        $sql = "UPDATE coordenador SET nome = '$nomeCoordenador'  WHERE codigo = '$codCoordenador';";
    
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
    $codCoordenador = $_POST['codCoordenador'];
    $nomeCoordenador = $_POST['nomeCoordenador'];

    //comando sql do banco de dados
    $sql = "DELETE FROM coordenador WHERE codigo = '$codCoordenador';";

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
        $sql = "SELECT * FROM coordenador;";

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
