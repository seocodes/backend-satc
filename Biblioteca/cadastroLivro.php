<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livro</title>
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
            max-width: 600px;
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
        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 0;
        }
        .form-row .form-group {
            flex: 1;
        }
        .form-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
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
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
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
        @media (max-width: 600px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <a href="menu.php"><button class="menu-btn">Menu</button></a>
        <h2>Cadastro de Livro</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" id="codigo" name="codigo" placeholder="Digite o código (apenas para pesquisa/alteração)">
            </div>
            
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" placeholder="Digite o título do livro">
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="nrpaginas">Número de Páginas</label>
                    <input type="number" id="nrpaginas" name="nrpaginas" placeholder="Páginas">
                </div>
                
                <div class="form-group">
                    <label for="ano">Ano</label>
                    <input type="number" id="ano" name="ano" placeholder="Ano de publicação">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="codautor">Autor</label>
                    <select id="codautor" name="codautor">
                        <option value="">Selecione o autor</option>
                        <?php
                        $conectar = mysqli_connect("localhost", "root", "", "livraria");
                        if (!mysqli_connect_errno()) {
                            $sql = "SELECT codigo, nome FROM autor ORDER BY nome";
                            $resultado = mysqli_query($conectar, $sql);
                            while ($autor = mysqli_fetch_assoc($resultado)) {
                                echo "<option value='" . $autor['codigo'] . "'>" . $autor['nome'] . "</option>";
                            }
                            mysqli_close($conectar);
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="codcategoria">Categoria</label>
                    <select id="codcategoria" name="codcategoria">
                        <option value="">Selecione a categoria</option>
                        <?php
                        $conectar = mysqli_connect("localhost", "root", "", "livraria");
                        if (!mysqli_connect_errno()) {
                            $sql = "SELECT codigo, nome FROM categoria ORDER BY nome";
                            $resultado = mysqli_query($conectar, $sql);
                            while ($categoria = mysqli_fetch_assoc($resultado)) {
                                echo "<option value='" . $categoria['codigo'] . "'>" . $categoria['nome'] . "</option>";
                            }
                            mysqli_close($conectar);
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="codeditora">Editora</label>
                <select id="codeditora" name="codeditora">
                    <option value="">Selecione a editora</option>
                    <?php
                    $conectar = mysqli_connect("localhost", "root", "", "livraria");
                    if (!mysqli_connect_errno()) {
                        $sql = "SELECT codigo, nome FROM editora ORDER BY nome";
                        $resultado = mysqli_query($conectar, $sql);
                        while ($editora = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='" . $editora['codigo'] . "'>" . $editora['nome'] . "</option>";
                        }
                        mysqli_close($conectar);
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="resenha">Resenha</label>
                <textarea id="resenha" name="resenha" placeholder="Digite a resenha do livro"></textarea>
            </div>
            
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" id="preco" name="preco" step="0.01" placeholder="0.00">
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="fotocapa1">Imagem da capa (frente)</label>
                    <input type="file" id="fotocapa1" name="fotocapa1">
                </div>
                
                <div class="form-group">
                    <label for="fotocapa2">Imagem da capa (traseira)</label>
                    <input type="file" id="fotocapa2" name="fotocapa2">
                </div>
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
                $titulo = $_POST['titulo'];
                $nrpaginas = $_POST['nrpaginas'];
                $ano = $_POST['ano'];
                $codautor = $_POST['codautor'];
                $codcategoria = $_POST['codcategoria'];
                $codeditora = $_POST['codeditora'];
                $resenha = $_POST['resenha'];
                $preco = $_POST['preco'];
                
                if(empty($titulo) || empty($codautor) || empty($codcategoria) || empty($codeditora)) {
                    echo "Os campos Título, Autor, Categoria e Editora são obrigatórios!";
                } else {
                    $fotocapa1 = "";
                    if(isset($_FILES['fotocapa1']) && $_FILES['fotocapa1']['error'] == 0) {
                        $temp_name = $_FILES['fotocapa1']['tmp_name'];
                        $fotocapa1 = addslashes(file_get_contents($temp_name));
                    }
                    
                    $fotocapa2 = "";
                    if(isset($_FILES['fotocapa2']) && $_FILES['fotocapa2']['error'] == 0) {
                        $temp_name = $_FILES['fotocapa2']['tmp_name'];
                        $fotocapa2 = addslashes(file_get_contents($temp_name));
                    }
                    
                    $sql = "INSERT INTO livro (titulo, nrpaginas, ano, codautor, codcategoria, codeditora, resenha, preco, fotocapa1, fotocapa2) 
                            VALUES ('$titulo', '$nrpaginas', '$ano', '$codautor', '$codcategoria', '$codeditora', '$resenha', '$preco', '$fotocapa1', '$fotocapa2')";
                    
                    $resultado = mysqli_query($conectar, $sql);
                    
                    if ($resultado) {
                        echo "Livro cadastrado com sucesso!";
                    } else {
                        echo "Erro ao cadastrar livro: " . mysqli_error($conectar);
                    }
                }
            }
            
            if(isset($_POST['Alterar'])) {
                $codigo = $_POST['codigo'];
                $titulo = $_POST['titulo'];
                $nrpaginas = $_POST['nrpaginas'];
                $ano = $_POST['ano'];
                $codautor = $_POST['codautor'];
                $codcategoria = $_POST['codcategoria'];
                $codeditora = $_POST['codeditora'];
                $resenha = $_POST['resenha'];
                $preco = $_POST['preco'];
                
                if(empty($codigo)) {
                    echo "O código é obrigatório para alteração!";
                } else {
                    $check = mysqli_query($conectar, "SELECT codigo FROM livro WHERE codigo = '$codigo'");
                    if(mysqli_num_rows($check) == 0) {
                        echo "Livro não encontrado!";
                    } else {
                        $sql = "UPDATE livro SET ";
                        $campos = array();
                        
                        if(!empty($titulo)) $campos[] = "titulo = '$titulo'";
                        if(!empty($nrpaginas)) $campos[] = "nrpaginas = '$nrpaginas'";
                        if(!empty($ano)) $campos[] = "ano = '$ano'";
                        if(!empty($codautor)) $campos[] = "codautor = '$codautor'";
                        if(!empty($codcategoria)) $campos[] = "codcategoria = '$codcategoria'";
                        if(!empty($codeditora)) $campos[] = "codeditora = '$codeditora'";
                        if(!empty($resenha)) $campos[] = "resenha = '$resenha'";
                        if(!empty($preco)) $campos[] = "preco = '$preco'";
                        
                        if(isset($_FILES['fotocapa1']) && $_FILES['fotocapa1']['error'] == 0) {
                            $temp_name = $_FILES['fotocapa1']['tmp_name'];
                            $fotocapa1 = addslashes(file_get_contents($temp_name));
                            $campos[] = "fotocapa1 = '$fotocapa1'";
                        }
                        
                        if(isset($_FILES['fotocapa2']) && $_FILES['fotocapa2']['error'] == 0) {
                            $temp_name = $_FILES['fotocapa2']['tmp_name'];
                            $fotocapa2 = addslashes(file_get_contents($temp_name));
                            $campos[] = "fotocapa2 = '$fotocapa2'";
                        }
                        
                        if(count($campos) > 0) {
                            $sql .= implode(", ", $campos) . " WHERE codigo = '$codigo'";
                            $resultado = mysqli_query($conectar, $sql);
                            
                            if ($resultado && mysqli_affected_rows($conectar) > 0) {
                                echo "Dados do livro alterados com sucesso!";
                            } else if ($resultado && mysqli_affected_rows($conectar) == 0) {
                                echo "Nenhum dado foi alterado.";
                            } else {
                                echo "Erro ao alterar dados: " . mysqli_error($conectar);
                            }
                        } else {
                            echo "Nenhum campo foi preenchido para alteração!";
                        }
                    }
                }
            }
            
            if(isset($_POST['Excluir'])) {
                $codigo = $_POST['codigo'];
                
                if(empty($codigo)) {
                    echo "O código é obrigatório para exclusão!";
                } else {
                    $check = mysqli_query($conectar, "SELECT codigo FROM livro WHERE codigo = '$codigo'");
                    if(mysqli_num_rows($check) == 0) {
                        echo "Livro não encontrado!";
                    } else {
                        $sql = "DELETE FROM livro WHERE codigo = '$codigo'";
                        $resultado = mysqli_query($conectar, $sql);
                        
                        if ($resultado && mysqli_affected_rows($conectar) > 0) {
                            echo "Livro excluído com sucesso!";
                        } else {
                            echo "Erro ao excluir livro: " . mysqli_error($conectar);
                        }
                    }
                }
            }
            
            if(isset($_POST['Pesquisar'])) {
                $codigo = $_POST['codigo'];
                $titulo = $_POST['titulo'];
                $codautor = $_POST['codautor'];
                $codcategoria = $_POST['codcategoria'];
                
                $where = array();
                if(!empty($codigo)) $where[] = "l.codigo = '$codigo'";
                if(!empty($titulo)) $where[] = "l.titulo LIKE '%$titulo%'";
                if(!empty($codautor)) $where[] = "l.codautor = '$codautor'";
                if(!empty($codcategoria)) $where[] = "l.codcategoria = '$codcategoria'";
                
                $sql = "SELECT l.codigo, l.titulo, l.nrpaginas, l.ano, a.nome as autor, c.nome as categoria, e.nome as editora, l.preco 
                        FROM livro l 
                        LEFT JOIN autor a ON l.codautor = a.codigo 
                        LEFT JOIN categoria c ON l.codcategoria = c.codigo 
                        LEFT JOIN editora e ON l.codeditora = e.codigo";
                
                if(count($where) > 0) {
                    $sql .= " WHERE " . implode(" AND ", $where);
                }
                
                $sql .= " ORDER BY l.titulo";
                
                $resultado = mysqli_query($conectar, $sql);
                
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    echo "<p>Resultados da pesquisa:</p>";
                    echo "<table style='width:100%; border-collapse:collapse; margin-top:10px;'>";
                    echo "<tr style='background-color:#f0e7ff; text-align:left;'>";
                    echo "<th style='padding:8px;'>Código</th>";
                    echo "<th style='padding:8px;'>Título</th>";
                    echo "<th style='padding:8px;'>Páginas</th>";
                    echo "<th style='padding:8px;'>Ano</th>";
                    echo "<th style='padding:8px;'>Autor</th>";
                    echo "<th style='padding:8px;'>Categoria</th>";
                    echo "<th style='padding:8px;'>Editora</th>";
                    echo "<th style='padding:8px;'>Preço</th>";
                    echo "</tr>";
                    
                    $cor = false;
                    while ($linha = mysqli_fetch_assoc($resultado)) {
                        $estilo = $cor ? "background-color:#fbf9ff;" : "";
                        echo "<tr style='" . $estilo . "'>";
                        echo "<td style='padding:8px;'>" . $linha['codigo'] . "</td>";
                        echo "<td style='padding:8px;'>" . $linha['titulo'] . "</td>";
                        echo "<td style='padding:8px;'>" . $linha['nrpaginas'] . "</td>";
                        echo "<td style='padding:8px;'>" . $linha['ano'] . "</td>";
                        echo "<td style='padding:8px;'>" . $linha['autor'] . "</td>";
                        echo "<td style='padding:8px;'>" . $linha['categoria'] . "</td>";
                        echo "<td style='padding:8px;'>" . $linha['editora'] . "</td>";
                        echo "<td style='padding:8px;'>R$ " . number_format($linha['preco'], 2, ',', '.') . "</td>";
                        echo "</tr>";
                        $cor = !$cor;
                    }
                    
                    echo "</table>";
                } else {
                    echo "Nenhum livro encontrado!";
                }
            }
            
            mysqli_close($conectar);
            
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>