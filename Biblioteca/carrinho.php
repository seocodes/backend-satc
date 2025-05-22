<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conectar = mysqli_connect('localhost','root','','livraria');
if (!$conectar) {
    die("Erro na conexão: " . mysqli_connect_error());
}

if (isset($_GET['action']) && isset($_GET['item_id'])) {
    $item_id = mysqli_real_escape_string($conectar, $_GET['item_id']);
    $action = $_GET['action'];
    
    if ($action == 'increase') {
        $sql = "UPDATE carrinho SET quantidade = quantidade + 1 WHERE id = '$item_id'";
        mysqli_query($conectar, $sql);
    } elseif ($action == 'decrease') {
        $check_sql = "SELECT quantidade FROM carrinho WHERE id = '$item_id'";
        $check_result = mysqli_query($conectar, $check_sql);
        $row = mysqli_fetch_assoc($check_result);
        
        if ($row['quantidade'] > 1) {
            $sql = "UPDATE carrinho SET quantidade = quantidade - 1 WHERE id = '$item_id'";
            mysqli_query($conectar, $sql);
        } else {
            // Remove o item se quantidade for 1
            $sql = "DELETE FROM carrinho WHERE id = '$item_id'";
            mysqli_query($conectar, $sql);
        }
    } elseif ($action == 'remove') {
        $sql = "DELETE FROM carrinho WHERE id = '$item_id'";
        mysqli_query($conectar, $sql);
    }
    
    header("Location: carrinho.php");
    exit;
}

$query = "SELECT id, nome, codigo, preco, foto, quantidade 
          FROM carrinho 
          WHERE quantidade > 0 
          ORDER BY id DESC";
$result = mysqli_query($conectar, $query);

