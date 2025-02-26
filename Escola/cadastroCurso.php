<?php
//fazer conexao com o banco de dados
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("escola");

//opcao de cadastro
if(isset($_POST['Cadastrar'])){
    //capturar as variaveis do html
    $codigo = $_POST['codigo'];
    $nome_curso = $_POST['nome_curso'];
    $coordernador = $_POST['coordenador'];

    //comando sql do banco de dados
    $sql = "INSERT INTO curso(codigo, nome_curso, coordenador) values ('$codigo','$nome_curso','$coordernador');";

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

}

//opcao de excluir
if(isset($_POST['Excluir'])){

}

//opcao de pesquisar
if(isset($_POST['Pesquisar'])){

}

?>
