<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db("loja");

$querymarca = "SELECT * FROM marca"; 
$resultmarca = mysql_query($querymarca);
$marcas = array();
while ($row = mysql_fetch_assoc($resultmarca)) {
    $marcas[] = $row;
}

$querycategoria = "SELECT * FROM categoria"; 
$resultcategoria = mysql_query($querycategoria);
$categorias = array();
while ($row = mysql_fetch_assoc($resultcategoria)) {
    $categorias[] = $row;
}

// Obter os filtros da URL
$categoriaAtual = isset($_GET['categoria']) ? mysql_real_escape_string($_GET['categoria']) : "";
$marcaAtual = isset($_GET['marca']) ? mysql_real_escape_string($_GET['marca']) : "";

// Construir a consulta filtrada
$queryproduto = "SELECT p.* FROM produto p";

// Adicionar JOINs se necessário
if ($categoriaAtual != "") {
    $queryproduto .= " JOIN categoria c ON p.codcategoria = c.codigo";
}
if ($marcaAtual != "") {
    $queryproduto .= " JOIN marca m ON p.codmarca = m.codigo";
}

// Adicionar cláusulas WHERE
$where = array();
if ($categoriaAtual != "") {
    $where[] = "c.nome = '$categoriaAtual'";
}
if ($marcaAtual != "") {
    $where[] = "m.nome = '$marcaAtual'";
}

// Adicionar WHERE se houver filtros
if (count($where) > 0) {
    $queryproduto .= " WHERE " . implode(" AND ", $where);
}

// Executar a consulta filtrada
$resultadoprodutos = mysql_query($queryproduto);

if (!$resultadoprodutos) {
    die("Erro na consulta: " . mysql_error());
}

// Armazenar os produtos
$produtos = array();
while ($row = mysql_fetch_assoc($resultadoprodutos)) {
    $produtos[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Materiais Esportivos</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0; 
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        /* Estilos para a navegação */
        .nav {
            background-color: #212529;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
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
            color: #adb5bd;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: white;
        }

        .nav-link.login {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .nav-link.login:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        /* Ajuste para o conteúdo principal */
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
            color: #212529;
            font-weight: 700;
            border-bottom: 2px solid #6c757d;
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
            background-color: #007bff;
            border-color: #007bff;
        }

        .filter-section input[type="radio"]:checked::after {
            content: '✔';
            color: white;
            font-size: 12px;
        }

        .produtos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            padding: 30px;
            flex-grow: 1;
            background-color: #f1f3f5;
        }

        .card-produto {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: all 0.4s ease;
            border: 1px solid #e9ecef;
        }

        .card-produto:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.15);
        }

        .card-produto img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .card-produto:hover img {
            transform: scale(1.1);
        }

        .card-produto-info {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .card-produto-info h3 {
            font-weight: 600;
            color: #212529;
        }

        .card-produto-info .preco {
            font-weight: 700;
            color: #28a745;
            font-size: 1.2em;
        }

        .card-produto-info .detalhes {
            color: #6c757d;
            font-size: 0.85em;
            line-height: 1.6;
        }

        .botao-comprar {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .botao-comprar:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
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
    </style>
</head>
<body>
<!-- Nova barra de navegação -->
<nav class="nav">
    <a href="index.php" class="nav-logo">AugusteraInsano</a>
    <div class="nav-links">
        <a href="index.php" class="nav-link">Home</a>
        <a href="produtos.php" class="nav-link">Produtos</a>
        <a href="sobre.php" class="nav-link">Sobre</a>
        <a href="contato.php" class="nav-link">Contato</a>
        <a href="login.php" class="nav-link login">Login</a>
    </div>
</nav>

<div class="main-content">
    <div class="sidebar">
        <h2>Filtros</h2>
        <form method="GET" action="">
            <div class="filter-section">
                <h3>Marca</h3>
                <?php foreach ($marcas as $marca): ?>
                    <label>
                        <input type="radio" name="marca" value="<?php echo htmlspecialchars($marca['nome']); ?>" onclick="handleClick(this)"
                            <?php if($marcaAtual == $marca['nome']) echo 'checked'; ?>>
                        <?php echo htmlspecialchars($marca['nome']); ?>
                    </label>  
                <?php endforeach; ?>
            </div>
            <div class="filter-section">
                <h3>Categoria</h3>
                <?php foreach ($categorias as $categoria): ?>
                    <label>
                        <input type="radio" name="categoria" value="<?php echo htmlspecialchars($categoria['nome']); ?>" 
                        onclick="handleClick(this)" <?php if($categoriaAtual == $categoria['nome']) echo 'checked'; ?>>
                        <?php echo htmlspecialchars($categoria['nome']); ?>
                    </label>  
                <?php endforeach; ?>
            </div>
            <button type="submit" class="botao-comprar" style="margin-bottom: 20px;">Aplicar Filtros</button>
        </form>
    </div>

    <div class="produtos">
    <?php if(count($produtos) > 0): ?>
        <?php foreach ($produtos as $produto): ?>
            <div class="card-produto">
                <img src="fotos/<?php echo $produto['foto1']?>">
                <div class="card-produto-info">
                    <h3><?php echo htmlspecialchars($produto['descricao']); ?></h3>
                    <div class="preco">
                    R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                    <button class="botao-comprar">Comprar</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum produto encontrado com os filtros selecionados.</p>
    <?php endif; ?>
    </div>
</div>

<script>
  let previouslyChecked = null;

  function handleClick(radio) {
    if (previouslyChecked === radio) {
      radio.checked = false;
      previouslyChecked = null;
    } else {
      previouslyChecked = radio;
    }
  }
</script>

</body>
</html>