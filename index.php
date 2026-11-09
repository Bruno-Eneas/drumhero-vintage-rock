<?php
session_start();

require_once __DIR__ . '/app/Config/Database.php';
require_once __DIR__ . '/app/Config/Logger.php'; // NOVO: Importamos o Logger aqui!

require_once __DIR__ . '/app/Models/Usuario.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';

require_once __DIR__ . '/app/Models/Baterista.php';
require_once __DIR__ . '/app/Controllers/BateristaController.php';

$rota = isset($_GET['rota']) ? $_GET['rota'] : 'home';

// ... (resto do switch continua igual)

switch ($rota) {
    case 'home':
        require_once __DIR__ . '/app/Views/layouts/header.php';
        require_once __DIR__ . '/app/Views/home.php';
        require_once __DIR__ . '/app/Views/layouts/footer.php';
        break;

    case 'login':
        require_once __DIR__ . '/app/Views/layouts/header.php';
        require_once __DIR__ . '/app/Views/login.php';
        require_once __DIR__ . '/app/Views/layouts/footer.php';
        break;

    case 'processar_login':
        \App\Controllers\AuthController::login();
        break;

    case 'logout':
        \App\Controllers\AuthController::logout();
        break;

    // NOVAS ROTAS DO CRUD (CRIAR)
    case 'cadastrar_baterista':
        require_once __DIR__ . '/app/Views/layouts/header.php';
        require_once __DIR__ . '/app/Views/cadastrar_baterista.php';
        require_once __DIR__ . '/app/Views/layouts/footer.php';
        break;

    case 'processar_cadastro':
        \App\Controllers\BateristaController::cadastrar();
        break;

    // NOVA ROTA DO CRUD (APAGAR)
    case 'deletar_baterista':
        \App\Controllers\BateristaController::deletar();
        break;
// ROTAS DO CRUD (EDITAR)
    case 'editar_baterista':
        require_once __DIR__ . '/app/Views/layouts/header.php';
        require_once __DIR__ . '/app/Views/editar_baterista.php';
        require_once __DIR__ . '/app/Views/layouts/footer.php';
        break;

    case 'processar_edicao':
        \App\Controllers\BateristaController::editar();
        break;


    default:
        http_response_code(404);
        echo "<div style='text-align:center; padding: 50px; font-family: sans-serif;'>";
        echo "<h1>Erro 404</h1>";
        echo "<p>Página não encontrada no universo DrumHero.</p>";
        echo "<a href='index.php?rota=home'>Voltar ao Início</a>";
        echo "</div>";
        break;
}