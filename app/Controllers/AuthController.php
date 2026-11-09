<?php
namespace App\Controllers;

use App\Models\Usuario;
use App\Config\Logger; // NOVO: Importa o Logger

class AuthController {
    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // NOVO: Trava de Segurança CSRF (Requisito 6 do edital)
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                Logger::registrar('FALHA_SEGURANCA', "Tentativa de CSRF bloqueada no login.");
                die("Erro de segurança CSRF detectado.");
            }

            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'];

            $usuario = Usuario::buscarPorEmail($email);

            if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
                session_regenerate_id(true);
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_perfil'] = $usuario['perfil'];

                // REQUISITO 10: Log de login bem-sucedido
                Logger::registrar('LOGIN_SUCESSO', "O usuario {$email} iniciou sessao.");

                header("Location: index.php?rota=home");
                exit;
            } else {
                // REQUISITO 10: Log de falha de autenticacao
                Logger::registrar('LOGIN_FALHA', "Tentativa de login falhou para o email {$email}.");

                $_SESSION['erro_login'] = "Credenciais inválidas. Tente novamente.";
                header("Location: index.php?rota=login");
                exit;
            }
        }
    }
// ... resto do código de logout

    public static function logout() {
        // Destrói todas as variáveis e a própria sessão
        session_unset();
        session_destroy();
        header("Location: index.php?rota=home");
        exit;
    }
}