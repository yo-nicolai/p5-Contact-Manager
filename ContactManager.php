<?php
require_once 'DBConnect.php';
require_once 'Contact.php';

class ContactManager
{
    private PDO $db;

    // Crée la connexion une seule fois, à la création du manager
    public function __construct()
    {
        $this->db = (new DBConnect())->getPDO();
    }
    
    public function findAll(): array
    {
        $sql = 'SELECT * FROM contact';
        $result = $this->db->query($sql);

        $contacts = [];
        foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
            $contact = new Contact();
            $contact->setId($ligne['id']);
            $contact->setName($ligne['name']);
            $contact->setEmail($ligne['email']);
            $contact->setPhoneNumber($ligne['phone_number']);
            $contacts[] = $contact;
        }
        return $contacts;
    }

    public function findById(int $id): ?Contact
    {
        $sql = 'SELECT * FROM contact WHERE id = :id';
        $result = $this->db->prepare($sql);
        $result->execute(['id' => $id]);
        $ligne = $result->fetch(PDO::FETCH_ASSOC);

        if (!$ligne) {
            return null;
        }

        $contact = new Contact();
        $contact->setId($ligne['id']);
        $contact->setName($ligne['name']);
        $contact->setEmail($ligne['email']);
        $contact->setPhoneNumber($ligne['phone_number']);
        return $contact;
    }

    public function create(string $name, string $email, string $phoneNumber): ?Contact
    {
        $sql = 'INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)';
        $result = $this->db->prepare($sql);
        $result->execute([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phoneNumber,
        ]);

        $id = (int) $this->db->lastInsertId();
        return $this->findById($id);
    }

    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM contact WHERE id = :id';
        $result = $this->db->prepare($sql);
        $result->execute(['id' => $id]);
        return $result->rowCount() > 0;
    }
}
