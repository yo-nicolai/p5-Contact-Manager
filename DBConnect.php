<?php


class DBConnect
{
    public function getPDO(): PDO
    {
        try {
            return new PDO(
                'mysql:host=localhost;dbname=contact_manager;charset=utf8mb4',
                'root',
                '',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
