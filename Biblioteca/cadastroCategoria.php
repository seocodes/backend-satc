<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Categoria</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f7;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            height: auto;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(102, 51, 153, 0.15);
            width: 100%;
            max-width: 450px;
            margin: 20px 0;
            border-top: 4px solid #8855dd;
        }
        .form-container h2 {
            text-align: center;
            color: #8855dd;
            margin-top: 10px;
            margin-bottom: 25px;
            font-weight: 600;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        .form-group input[type="submit"] {
            background-color: #8855dd;
            color: white;
            cursor: pointer;
            border: none;
            width: auto;
            padding: 12px 20px;
            margin-right: 8px;
            margin-bottom: 8px;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        .form-group input[type="submit"]:hover {
            background-color: #7744cc;
        }
        .form-group input:focus, .form-group select:focus {
            border-color: #8855dd;
            outline: none;
            box-shadow: 0 0 0 2px rgba(136, 85, 221, 0.1);
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .menu-btn {
            background-color: #8855dd;
            color: white;
            cursor: pointer;
            border: none;
            width: auto;
            padding: 8px 12px;
            margin-right: 5px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            font-weight: 500;
        }
        .menu-btn:hover {
            background-color: #7744cc;
        }
        .resultado {
            margin-top: 20px;
            padding: 15px;
            border-radius: 6px;
            background-color: #f3eaff;
            color: #333;
        }
        @media (max-height: 800px) {
            body {
                align-items: flex-start;
                overflow-y: auto;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <a href="menu.php"><button class="menu-btn">Menu</button></a>
        <h2>Cadastro de Categoria</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" id="codigo" name="codigo" placeholder="Digite o código (apenas para pesquisa/alteração)">
            </div>
            <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome da categoria">
            </div>
            <div class="form-group button-group">
                <input type="submit" value="Cadastrar" name="Cadastrar">
                <input type="submit" value="Alterar" name="Alterar">
                <input type="submit" value="Excluir" name="Excluir">
                <input type="submit" value="Pesquisar" name="Pesquisar">
            </div>
        </form>
        
        <?php
        if(isset($_POST['Cadastrar']) || isset($_POST['Alterar']) || isset($_POST['Excluir']) || isset($_POST['Pesquisar'])) {
            echo "<div class='resultado'>";
            
            $conectar = mysqli_connect("localhost", "root", "", "livraria");
            
            if (mysqli_connect_errno()) {
                echo "Falha na conexão com MySQL: " . mysqli_connect_error();
                echo "</div>";
                exit();
            }
            
            if(isset($_POST['Cadastrar'])) {
                $nome = $_POST['nome'];
                
                if(empty($nome)) {
                    echo "O nome da categoria é obrigatório!";
                } else {
                    $sql = "INSERT INTO categoria(nome) VALUES ('$nome')";
                    $resultado = mysqli_query($conectar, $sql);
                    
                    if ($resultado) {
                        echo "Categoria cadastrada com sucesso!";
                    } else {
                        echo "Erro ao cadastrar categoria: " . mysqli_error($conectar);
                    }
                }
            }
            
            if(isset($_POST['Alterar'])) {
                $codigo = $_POST['codigo'];
                $nome = $_POST['nome'];
                
                if(empty($codigo) || empty($nome)) {
                    echo "Código e nome são obrigatórios para alteração!";
                } else {
                    $sql = "UPDATE categoria SET nome = '$nome' WHERE codigo = '$codigo'";
                    $resultado = mysqli_query($conectar, $sql);
                    
                    if ($resultado && mysqli_affected_rows($conectar) > 0) {
                        echo "Dados da categoria alterados com sucesso!";
                    } else if ($resultado && mysqli_affected_rows($conectar) == 0) {
                        echo "Nenhum registro foi alterado. Verifique o código informado.";
                    } else {
                        echo "Erro ao alterar dados: " . mysqli_error($conectar);
                    }
                }
            }
            
            if(isset($_POST['Excluir'])) {
                $codigo = $_POST['codigo'];
                
                if(empty($codigo)) {
                    echo "O código é obrigatório para exclusão!";
                } else {
                    $check_sql = "SELECT COUNT(*) as count FROM livro WHERE codcategoria = '$codigo'";
                    $check_result = mysqli_query($conectar, $check_sql);
                    $row = mysqli_fetch_assoc($check_result);
                    
                    if($row['count'] > 0) {
                        echo "Não é possível excluir esta categoria pois existem livros associados a ela!";
                    } else {
                        $sql = "DELETE FROM categoria WHERE codigo = '$codigo'";
                        $resultado = mysqli_query($conectar, $sql);
                        
                        if ($resultado && mysqli_affected_rows($conectar) > 0) {
                            echo "Categoria excluída com sucesso!";
                        } else if ($resultado && mysqli_affected_rows($conectar) == 0) {
                            echo "Nenhum registro foi excluído. Verifique o código informado.";
                        } else {
                            echo "Erro ao excluir dados: " . mysqli_error($conectar);
                        }
                    }
                }
            }
            
            if(isset($_POST['Pesquisar'])) {
                $codigo = $_POST['codigo'];
                
                if(!empty($codigo)) {
                    $sql = "SELECT * FROM categoria WHERE codigo = '$codigo'";
                } else {
                    $sql = "SELECT * FROM categoria ORDER BY nome";
                }
                
                $resultado = mysqli_query($conectar, $sql);
                
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    echo "<p>Resultados da pesquisa:</p>";
                    echo "<ul style='list-style-type:none; padding-left:0;'>";
                    while ($linha = mysqli_fetch_assoc($resultado)) {
                        echo "<li>Código: " . $linha['codigo'] . " - Nome: " . $linha['nome'] . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "Nenhuma categoria encontrada!";
                }
            }
            
            mysqli_close($conectar);
            
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>