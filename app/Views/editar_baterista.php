<?php
if (!isset($_SESSION['usuario_id'])) {
    echo "<div style='text-align:center; padding: 50px;'><h2>Acesso Negado</h2></div>";
    exit;
}

// Busca os dados da lenda pelo ID passado no URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
require_once __DIR__ . '/../Models/Baterista.php';
$batera = \App\Models\Baterista::buscarPorId($id);

if (!$batera) {
    echo "<div style='text-align:center; padding: 50px;'><h2>Lenda não encontrada.</h2></div>";
    exit;
}
?>

<section class="section-padding" style="min-height: 60vh; display: flex; align-items: center; justify-content: center;">
    <div class="contato-container" style="max-width: 600px; width: 100%;">
        <div class="section-header">
            <span class="section-badge">PAINEL ADMIN</span>
            <h2 class="section-title">Editar Lenda</h2>
            <p class="section-desc">Atualize os dados de <?php echo htmlspecialchars($batera['nome']); ?>.</p>
        </div>

        <form action="index.php?rota=processar_edicao" method="post" class="vintage-form">
            <!-- Campo oculto fundamental para o sistema saber QUAL registo atualizar -->
            <input type="hidden" name="id" value="<?php echo $batera['id']; ?>">
            
            <div class="form-grupo">
                <label for="nome">Nome do Baterista</label>
                <input type="text" id="nome" name="nome" class="form-controle" value="<?php echo htmlspecialchars($batera['nome']); ?>" required>
            </div>
            <div class="form-grupo">
                <label for="banda">Banda Principal</label>
                <input type="text" id="banda" name="banda" class="form-controle" value="<?php echo htmlspecialchars($batera['banda']); ?>" required>
            </div>
            <div class="form-grupo">
                <label for="equipamento">Equipamento de Destaque</label>
                <input type="text" id="equipamento" name="equipamento" class="form-controle" value="<?php echo htmlspecialchars($batera['equipamento_destaque']); ?>" required>
            </div>
            <div class="form-grupo">
                <label for="descricao">Descrição / História</label>
                <textarea id="descricao" name="descricao" class="form-controle" rows="4" required><?php echo htmlspecialchars($batera['descricao']); ?></textarea>
            </div>
            <button type="submit" class="btn-vintage btn-primario btn-bloco">SALVAR ALTERAÇÕES</button>
        </form>
    </div>
</section>