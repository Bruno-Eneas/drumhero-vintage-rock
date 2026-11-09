<?php
namespace App\Config;

class Logger {
    public static function registrar($acao, $mensagem) {
        // Define o fuso horário para o Brasil (importante para o timestamp)
        date_default_timezone_set('America/Sao_Paulo');
        
        $data = date('Y-m-d H:i:s');
        $log = "[$data] [$acao] $mensagem" . PHP_EOL;
        
        // Define o caminho para a pasta de logs na raiz do projeto
        $caminho_pasta = __DIR__ . '/../../logs';
        $arquivo = $caminho_pasta . '/app.log';
        
        // Cria a pasta automaticamente se ela não existir
        if (!is_dir($caminho_pasta)) {
            mkdir($caminho_pasta, 0777, true);
        }
        
        // Escreve a mensagem no arquivo sem apagar o que já estava lá (FILE_APPEND)
        file_put_contents($arquivo, $log, FILE_APPEND);
    }
}