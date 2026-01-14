<?php
    session_start();
    if (isset($_SESSION['logado'])) {
        header('LOCATION: sistema.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Empréstimo EPI's</title>
    <link href="assets/css/index.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .logo {
            height: 75px;
        }
    </style>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form id="form-login" onsubmit="return false">
            <h1>Empéstimo EPI's</h1>
            <h1 class="h3 mb-3 fw-normal">Faça o login</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="txt_usuario" required>
                <label for="txt_usuario">Usuário</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="txt_senha" required>
                <label for="txt_senha">Senha</label>
            </div>
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="true" id="check_lembrar">
                <label class="form-check-label" for="check_lembrar">Manter-me conectado</label>
            </div>
            <button class="btn btn-primary w-100 py-2" onclick="entrar()">Entrar</button>
            <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2024</p><br>
            <p class="mt-5 mb-3 text-body-secondary text-center">&copy; By João Corradi & João Luiz Rovani </p>
        </form>
    </main>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Importar JS -->
    <script src="assets/js/usuario.js"></script>
</body>
</html>