if (!$result) {
    die('Erro na consulta: ' . mysqli_error($conectar));
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras - Livraria Virtual</title>
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

        .nav-link.active {
            color: white;
            font-weight: 600;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h1 {
            font-size: 2.5em;
            color: #212529;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .page-header .subtitle {
            color: #6c757d;
            font-size: 1.1em;
        }

        .carrinho-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .carrinho-header {
            background: linear-gradient(135deg, #8855dd, #7744cc);
            color: white;
            padding: 25px 30px;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 20px;
            align-items: center;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 0.5px;
        }

        .item-carrinho {
            padding: 25px 30px;
            border-bottom: 1px solid #f1f3f5;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 20px;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .item-carrinho:hover {
            background-color: #f8f9fa;
        }

        .item-carrinho:last-child {
            border-bottom: none;
        }

        .produto-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .produto-info img {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #e9ecef;
            transition: transform 0.3s ease;
        }

        .produto-info img:hover {
            transform: scale(1.05);
        }

        .produto-detalhes h3 {
            margin: 0 0 5px 0;
            color: #212529;
            font-weight: 600;
            font-size: 1.1em;
        }

        .produto-codigo {
            color: #6c757d;
            font-size: 0.9em;
        }

        .preco {
            font-weight: 700;
            color: #8855dd;
            font-size: 1.1em;
            text-align: center;
        }

        .quantidade-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .quantidade-btn {
            background-color: #8855dd;
            color: white;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .quantidade-btn:hover {
            background-color: #7744cc;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(136, 85, 221, 0.3);
        }

        .quantidade-valor {
            margin: 0 10px;
            font-weight: 600;
            font-size: 1.1em;
            min-width: 30px;
            text-align: center;
            color: #212529;
        }

        .subtotal {
            font-weight: 700;
            color: #28a745;
            font-size: 1.2em;
            text-align: center;
        }

        .btn-remover {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9em;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-remover:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }

        .total-section {
            background-color: #f8f9fa;
            padding: 30px;
            border-top: 2px solid #8855dd;
        }

        .total-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 20px;
            align-items: center;
            font-size: 1.3em;
            font-weight: 700;
            color: #212529;
        }

        .total-label {
            grid-column: 1 / 4;
            text-align: right;
            font-size: 1.2em;
        }

        .total-valor {
            color: #8855dd;
            font-size: 1.4em;
            text-align: center;
        }

        .carrinho-vazio {
            text-align: center;
            padding: 80px 40px;
            color: #6c757d;
        }

        .carrinho-vazio h2 {
            font-size: 2em;
            margin-bottom: 15px;
            color: #495057;
        }

        .carrinho-vazio p {
            font-size: 1.1em;
            margin-bottom: 30px;
        }

        .btn-continuar {
            background: linear-gradient(135deg, #8855dd, #7744cc);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-continuar:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(136, 85, 221, 0.3);
        }

        .acoes-carrinho {
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        .btn-finalizar {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 10px;
            font-size: 1.2em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-finalizar:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
        }

        @media (max-width: 768px) {
            .nav {
                padding: 15px;
                flex-direction: column;
                gap: 15px;
            }

            .carrinho-header,
            .item-carrinho,
            .total-row {
                grid-template-columns: 1fr;
                gap: 10px;
                text-align: center;
            }

            .produto-info {
                flex-direction: column;
                text-align: center;
            }

            .container {
                padding: 20px 10px;
            }

            .acoes-carrinho {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <nav class="nav">
        <a href="home.php" class="nav-logo">Livraria Virtual</a>
        <div class="nav-links">
            <a href="home.php" class="nav-link">Home</a>
            <a href="carrinho.php" class="nav-link active">Carrinho</a>
            <a href="login.php" class="nav-link">Login</a>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1>🛒 Seu Carrinho</h1>
            <p class="subtitle">Revise seus itens antes de finalizar a compra</p>
        </div>

        <?php if(mysqli_num_rows($result) > 0): ?>
            <div class="carrinho-container">
                <div class="carrinho-header">
                    <div>PRODUTO</div>
                    <div>PREÇO</div>
                    <div>QUANTIDADE</div>
                    <div>SUBTOTAL</div>
                    <div>AÇÕES</div>
                </div>

                <?php while($item = mysqli_fetch_assoc($result)): ?>
                    <?php 
                        $preco = floatval($item['preco']);
                        $quantidade = intval($item['quantidade']);
                        $subtotal = $preco * $quantidade;
                        $total += $subtotal;
                    ?>
                    <div class="item-carrinho">
                        <div class="produto-info">
                            <?php if (!empty($item['foto'])): ?>
                                <img src="fotos/<?php echo htmlspecialchars($item['foto']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>">
                            <?php else: ?>
                                <img src="imagens/sem-capa.jpg" alt="Sem imagem">
                            <?php endif; ?>
                            <div class="produto-detalhes">
                                <h3><?php echo htmlspecialchars($item['nome']); ?></h3>
                                <div class="produto-codigo">Código: <?php echo htmlspecialchars($item['codigo']); ?></div>
                            </div>
                        </div>
                        
                        <div class="preco">R$ <?php echo number_format($preco, 2, ',', '.'); ?></div>
                        
                        <div class="quantidade-container">
                            <a href="?action=decrease&item_id=<?php echo $item['id']; ?>" class="quantidade-btn">−</a>
                            <span class="quantidade-valor"><?php echo $quantidade; ?></span>
                            <a href="?action=increase&item_id=<?php echo $item['id']; ?>" class="quantidade-btn">+</a>
                        </div>
                        
                        <div class="subtotal">R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></div>
                        
                        <a href="?action=remove&item_id=<?php echo $item['id']; ?>" class="btn-remover" onclick="return confirm('Tem certeza que deseja remover este item?')">
                            🗑️ Remover
                        </a>
                    </div>
                <?php endwhile; ?>

                <div class="total-section">
                    <div class="total-row">
                        <div class="total-label">Total do Pedido:</div>
                        <div class="total-valor">R$ <?php echo number_format($total, 2, ',', '.'); ?></div>
                    </div>
                </div>

                <div class="acoes-carrinho">
                    <a href="home.php" class="btn-continuar">← Continuar Comprando</a>
                    <a href="finalizar.php" class="btn-finalizar">Finalizar Compra →</a>
                </div>
            </div>

        <?php else: ?>
            <div class="carrinho-container">
                <div class="carrinho-vazio">
                    <h2>Seu carrinho está vazio</h2>
                    <p>Que tal adicionar alguns livros incríveis à sua coleção?</p>
                    <a href="home.php" class="btn-continuar">Explorar Livros</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        document.querySelectorAll('.btn-remover').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Tem certeza que deseja remover este item do carrinho?')) {
                    e.preventDefault();
                }
            });
        });

        document.querySelectorAll('.quantidade-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    </script>
</body>
</html>

<?php
mysqli_close($conectar);
?>