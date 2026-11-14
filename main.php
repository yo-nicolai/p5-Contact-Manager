<?php
require_once 'ContactManager.php';

while (true) {
    $line = readline("Entrez votre commande : ");

    if ($line === "list") {
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();
        foreach ($contacts as $contact) {
            echo $contact->toString() . "\n";
        }
    }
}
