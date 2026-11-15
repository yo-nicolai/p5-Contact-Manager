<?php
require_once 'config.php';

// Se connecte à la base de données à partir des identifiants de config.php
class DBConnect
{
    // Renvoie l'objet PDO connecté à la base 
    public function getPDO(): PDO
    {
        try {
            return new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
                DB_USER,
                DB_PASS,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
