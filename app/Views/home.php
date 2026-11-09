<?php
// Carrega o modelo de Baterista para ir buscar os dados
require_once __DIR__ . '/../Models/Baterista.php';
$bateristas = \App\Models\Baterista::listarTodos();
?>

<section id="lendas" class="section-padding" style="background-color: #1a1a1a;">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">O ACERVO</span>
            <h2 class="section-title">Mestres do Ritmo</h2>
            <p class="section-desc">Explore as lendas que moldaram o som de gerações.</p>
        </div>

        <div class="lendas-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <?php if (empty($bateristas)): ?>
                <div style="grid-column: 1 / -1; text-align: center; color: #fff; padding: 40px; background: #2a2a2a; border-radius: 8px;">
                    <i class="fa-solid fa-drum" style="font-size: 3rem; color: #d4af37; margin-bottom: 20px;"></i>
                    <h3>Nenhuma lenda registada ainda.</h3>
                    <p>Utilize o painel de Administrador para adicionar o primeiro baterista!</p>
                </div>
            <?php else: ?>
                <!-- Loop para exibir cada baterista da base de dados -->
                <?php foreach ($bateristas as $batera): ?>
                    <div class="lenda-card" style="background: #2a2a2a; padding: 20px; border-radius: 8px; border-bottom: 3px solid #d4af37;">
                        <h3 style="color: #d4af37; margin-bottom: 10px;"><?php echo htmlspecialchars($batera['nome']); ?></h3>
                        <h4 style="color: #fff; margin-bottom: 15px; font-size: 0.9rem;">
                            <i class="fa-solid fa-music" style="margin-right: 5px; color: #aaa;"></i> <?php echo htmlspecialchars($batera['banda']); ?>
                        </h4>
                        <p style="color: #ccc; font-size: 0.9rem; line-height: 1.6; margin-bottom: 15px;">
                            <?php echo htmlspecialchars($batera['descricao']); ?>
                        </p>
                        <div style="background: #111; padding: 10px; border-radius: 4px; font-size: 0.8rem; color: #aaa; margin-bottom: 15px;">
                            <strong style="color: #fff;">Equipamento:</strong> <?php echo htmlspecialchars($batera['equipamento_destaque']); ?>
                        </div>
                        
                        <!-- Botões de Ação do CRUD (Visíveis apenas para Admin logado) -->
                        <?php if (isset($_SESSION['usuario_id'])): ?>
                            <div style="display: flex; gap: 10px; border-top: 1px solid #444; padding-top: 15px;">
                                <a href="index.php?rota=editar_baterista&id=<?php echo $batera['id']; ?>" style="color: #d4af37; text-decoration: none; font-size: 0.85rem; border: 1px solid #d4af37; padding: 5px 10px; border-radius: 4px;">Editar</a>
                                <a href="index.php?rota=deletar_baterista&id=<?php echo $batera['id']; ?>" style="color: #ff4d4d; text-decoration: none; font-size: 0.85rem; border: 1px solid #ff4d4d; padding: 5px 10px; border-radius: 4px;" onclick="return confirm('Tem certeza que deseja apagar esta lenda do acervo?');">Apagar</a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>