<?php
session_start();
$conectar = mysql_connect('localhost','root','');
if (!$conectar) {
    die("Erro na conexão: " . mysql_error());
}

$banco = mysql_select_db("loja");
if (!$banco) {
    die("Erro ao selecionar o banco de dados: " . mysql_error());
}

$sessao = $_SESSION['sessao_carrinho'];
$query = "SELECT c.id, ci.id_produto, p.descricao, p.preco, p.foto1
          FROM carrinho c
          JOIN carrinho_itens ci ON c.id = ci.id_carrinho
          JOIN produto p ON ci.id_produto = p.codigo
          WHERE c.sessao = '$sessao';";
$result = mysql_query($query);

if (!$result) {
    die('Erro na query: ' . mysql_error());
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras</title>
    <style>
        * {
            margin: 0; padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #f1f3f5;
            padding: 30px;
        }

        h1 {
            margin-bottom: 30px;
            font-size: 32px;
            color: #212529;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        th, td {
            padding: 20px;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85em;
        }

        td {
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
        }

        .produto-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .produto-info img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #dee2e6;
        }

        .produto-info span {
            font-weight: 500;
            color: #212529;
        }

        .preco {
            font-weight: 700;
            color: #28a745;
        }

        .total-row td {
            font-size: 1.1em;
            font-weight: bold;
            color: #212529;
            background-color: #f8f9fa;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                display: none;
            }

            td {
                padding: 15px;
                border: none;
                position: relative;
                padding-left: 50%;
                text-align: right;
            }

            td::before {
                position: absolute;
                top: 15px;
                left: 15px;
                width: 45%;
                white-space: nowrap;
                font-weight: bold;
                color: #495057;
            }

            td:nth-of-type(1)::before { content: "Produto"; }
            td:nth-of-type(2)::before { content: "Preço"; }
        }
    </style>
</head>
<body>
    <h1>Seu Carrinho</h1>
    
    <?php if(mysql_num_rows($result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
            <?php while($item = mysql_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <div class="produto-info">
                            <!-- Exibe a imagem corretamente -->
                            <img src="fotos/<?php echo $item['foto1']?>" alt="<?= htmlspecialchars($item['descricao']) ?>">
                            <span><?= htmlspecialchars($item['descricao']) ?></span>
                        </div>
                    </td>
                    <td class="preco">R$ <?= $item['preco'] ?></td>
                </tr>
                <?php $total += $item['preco']; ?>
            <?php endwhile; ?>
            <tr class="total-row">
                <td colspan="1">Total:</td>
                <td>R$ <?= $total ?></td>
            </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center; font-size: 18px; color: #6c757d;">Seu carrinho está vazio.</p>
    <?php endif; ?>
</body>
</html>
