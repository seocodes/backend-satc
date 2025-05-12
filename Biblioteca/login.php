<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Livraria</title>
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
        }
        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(102, 51, 153, 0.15);
            width: 100%;
            max-width: 400px;
            border-top: 4px solid #8855dd;
        }
        .login-container h2 {
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
        .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus {
            border-color: #8855dd;
            outline: none;
            box-shadow: 0 0 0 2px rgba(136, 85, 221, 0.1);
        }
        .login-btn {
            background-color: #8855dd;
            color: white;
            cursor: pointer;
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }
        .login-btn:hover {
            background-color: #7744cc;
        }
        .error-msg {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 15px;
            padding: 10px;
            background-color: #fdf2f0;
            border-radius: 4px;
            text-align: center;
            border-left: 3px solid #e74c3c;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #8855dd;
        }
        .logo span {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <div class="logo">Livra<span>ria</span> AUGUSTERA CHAPERA</div>
        </div>
        <h2>Login</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" placeholder="Digite seu nome de usuário" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            
            <button type="submit" class="login-btn" name="login">Entrar</button>
        </form>
        
        <?php
        session_start();
        
        if(isset($_POST['login'])) {
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];
            
            $conectar = mysqli_connect("localhost", "root", "", "livraria");
            
            if (mysqli_connect_errno()) {
                echo "<div class='error-msg'>Falha na conexão com MySQL: " . mysqli_connect_error() . "</div>";
                exit();
            }
            
            $sql = "SELECT * FROM usuario WHERE nome = '$usuario' AND senha = '$senha'";
            $resultado = mysqli_query($conectar, $sql);
            
            if(mysqli_num_rows($resultado) == 1) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['logado'] = true;

            
                header("Location: menu.php");
                exit();
            } else {
                echo "<div class='error-msg'>Usuário ou senha incorretos!</div>";
            }
            
            mysqli_close($conectar);
        }
        ?>
    </div>
</body>
</html>