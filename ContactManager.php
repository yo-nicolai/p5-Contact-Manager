<?php
require_once 'DBConnect.php';
require_once 'Contact.php';

// Gère toutes les requêtes à la table contact et transforme les résultats en objets Contact
class ContactManager
{
    private PDO $db;

    // Crée la connexion une seule fois, à la création du manager
    public function __construct()
    {
        $this->db = (new DBConnect())->getPDO();
    }

    // Renvoie tous les contacts sous forme de tableau d'objets Contact
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

    // Renvoie le contact correspondant à l'id ou null si inexistant
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

    // Ajoute un contact dans la base et renvoie le contact créé
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

    // Supprime le contact correspondant à l'id. Renvoie true si une ligne a été supprimée
    public function delete(int $id): bool
    {
        $sql = 'DELETE FROM contact WHERE id = :id';
        $result = $this->db->prepare($sql);
        $result->execute(['id' => $id]);
        return $result->rowCount() > 0;
    }
}
