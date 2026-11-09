<?php
namespace App\Controllers;

use App\Models\Baterista;
use App\Config\Logger; // Importação da classe de Log

class BateristaController {
    
    // 1. Método para CRIAR um novo baterista
    public static function cadastrar() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?rota=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $banda = filter_input(INPUT_POST, 'banda', FILTER_SANITIZE_STRING);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
            $equipamento = filter_input(INPUT_POST, 'equipamento', FILTER_SANITIZE_STRING);
            $usuario_id = $_SESSION['usuario_id'];

            if (Baterista::cadastrar($nome, $banda, $descricao, $equipamento, $usuario_id)) {
                // REQUISITO 10: Log de criação de entidade
                Logger::registrar('ENTIDADE_CRIADA', "Novo baterista cadastrado: {$nome}");
                
                $_SESSION['mensagem_sucesso'] = "Nova lenda adicionada com sucesso!";
                header("Location: index.php?rota=home");
                exit;
            } else {
                // REQUISITO 10: Log de erro interno
                Logger::registrar('ERRO_INTERNO', "Falha ao cadastrar baterista: {$nome}");
                echo "Erro ao guardar o registo na base de dados.";
            }
        }
    }

    // 2. Método para APAGAR um baterista
    public static function deletar() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?rota=login");
            exit;
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            Baterista::deletar($id);
            // Log opcional de exclusão
            Logger::registrar('ENTIDADE_APAGADA', "Baterista ID {$id} foi removido do acervo.");
        }
        
        header("Location: index.php?rota=home");
        exit;
    }

    // 3. Método para EDITAR um baterista
    public static function editar() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?rota=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $banda = filter_input(INPUT_POST, 'banda', FILTER_SANITIZE_STRING);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
            $equipamento = filter_input(INPUT_POST, 'equipamento', FILTER_SANITIZE_STRING);

            if ($id && Baterista::atualizar($id, $nome, $banda, $descricao, $equipamento)) {
                // Log opcional de edição
                Logger::registrar('ENTIDADE_ATUALIZADA', "Baterista ID {$id} ({$nome}) foi atualizado.");
                
                header("Location: index.php?rota=home");
                exit;
            } else {
                Logger::registrar('ERRO_INTERNO', "Falha ao atualizar baterista ID {$id}");
                echo "Erro ao atualizar o registo.";
            }
        }
    }
}