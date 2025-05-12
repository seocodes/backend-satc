<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Livraria - Menu</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .menu-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(102, 51, 153, 0.15);
            width: 100%;
            max-width: 500px;
            text-align: center;
            border-top: 4px solid #8855dd;
        }
        .menu-container h1 {
            color: #8855dd;
            margin-top: 10px;
            margin-bottom: 30px;
            font-weight: 600;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }
        .menu-item {
            background-color: #f3eaff;
            border-radius: 10px;
            padding: 25px 15px;
            text-decoration: none;
            color: #333;
            transition: transform 0.3s ease, background-color 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5d8ff;
        }
        .menu-item:hover {
            background-color: #e5d8ff;
            transform: translateY(-5px);
            box-shadow: 0 5px 10px rgba(102, 51, 153, 0.1);
        }
        .menu-item .icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #8855dd;
        }
        .menu-item .text {
            font-weight: 500;
            font-size: 1.1rem;
        }
        @media (max-width: 500px) {
            .menu-grid {
                grid-template-columns: 1fr;
            }
            .menu-container {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <h1>Sistema do Augustera Chapera</h1>
        
        <div class="menu-grid">
            <a href="cadastroAutor.php" class="menu-item">
                <div class="icon">👤</div>
                <div class="text">Cadastro de Autor</div>
            </a>
            
            <a href="cadastroCategoria.php" class="menu-item">
                <div class="icon">📂</div>
                <div class="text">Cadastro de Categoria</div>
            </a>
            
            <a href="cadastroEditoria.php" class="menu-item">
                <div class="icon">🏢</div>
                <div class="text">Cadastro de Editora</div>
            </a>
            
            <a href="cadastroLivro.php" class="menu-item">
                <div class="icon">📚</div>
                <div class="text">Cadastro de Livro</div>
            </a>
        </div>
        
    </div>
</body>
</html>