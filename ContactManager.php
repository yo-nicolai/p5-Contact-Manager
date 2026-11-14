<?php
require_once 'DBConnect.php';

class ContactManager
{
    public function findAll(): array
    {
        $pdo = (new DBConnect())->getPDO();
        $sql = 'SELECT * FROM contact';
        $result = $pdo->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
