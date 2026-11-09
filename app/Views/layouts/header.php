<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DrumHero - Vintage Rock Experience</title>
    
    <!-- Meta tag de descrição para SEO -->
    <meta name="description" content="Catálogo interativo sobre a história, técnicas e os maiores bateristas do rock clássico. Acervo focado em acessibilidade e design responsivo.">
        
    <!-- Tipografia: Montserrat & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,800;1,400&display=swap" rel="stylesheet">
    
    <!-- Ícones FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Folha de Estilo Externa -->
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

    <!-- CABEÇALHO SEMÂNTICO COM NAVEGAÇÃO -->
    <header class="main-header">
        <div class="logo">
            <i class="fa-solid fa-drum logo-icon" aria-hidden="true"></i>
            <span>DRUM<strong>HERO</strong></span>
        </div>
        <nav aria-label="Navegação Principal">
            <ul class="nav-links">
                <li><a href="index.php?rota=home#hero">Início</a></li>
                <li><a href="index.php?rota=home#lendas">Lendas</a></li>
                <li><a href="index.php?rota=home#tecnicas">Técnicas</a></li>
                <li><a href="index.php?rota=home#contato">Contato</a></li>
                
                <!-- Lógica de Controle de Acesso -->
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <!-- O que aparece quando o Administrador está logado -->
                    <li><a href="index.php?rota=cadastrar_baterista" style="color: #d4af37; font-weight: bold;">+ Nova Lenda</a></li>
                    <li><span style="color: #fff; margin-right: 15px; margin-left: 15px;">Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></span></li>
                    <li><a href="index.php?rota=logout" style="color: #ff4d4d; border: 1px solid #ff4d4d; padding: 5px 15px; border-radius: 5px; text-decoration: none;">Sair</a></li>
                <?php else: ?>
                    <!-- O que aparece para Visitantes -->
                    <li><a href="index.php?rota=login" style="color: #d4af37; border: 1px solid #d4af37; padding: 5px 15px; border-radius: 5px; text-decoration: none;">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    
    <!-- ABERTURA DO MAIN GERAL -->
    <main></main>