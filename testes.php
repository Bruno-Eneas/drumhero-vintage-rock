<?php
// Carrega as dependências necessárias
require_once __DIR__ . '/app/Config/Database.php';
require_once __DIR__ . '/app/Models/Usuario.php';
require_once __DIR__ . '/app/Models/Baterista.php';

echo "<div style='font-family: sans-serif; padding: 20px; background: #1a1a1a; color: #fff; max-width: 600px; margin: 0 auto; border-radius: 8px;'>";
echo "<h2 style='color: #d4af37;'>🥁 DrumHero - Execução de Testes Automatizados</h2>";
echo "<hr style='border-color: #333;'>";

$testes_passaram = 0;
$total_testes = 5;

// TESTE 1: Conexão com a Base de Dados (Caso Válido)
try {
    $db = \App\Config\Database::getConexao();
    echo "<p style='color: #4CAF50;'>✔ <b>Teste 1 (Válido):</b> Conexão PDO com a base de dados bem-sucedida.</p>";
    $testes_passaram++;
} catch (Exception $e) {
    echo "<p style='color: #ff4d4d;'>✖ <b>Teste 1 falhou:</b> " . $e->getMessage() . "</p>";
}

// TESTE 2: Buscar Utilizador Válido (Caso Válido)
$usuario = \App\Models\Usuario::buscarPorEmail('admin@drumhero.com');
if ($usuario) {
    echo "<p style='color: #4CAF50;'>✔ <b>Teste 2 (Válido):</b> Utilizador administrador encontrado na base de dados.</p>";
    $testes_passaram++;
} else {
    echo "<p style='color: #ff4d4d;'>✖ <b>Teste 2 falhou:</b> Utilizador não encontrado.</p>";
}

// TESTE 3: Buscar Utilizador Inexistente (Caso Inválido)
$usuario_invalido = \App\Models\Usuario::buscarPorEmail('hacker@dominio.com');
if (!$usuario_invalido) {
    echo "<p style='color: #4CAF50;'>✔ <b>Teste 3 (Inválido):</b> Utilizador inexistente rejeitado corretamente.</p>";
    $testes_passaram++;
} else {
    echo "<p style='color: #ff4d4d;'>✖ <b>Teste 3 falhou:</b> Falso positivo retornado.</p>";
}

// TESTE 4: Verificação de Hash de Palavra-passe (Caso Inválido)
$senha_errada = 'senha_falsa_123';
if ($usuario && !password_verify($senha_errada, $usuario['senha_hash'])) {
    echo "<p style='color: #4CAF50;'>✔ <b>Teste 4 (Inválido):</b> Palavra-passe incorreta bloqueada pelo password_verify().</p>";
    $testes_passaram++;
} else {
    echo "<p style='color: #ff4d4d;'>✖ <b>Teste 4 falhou:</b> Falha na verificação criptográfica.</p>";
}

// TESTE 5: Leitura do CRUD (Caso Válido)
$bateristas = \App\Models\Baterista::listarTodos();
if (is_array($bateristas)) {
    echo "<p style='color: #4CAF50;'>✔ <b>Teste 5 (Válido):</b> Model Baterista listou os registos corretamente (Array retornado).</p>";
    $testes_passaram++;
} else {
    echo "<p style='color: #ff4d4d;'>✖ <b>Teste 5 falhou:</b> Erro ao listar lendas.</p>";
}

echo "<hr style='border-color: #333;'>";
echo "<h3>Resultado Final: <span style='color: " . ($testes_passaram === $total_testes ? '#4CAF50' : '#ff4d4d') . "'>$testes_passaram / $total_testes testes passaram.</span></h3>";
echo "</div>";