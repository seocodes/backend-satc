<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraria - Home</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f7;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        .nav {
            background-color: #8855dd;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(136, 85, 221, 0.3);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .nav-logo {
            font-size: 24px;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }
        .nav-links {
            display: flex;
            gap: 25px;
            align-items: center;
        }
        .nav-link {
            color: #f3eaff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: white;
            text-decoration: underline;
        }
        .nav-link.login {
            background-color: #7744cc;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .nav-link.login:hover {
            background-color: #6633bb;
            transform: translateY(-2px);
        }
        .main-content {
            display: flex;
            flex-grow: 1;
        }
        .sidebar {
            width: 280px;
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-right: 1px solid #e9ecef;
        }
        .sidebar h2 {
            margin-bottom: 25px;
            color: #8855dd;
            font-weight: 700;
            border-bottom: 2px solid #8855dd;
            padding-bottom: 10px;
        }
        .filter-section {
            margin-bottom: 25px;
        }
        .filter-section h3 {
            margin-bottom: 15px;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
        }
        .filter-section label {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #6c757d;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .filter-section label:hover {
            color: #343a40;
        }
        .filter-section input[type="radio"] {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #ced4da;
            border-radius: 4px;
            margin-right: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .filter-section input[type="radio"]:checked {
            background-color: #8855dd;
            border-color: #8855dd;
        }
        .filter-section input[type="radio"]:checked::after {
            content: '✔';
            color: white;
            font-size: 12px;
        }
        .livros {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            padding: 30px;
            flex-grow: 1;
            background-color: #f3eaff;
        }
        .card-livro {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: all 0.4s ease;
            border: 1px solid #e9ecef;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-livro:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 20px rgba(136, 85, 221, 0.25);
        }
        .card-livro-img {
            height: 300px;
            overflow: hidden;
            position: relative;
        }
        .card-livro img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .card-livro:hover img {
            transform: scale(1.1);
        }
        .card-livro-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex-grow: 1;
        }
        .card-livro-info h3 {
            font-weight: 600;
            color: #212529;
            margin-top: 0;
        }
        .card-livro-info .categoria {
            color: #8855dd;
            font-weight: 500;
            font-size: 0.9em;
            text-transform: uppercase;
        }
        .card-livro-info .autor {
            color: #6c757d;
            font-size: 0.9em;
        }
        .card-livro-info .preco {
            font-weight: 700;
            color: #8855dd;
            font-size: 1.2em;
            margin-top: auto;
        }
        .botao-comprar {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #8855dd;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
        .botao-comprar:hover {
            background-color: #7744cc;
            transform: translateY(-3px);
        }
        .modal {
            display: none; 
            position: fixed;
            z-index: 2000; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5); 
        }
        .modal-conteudo {
            position: relative;
            background-color: #fff;
            margin: 15% auto;
            padding: 30px;
            width: 90%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .modal-conteudo h3 {
            color: #8855dd;
            margin-bottom: 15px;
            font-size: 1.5em;
        }
        .modal-conteudo p {
            color: #495057;
            margin-bottom: 20px;
        }
        .modal-botoes {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }
        .modal-botoes button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .modal-botoes button:first-child {
            background-color: #8855dd;
            color: white;
        }
        .modal-botoes button:first-child:hover {
            background-color: #7744cc;
        }
        .modal-botoes button:last-child {
            background-color: #6c757d;
            color: white;
        }
        .modal-botoes button:last-child:hover {
            background-color: #5a6268; 
        }
        .botao-filtrar {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #8855dd;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        .botao-filtrar:hover {
            background-color: #7744cc;
        }
        .sem-resultados {
            grid-column: 1 / -1;
            text-align: center;
            color: #6c757d;
            padding: 50px;
            font-size: 1.2em;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
        @media (max-width: 1024px) {
            .main-content {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                border-right: none;
                border-bottom: 1px solid #e9ecef;
            }
            .filter-section {
                flex: 1;
                min-width: 200px;
            }
            .nav {
                padding: 15px;
            }
            .nav-links {
                gap: 15px;
            }
        }
        @media (max-width: 600px) {
            .nav {
                flex-direction: column;
                gap: 15px;
            }
        }

        .banner-container {
            width: 100%;
            overflow: hidden;
            background: linear-gradient(135deg, #8855dd 0%, #a366e6 100%);
            padding: 20px 0;
            position: relative;
            box-shadow: 0 2px 10px rgba(136, 85, 221, 0.2);
        }
        .banner-scroll {
            display: flex;
            animation: scroll 30s linear infinite;
            gap: 20px;
            padding: 0 20px;
        }
        .banner-item {
            flex-shrink: 0;
            width: 120px;
            height: 160px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            background-color: white;
        }
        .banner-item:hover {
            transform: scale(1.05);
        }
        .banner-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .banner-item:hover img {
            transform: scale(1.1);
        }
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(calc(-120px * 10 - 200px));
            }
        }
        .banner-scroll:hover {
            animation-play-state: paused;
        }

        @media (max-width: 1024px) {
            .banner-item {
                width: 100px;
                height: 130px;
            }
            @keyframes scroll {
                0% {
                    transform: translateX(0);
                }
                100% {
                    transform: translateX(calc(-100px * 10 - 200px));
                }
            }
        }
        @media (max-width: 600px) {
            .banner-item {
                width: 80px;
                height: 110px;
            }
            @keyframes scroll {
                0% {
                    transform: translateX(0);
                }
                100% {
                    transform: translateX(calc(-80px * 10 - 200px));
                }
            }
        }
    </style>
</head>
<body>
    <div id="modalCarrinho" class="modal">
        <div class="modal-conteudo">
            <h3>Adicionar ao carrinho?</h3>
            <p>Deseja adicionar este livro ao seu carrinho?</p>
            <div class="modal-botoes">
                <button onclick="adicionarAoCarrinho()">Sim</button>
                <button onclick="fecharModal()">Não</button>
            </div>
        </div>
    </div>

    <nav class="nav">
        <a href="home.php" class="nav-logo">AUGUSTERA CHAPERA</a>
        <div class="nav-links">
            <a href="home.php" class="nav-link">Home</a>
            <a href="carrinho.php" class="nav-link">Carrinho</a>
            <a href="login.php" class="nav-link login">Login</a>
        </div>
    </nav>

    <div class="banner-container">
        <div class="banner-scroll">
        <?php
        // Array com nomes das imagens da pasta fotos
        $imagens_banner = array(
            'images.jpg',
            '81dYD9yyjBL._SY466_.jpg', 
            'A18sO0RgI+L._UF894,1000_QL80_.jpg',
        );
        
        // Duplica o array para criar o efeito de loop infinito
        $imagens_duplicadas = array_merge($imagens_banner, $imagens_banner);
        
        foreach($imagens_duplicadas as $imagem) {
            echo '<div class="banner-item">';
            echo '<img src="fotos/' . $imagem . '" alt="Livro em destaque" onerror="this.src=\'imagens/sem-capa.jpg\'">';
            echo '</div>';
        }
        ?>
        </div>
    </div>

    <div class="main-content">
        <div class="sidebar">
            <h2>Filtros</h2>
            <form method="GET" action="">
                <div class="filter-section">
                    <h3>Categoria</h3>
                    <?php
                    $conectar = mysqli_connect("localhost", "root", "", "livraria");
                    if (!mysqli_connect_errno()) {
                        $sql = "SELECT codigo, nome FROM categoria ORDER BY nome";
                        $resultado = mysqli_query($conectar, $sql);
                        
                        $categoriaAtual = isset($_GET['categoria']) ? mysqli_real_escape_string($conectar, $_GET['categoria']) : "";
                        
                        echo '<label>';
                        echo '<input type="radio" name="categoria" value="" onclick="handleClick(this)"';
                        if($categoriaAtual == "") echo ' checked';
                        echo '>';
                        echo 'Todas as categorias';
                        echo '</label>';
                        
                        while ($categoria = mysqli_fetch_assoc($resultado)) {
                            echo '<label>';
                            echo '<input type="radio" name="categoria" value="' . $categoria['codigo'] . '" onclick="handleClick(this)"';
                            if($categoriaAtual == $categoria['codigo']) echo ' checked';
                            echo '>';
                            echo htmlspecialchars($categoria['nome']);
                            echo '</label>';
                        }
                    }
                    ?>
                </div>
                
                <div class="filter-section">
                    <h3>Autor</h3>
                    <?php
                    if (!mysqli_connect_errno()) {
                        $sql = "SELECT codigo, nome FROM autor ORDER BY nome";
                        $resultado = mysqli_query($conectar, $sql);
                        
                        $autorAtual = isset($_GET['autor']) ? mysqli_real_escape_string($conectar, $_GET['autor']) : "";
                        
                        echo '<label>';
                        echo '<input type="radio" name="autor" value="" onclick="handleClick(this)"';
                        if($autorAtual == "") echo ' checked';
                        echo '>';
                        echo 'Todos os autores';
                        echo '</label>';
                        
                        while ($autor = mysqli_fetch_assoc($resultado)) {
                            echo '<label>';
                            echo '<input type="radio" name="autor" value="' . $autor['codigo'] . '" onclick="handleClick(this)"';
                            if($autorAtual == $autor['codigo']) echo ' checked';
                            echo '>';
                            echo htmlspecialchars($autor['nome']);
                            echo '</label>';
                        }
                    }
                    ?>
                </div>
                
                <div class="filter-section">
                    <h3>Editora</h3>
                    <?php
                    if (!mysqli_connect_errno()) {
                        $sql = "SELECT codigo, nome FROM editora ORDER BY nome";
                        $resultado = mysqli_query($conectar, $sql);
                        
                        $editoraAtual = isset($_GET['editora']) ? mysqli_real_escape_string($conectar, $_GET['editora']) : "";
                        
                        echo '<label>';
                        echo '<input type="radio" name="editora" value="" onclick="handleClick(this)"';
                        if($editoraAtual == "") echo ' checked';
                        echo '>';
                        echo 'Todas as editoras';
                        echo '</label>';
                        
                        while ($editora = mysqli_fetch_assoc($resultado)) {
                            echo '<label>';
                            echo '<input type="radio" name="editora" value="' . $editora['codigo'] . '" onclick="handleClick(this)"';
                            if($editoraAtual == $editora['codigo']) echo ' checked';
                            echo '>';
                            echo htmlspecialchars($editora['nome']);
                            echo '</label>';
                        }
                    }
                    ?>
                </div>
                
                <button type="submit" class="botao-filtrar">Aplicar Filtros</button>
            </form>
        </div>

        <div class="livros">
            <?php
            // Consulta para buscar livros com filtros
            $categoriaAtual = isset($_GET['categoria']) ? mysqli_real_escape_string($conectar, $_GET['categoria']) : "";
            $autorAtual = isset($_GET['autor']) ? mysqli_real_escape_string($conectar, $_GET['autor']) : "";
            $editoraAtual = isset($_GET['editora']) ? mysqli_real_escape_string($conectar, $_GET['editora']) : "";
            
            $sql = "SELECT l.codigo, l.titulo, l.nrpaginas, l.ano, l.preco, l.resenha,
                    a.nome as autor, c.nome as categoria, e.nome as editora,
                    l.fotocapa1
                    FROM livro l
                    LEFT JOIN autor a ON l.codautor = a.codigo
                    LEFT JOIN categoria c ON l.codcategoria = c.codigo
                    LEFT JOIN editora e ON l.codeditora = e.codigo";
            
            $where = array();
            if ($categoriaAtual != "") {
                $where[] = "l.codcategoria = '$categoriaAtual'";
            }
            if ($autorAtual != "") {
                $where[] = "l.codautor = '$autorAtual'";
            }
            if ($editoraAtual != "") {
                $where[] = "l.codeditora = '$editoraAtual'";
            }
            
            if (count($where) > 0) {
                $sql .= " WHERE " . implode(" AND ", $where);
            }
            
            $sql .= " ORDER BY l.titulo";
            
            $resultado = mysqli_query($conectar, $sql);
            
            if ($resultado && mysqli_num_rows($resultado) > 0) {
                while ($livro = mysqli_fetch_assoc($resultado)) {
                    ?>
                    <div class="card-livro">
                        <div class="card-livro-img">
                            <?php
                            if (!empty($livro['fotocapa1'])) {
                                echo '<img src="fotos/' . $livro['fotocapa1'] . '" alt="' . htmlspecialchars($livro['titulo']) . '">';
                            } else {
                                echo '<img src="imagens/sem-capa.jpg" alt="Capa indisponível">';
                            }
                            ?>
                        </div>
                        <div class="card-livro-info">
                            <div class="categoria"><?php echo htmlspecialchars($livro['categoria']); ?></div>
                            <h3><?php echo htmlspecialchars($livro['titulo']); ?></h3>
                            <div class="autor">por <?php echo htmlspecialchars($livro['autor']); ?></div>
                            <div class="editora">Editora: <?php echo htmlspecialchars($livro['editora']); ?></div>
                            <div class="ano-paginas">
                                <?php echo $livro['ano'] ? $livro['ano'] . ' - ' : ''; ?>
                                <?php echo $livro['nrpaginas'] ? $livro['nrpaginas'] . ' páginas' : ''; ?>
                            </div>
                            <div class="preco">
                                R$ <?php echo number_format($livro['preco'], 2, ',', '.'); ?>
                            </div>
                            <button class="botao-comprar" onclick="abrirModalConfirmacao(<?php echo $livro['codigo']; ?>)">Comprar</button>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="sem-resultados">';
                echo '<h3>Nenhum livro encontrado</h3>';
                echo '<p>Não há livros disponíveis com os filtros selecionados. Tente outros critérios de busca.</p>';
                echo '</div>';
            }
            
            // Fechar conexão
            if (isset($conectar)) {
                mysqli_close($conectar);
            }
            ?>
        </div>
    </div>

    <script>
        let previouslyCheckedCategoria = null;
        let previouslyCheckedAutor = null;
        let previouslyCheckedEditora = null;
        let livroSelecionado = null;

        function handleClick(radio) {
            const name = radio.getAttribute('name');
            
            if (name === 'categoria') {
                if (previouslyCheckedCategoria === radio) {
                    radio.checked = false;
                    previouslyCheckedCategoria = null;
                } else {
                    previouslyCheckedCategoria = radio;
                }
            } else if (name === 'autor') {
                if (previouslyCheckedAutor === radio) {
                    radio.checked = false;
                    previouslyCheckedAutor = null;
                } else {
                    previouslyCheckedAutor = radio;
                }
            } else if (name === 'editora') {
                if (previouslyCheckedEditora === radio) {
                    radio.checked = false;
                    previouslyCheckedEditora = null;
                } else {
                    previouslyCheckedEditora = radio;
                }
            }
        }

        function abrirModalConfirmacao(codigoLivro) {
            livroSelecionado = codigoLivro;
            document.getElementById('modalCarrinho').style.display = 'block';
        }

        function fecharModal() {
            document.getElementById('modalCarrinho').style.display = 'none';
            livroSelecionado = null;
        }

        function adicionarAoCarrinho() {
            if(!livroSelecionado) return;
            
            fetch('adicionarCarrinho.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_livro=' + livroSelecionado
            })
            .then(response => response.text())
            .then(data => {
                alert('Livro adicionado ao carrinho!');
                fecharModal();
            })
            .catch(error => {
                console.error(error);
                alert('Ocorreu um erro ao adicionar o livro ao carrinho.');
                fecharModal();
            });
        }
    </script>
</body>
</html>