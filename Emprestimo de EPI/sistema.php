<?php
    // Controle de sessão
    session_start();
    if (!isset($_SESSION['logado'])) {
        header('LOCATION: index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema - Empréstimo EPI's</title>
    <link href="assets/css/sistema.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Empréstimo EPI's</a>
        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu">
                    <svg class="bi">
                        <use xlink:href="#list">
                    </svg>
                </button>
            </li>
        </ul>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="">Empréstimo EPI's</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="#" onclick="carregarTela('telas/colaboradores.php')">Colaboradores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="#" onclick="carregarTela('telas/equipamentos.php')">Equipamentos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="#" onclick="carregarTela('telas/emprestimos.php')">Empréstimos</a>
                            </li>
                        </ul>
                        <hr class="my-3">
                        <ul class="nav flex-column mb-auto">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="#" onclick="sair()">Sair</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Aqui será impresso o conteúdo através da função carregarTela() -->
            </main>
        </div>
    </div>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Importar JS -->
    <script src="assets/js/colaborador.js"></script>
    <script src="assets/js/equipamento.js"></script>
    <script src="assets/js/usuario.js"></script>
    <script src="assets/js/emprestimo.js"></script>
    <script src="assets/js/main.js"></script>
</body>

<footer>
<p class="footer-text mt-5 mb-3 text-body-secondary text-center">&copy; By João Corradi & João Luiz Rovani</p>
</footer>
</html>