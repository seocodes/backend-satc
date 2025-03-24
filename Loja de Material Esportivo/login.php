<?php
//fazer conexao com o banco de dados
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("loja");

//opcao de cadastro
if(isset($_POST['Entrar'])){
    //capturar as variaveis do html
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    //query sql
    $sql = "SELECT * FROM usuario WHERE login = '$username' AND senha = '$password'";

    //manda executar o comando no BD
    $resultado = mysql_query($sql);
    
    if (mysql_num_rows($resultado) > 0){
        setcookie('login',$login);  //pra info ficar salva
        header('Location: menu.html');
    }
    else{
        echo "<script>alert('Deu errado.');</script>";
    }
}
?>