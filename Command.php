<?php
require_once 'ContactManager.php';

class Command
{
    public function list(): void
    {
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();
        foreach ($contacts as $contact) {
            echo $contact->toString() . "\n";
        }
    }

    public function detail(int $id): void
    {
        $contactManager = new ContactManager();
        $contact = $contactManager->findById($id);

        if (!$contact) {
            echo "Aucun contact avec l'id $id\n";
            return;
        }

        echo $contact->toString() . "\n";
    }
}
