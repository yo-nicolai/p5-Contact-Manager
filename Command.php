<?php
require_once 'ContactManager.php';

class Command
{
    // Affiche la liste de tous les contacts
    public function list(): void
    {
        $contactManager = new ContactManager();
        $contacts = $contactManager->findAll();
        foreach ($contacts as $contact) {
            echo $contact->toString() . "\n";
        }
    }

    // Affiche les détails d'un contact spécifique par son ID
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

    // Crée un nouveau contact
    public function create(string $name, string $email, string $phoneNumber): void
    {
        $contactManager = new ContactManager();
        $contact = $contactManager->create($name, $email, $phoneNumber);
        echo "Contact créé : " . $contact->toString() . "\n";
    }

    // Supprime un contact par son ID
    public function delete(int $id): void
    {
        $contactManager = new ContactManager();

        if ($contactManager->delete($id)) {
            echo "Contact $id supprimé\n";
        } else {
            echo "Aucun contact avec l'id $id\n";
        }
    }

    // Affiche la liste des commandes disponibles
    public function help(): void
    {
        echo "Commandes disponibles :\n";
        echo "  list                          : affiche tous les contacts\n";
        echo "  detail [id]                   : affiche un contact\n";
        echo "  create [nom], [email], [tel]  : crée un contact\n";
        echo "  delete [id]                   : supprime un contact\n";
        echo "  help                          : affiche cette aide\n";
        echo "  quit                          : quitte le programme\n";
    }
}
