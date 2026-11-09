<?php
// Gera um token aleatório único e salva na sessão se ainda não existir
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<section class="section-padding" style="min-height: 60vh; display: flex; align-items: center; justify-content: center;">
    <div class="contato-container" style="max-width: 400px; width: 100%;">
        <div class="section-header">
            <span class="section-badge">ÁREA SEGURA</span>
            <h2 class="section-title">Acesso Restrito</h2>
            <p class="section-desc">Faça login para gerenciar o acervo de lendas.</p>
        </div>

        <?php if(isset($_SESSION['erro_login'])): ?>
            <div style="background-color: rgba(255, 0, 0, 0.1); color: #ff4d4d; padding: 10px; border: 1px solid #ff4d4d; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                <?php 
                    echo $_SESSION['erro_login']; 
                    unset($_SESSION['erro_login']); 
                ?>
            </div>
        <?php endif; ?>

        <!-- O form está agora no sítio correto, dentro do container -->
        <form action="index.php?rota=processar_login" method="post" class="vintage-form">
            
            <!-- Comentar a linha abaixo para teste de CSRF -->
             <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>"> 
            
            <div class="form-grupo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-controle" placeholder="admin@drumhero.com" required>
            </div>
            <div class="form-grupo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" class="form-controle" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-vintage btn-primario btn-bloco">ENTRAR</button>
        </form>
    </div>
</section>