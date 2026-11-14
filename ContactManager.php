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
}
