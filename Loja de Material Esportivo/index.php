<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db("loja");

$queryproduto = "SELECT * FROM produto";
$resultadoprodutos = mysql_query($queryproduto);

$produtos = array();
while ($row = mysql_fetch_assoc($resultadoprodutos)){
    $produtos[] = $row;
}

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
            background-color: #f8f9fa;
            min-height: 100vh;
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

        .filter-section input[type="checkbox"] {
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

        .filter-section input[type="checkbox"]:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .filter-section input[type="checkbox"]:checked::after {
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
            body {
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
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Filtros</h2>
        <div class="filter-section">
        <h3>Marca</h3>
        <?php foreach ($marcas as $marca): ?>
            <label>
                <input type="checkbox"><?php echo htmlspecialchars($marca['nome']);?>
            </label>  
            <?php endforeach; ?>
        </div>
        <div class="filter-section">
            <h3>Categoria</h3>
            <?php foreach ($categorias as $categoria): ?>
                <label>
                    <input type="checkbox"><?php echo htmlspecialchars($categoria['nome']);?>
                </label>  
                <?php endforeach; ?>
        </div>
</div>

    <?php
    $sql = "SELECT * FROM produto";
    $resultado = mysql_query($sql);
    ?>

    <div class="produtos">
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
    </div>
</body>
</html>