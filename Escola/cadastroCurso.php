<?php
$conectar = mysql_connect("localhost", "root", "");
$banco = mysql_select_db("escola1");

if (isset($_POST['Cadastrar'])) {
    $codCurso = $_POST['codCurso'];
    $nomeCurso = $_POST['nomeCurso'];
    $codCoordenador = $_POST['codCoordenador'];
    $sql = "INSERT INTO curso(codigo, nome, codcoordenador) VALUES ('$codCurso', '$nomeCurso', '$codCoordenador');";
    $resultado = mysql_query($sql);
    if ($resultado == TRUE) {
        echo "Curso cadastrado com sucesso.";
    } else {
        echo "Cadastro de curso falhou!";
    }
}

if (isset($_POST['Alterar'])) {
    $codCurso = $_POST['codCurso'];
    $nomeCurso = $_POST['nomeCurso'];
    $codCoordenador = $_POST['codCoordenador'];
    $sql = "UPDATE curso SET nome = '$nomeCurso', codcoordenador = '$codCoordenador' WHERE codigo = '$codCurso';";
    $resultado = mysql_query($sql);
    if ($resultado == TRUE) {
        echo "Curso alterado com sucesso.";
    } else {
        echo "Alteração de curso falhou!";
    }
}

if (isset($_POST['Excluir'])) {
    $codCurso = $_POST['codCurso'];
    $sql = "DELETE FROM curso WHERE codigo = '$codCurso';";
    $resultado = mysql_query($sql);
    if ($resultado == TRUE) {
        echo "Curso excluído com sucesso.";
    } else {
        echo "Exclusão de curso falhou!";
    }
}

if (isset($_POST['Pesquisar'])) {
    $sql = "SELECT * FROM curso;";
    $resultado = mysql_query($sql);
    if (mysql_num_rows($resultado) > 0) {
        while ($linha = mysql_fetch_assoc($resultado)) {
            echo "Código: " . $linha['codigo'] . " - Nome: " . $linha['nome'] . " - Coordenador: " . $linha['codcoordenador'] . "<br>";
        }
    } else {
        echo "Pesquisa de cursos falhou!";
    }
}
?>
