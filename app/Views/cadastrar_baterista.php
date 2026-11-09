<?php
// Barreira de segurança na própria View: se não estiver logado, não vê o formulário
if (!isset($_SESSION['usuario_id'])) {
    echo "<div style='text-align:center; padding: 50px;'><h2>Acesso Negado</h2></div>";
    exit;
}
?>

<section class="section-padding" style="min-height: 60vh; display: flex; align-items: center; justify-content: center;">
    <div class="contato-container" style="max-width: 600px; width: 100%;">
        <div class="section-header">
            <span class="section-badge">PAINEL ADMIN</span>
            <h2 class="section-title">Adicionar Nova Lenda</h2>
            <p class="section-desc">Registe um novo baterista no acervo da base de dados.</p>
        </div>

        <form action="index.php?rota=processar_cadastro" method="post" class="vintage-form">
            <div class="form-grupo">
                <label for="nome">Nome do Baterista</label>
                <input type="text" id="nome" name="nome" class="form-controle" required>
            </div>
            <div class="form-grupo">
                <label for="banda">Banda Principal</label>
                <input type="text" id="banda" name="banda" class="form-controle" required>
            </div>
            <div class="form-grupo">
                <label for="equipamento">Equipamento de Destaque (Ex: Ludwig Vistalite)</label>
                <input type="text" id="equipamento" name="equipamento" class="form-controle" required>
            </div>
            <div class="form-grupo">
                <label for="descricao">Descrição / História</label>
                <textarea id="descricao" name="descricao" class="form-controle" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn-vintage btn-primario btn-bloco">SALVAR REGISTO</button>
        </form>
    </div>
</section>