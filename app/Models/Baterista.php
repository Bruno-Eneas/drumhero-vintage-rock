<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class Baterista {
    // Método para ler todos os bateristas (Usamos na home)
    public static function listarTodos() {
        $db = Database::getConexao();
        $stmt = $db->query("SELECT * FROM bateristas ORDER BY criado_em DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para inserir um novo baterista na base de dados
    public static function cadastrar($nome, $banda, $descricao, $equipamento, $usuario_id) {
        $db = Database::getConexao();
        $stmt = $db->prepare("INSERT INTO bateristas (nome, banda, descricao, equipamento_destaque, usuario_id) VALUES (:nome, :banda, :descricao, :equipamento, :usuario_id)");
        
        return $stmt->execute([
            'nome' => $nome,
            'banda' => $banda,
            'descricao' => $descricao,
            'equipamento' => $equipamento,
            'usuario_id' => $usuario_id
        ]);
    }

    // Método para apagar um baterista (NOVO)
    public static function deletar($id) {
        $db = Database::getConexao();
        $stmt = $db->prepare("DELETE FROM bateristas WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    // Busca os dados de um baterista específico para preencher o formulário
    public static function buscarPorId($id) {
        $db = Database::getConexao();
        $stmt = $db->prepare("SELECT * FROM bateristas WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualiza os dados gravados na base de dados
    public static function atualizar($id, $nome, $banda, $descricao, $equipamento) {
        $db = Database::getConexao();
        $stmt = $db->prepare("UPDATE bateristas SET nome = :nome, banda = :banda, descricao = :descricao, equipamento_destaque = :equipamento WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'nome' => $nome,
            'banda' => $banda,
            'descricao' => $descricao,
            'equipamento' => $equipamento
        ]);
    }
}