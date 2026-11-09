-- Script de Inicialização do Banco de Dados: DrumHero
-- Criação do banco de dados com suporte a caracteres especiais (UTF-8)
CREATE DATABASE IF NOT EXISTS drumhero_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE drumhero_db;

-- 1. Tabela de Usuários (Controle de Acesso e Autenticação)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    perfil ENUM('admin', 'visitante') NOT NULL DEFAULT 'visitante',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabela de Bateristas (Entidade Principal do Domínio)
CREATE TABLE bateristas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    banda VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    equipamento_destaque VARCHAR(100) NOT NULL,
    usuario_id INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_baterista_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE RESTRICT
);

-- Inserindo um usuário Administrador padrão para testes
-- A senha abaixo é 'Admin123!' criptografada com password_hash() (bcrypt)
INSERT INTO usuarios (nome, email, senha_hash, perfil) 
VALUES (
    'Admin DrumHero', 
    'admin@drumhero.com', 
    '$2y$10$tZ2f20TcwF2S1/M.1/16H.5gG8E4R8Yx9r6Tq/aE6T6xG9/Q.t2/q', 
    'admin'
);