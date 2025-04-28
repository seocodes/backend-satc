<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conectar = mysql_connect('localhost','root','');
if (!$conectar) {
    die("Erro na conexão: " . mysql_error());
}

$banco = mysql_select_db("loja");
if (!$banco) {
    die("Erro ao selecionar o banco de dados: " . mysql_error());
}

$query = "SELECT ci.id as item_id, ci.id_produto, ci.quantidade, p.descricao, p.preco, p.foto1
          FROM carrinho_itens ci
          JOIN produto p ON ci.id_produto = p.codigo
          WHERE ci.quantidade > 0";
$result = mysql_query($query);

if (!$result) {
    die('Erro na consulta: ' . mysql_error());
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras</title>
    <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
    body { background-color: #f1f3f5; padding: 30px; }
    h1 { margin-bottom: 30px; font-size: 32px; color: #212529; text-align: center; }
    table { width: 100%; border-collapse: collapse; background-color: white; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.05); overflow: hidden; }
    th, td { padding: 20px; text-align: left; }
    th { background-color: #343a40; color: white; font-weight: 600; text-transform: uppercase; font-size: 0.85em; }
    td { border-bottom: 1px solid #dee2e6; vertical-align: middle; }
    .produto-info { display: flex; align-items: center; gap: 15px; }
    .produto-info img { width: 80px; height: 80px; border-radius: 8px; object-fit: cover; border: 1px solid #dee2e6; }
    .preco { font-weight: 700; color: #28a745; text-align: center; }
    .total-row td { font-size: 1.1em; font-weight: bold; color: #212529; background-color: #f8f9fa; }
    .quantidade-container { display: flex; align-items: center; justify-content: center; }
    .quantidade-btn { background-color: #e9ecef; border: none; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.2s; text-decoration: none; color: #212529; }
    .quantidade-btn:hover { background-color: #dee2e6; }
    .quantidade-valor { margin: 0 15px; font-weight: 500; font-size: 16px; min-width: 20px; text-align: center; }
    .subtotal { font-weight: 600; color: #495057; text-align: center; }
    .col-produto { width: 40%; }
    .col-preco { width: 20%; text-align: center; }
    .col-quantidade { width: 20%; text-align: center; }
    .col-subtotal { width: 20%; text-align: center; }
    </style>
</head>
<body>

<h1>Seu Carrinho</h1>

<?php if(mysql_num_rows($result) > 0): ?>
    <table>
        <thead>
            <tr>
                <th class="col-produto">PRODUTO</th>
                <th class="col-preco">PREÇO</th>
                <th class="col-quantidade">QUANTIDADE</th>
                <th class="col-subtotal">SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
        <?php while($item = mysql_fetch_assoc($result)): ?>
            <?php 
                $preco = floatval($item['preco']);
                $quantidade = intval($item['quantidade']);
                $subtotal = $preco * $quantidade;
                $total += $subtotal;
            ?>
            <tr>
                <td class="col-produto">
                    <div class="produto-info">
                        <img src="fotos/<?php echo htmlspecialchars($item['foto1']); ?>" alt="<?php echo htmlspecialchars($item['descricao']); ?>">
                        <p><?php echo $item['descricao']; ?></p> <!-- Sem htmlspecialchars pra ver se vem sujo -->
                    </div>
                </td>
                <td class="col-preco preco">R$ <?php echo number_format($preco, 2, ',', '.'); ?></td>
                <td class="col-quantidade">
                    <div class="quantidade-container">
                        <a href="?action=decrease&item_id=<?php echo $item['item_id']; ?>" class="quantidade-btn">-</a>
                        <p class="quantidade-valor"><?php echo $quantidade; ?></p>
                        <a href="?action=increase&item_id=<?php echo $item['item_id']; ?>" class="quantidade-btn">+</a>
                    </div>
                </td>
                <td class="col-subtotal subtotal">R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
            </tr>
        <?php endwhile; ?>
        <tr class="total-row">
            <td colspan="3" style="text-align: right;">Total:</td>
            <td class="col-subtotal">R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
        </tr>
        </tbody>
    </table>

<?php else: ?>
    <p style="text-align: center; font-size: 18px; color: #6c757d;">Seu carrinho está vazio ou não foi possível recuperar os dados.</p>
<?php endif; ?>

</body>
</html>
