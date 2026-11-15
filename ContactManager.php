<?php
require_once 'DBConnect.php';
require_once 'Contact.php';

class ContactManager
{
    public function findAll(): array
    {
        $pdo = (new DBConnect())->getPDO();
        $sql = 'SELECT * FROM contact';
        $result = $pdo->query($sql);

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
        $pdo = (new DBConnect())->getPDO();
        $sql = 'SELECT * FROM contact WHERE id = :id';
        $result = $pdo->prepare($sql);
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
        $pdo = (new DBConnect())->getPDO();
        $sql = 'INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)';
        $result = $pdo->prepare($sql);
        $result->execute([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phoneNumber,
        ]);

        $id = (int) $pdo->lastInsertId();
        return $this->findById($id);
    }

    public function delete(int $id): bool
    {
        $pdo = (new DBConnect())->getPDO();
        $sql = 'DELETE FROM contact WHERE id = :id';
        $result = $pdo->prepare($sql);
        $result->execute(['id' => $id]);
        return $result->rowCount() > 0;
    }
}
