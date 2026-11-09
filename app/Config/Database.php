<?php
namespace App\Config;

use PDO;
use PDOException;

class Database {
    private static $conexao = null;

    public static function getConexao() {
        // Se a conexão ainda não existe, nós a criamos
        if (self::$conexao === null) {
            try {
                // Lê as variáveis do arquivo .env que criamos na raiz
                $envPath = __DIR__ . '/../../.env';
                $env = parse_ini_file($envPath);

                if (!$env) {
                    throw new \Exception("Arquivo .env não encontrado ou inválido.");
                }

                $host = $env['DB_HOST'];
                $dbname = $env['DB_NAME'];
                $user = $env['DB_USER'];
                $pass = $env['DB_PASS'];

                // DSN (Data Source Name)
                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
                
                // Configurações vitais de segurança do PDO
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lança exceções em caso de erro
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Retorna dados como array associativo
                    PDO::ATTR_EMULATE_PREPARES => false, // Desliga a emulação (Garante proteção real contra SQL Injection)
                ];

                self::$conexao = new PDO($dsn, $user, $pass, $options);

            } catch (PDOException $e) {
                // Em produção, nunca mostramos o erro real para o usuário final
                error_log("Erro de banco de dados: " . $e->getMessage());
                die("Falha na conexão com o banco de dados. Tente novamente mais tarde.");
            } catch (\Exception $e) {
                die($e->getMessage());
            }
        }
        
        return self::$conexao;
    }
}