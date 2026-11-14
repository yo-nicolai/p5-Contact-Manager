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
}
