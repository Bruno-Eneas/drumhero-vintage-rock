<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class Usuario {
    public static function buscarPorEmail($email) {
        $db = Database::getConexao();
        // O :email é um parâmetro nomeado. O PDO trata a sanitização automaticamente.
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
}