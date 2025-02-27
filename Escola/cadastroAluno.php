<?php
$conectar = mysql_connect("localhost", "root", "");
$banco = mysql_select_db("escola1");

if (isset($_POST['Cadastrar'])) {
    $codigoAluno = $_POST['codigoAluno'];
    $nomeAluno = $_POST['nomeAluno'];
    $fone = $_POST['fone'];
    $codCurso = $_POST['codCurso'];

    $sql = "INSERT INTO aluno(codigo, nome, fone, codcurso) VALUES ('$codigoAluno', '$nomeAluno', '$fone', '$codCurso');";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE) {
        echo "Dados gravados com sucesso.";
    } else {
        echo "Cadastro de dados falhou!";
    }
}

if (isset($_POST['Alterar'])) {

    $codigoAluno = $_POST['codigoAluno'];
    $nomeAluno = $_POST['nomeAluno'];
    $fone = $_POST['fone'];
    $codCurso = $_POST['codCurso'];

    $sql = "UPDATE aluno SET nome = '$nomeAluno', fone = '$fone', codcurso = '$codCurso' WHERE codigo = '$codigoAluno';";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE) {
        echo "Dados alterados com sucesso.";
    } else {
        echo "Alteração de dados falhou!";
    }
}


if (isset($_POST['Excluir'])) {
    $codigoAluno = $_POST['codigoAluno'];


    $sql = "DELETE FROM aluno WHERE codigo = '$codigoAluno';";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE) {
        echo "Dados excluídos com sucesso.";
    } else {
        echo "Exclusão de dados falhou!";
    }
}


if (isset($_POST['Pesquisar'])) {

    $sql = "SELECT * FROM aluno;";

    $resultado = mysql_query($sql);

    if ($resultado > 0) {
        while ($linha = mysql_fetch_assoc($resultado)) {
            echo "Código: " . $linha['codigo'] . " - Nome: " . $linha['nome'] . " - Telefone: " . $linha['fone'] . " - Código do Curso: " . $linha['codcurso'] . "<br>";
        }
    } else {
        echo "Pesquisa de dados falhou!";
    }
}
?>
