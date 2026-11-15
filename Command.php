<?php
require_once 'ContactManager.php';

class Command
{
    private ContactManager $contactManager;

    // Crée le manager une seule fois, à la création de Command
    public function __construct()
    {
        $this->contactManager = new ContactManager();
    }

    // Affiche la liste de tous les contacts
    public function list(): void
    {
        $contacts = $this->contactManager->findAll();
        foreach ($contacts as $contact) {
            echo $contact->toString() . "\n";
        }
    }

    // Affiche les détails d'un contact spécifique par son ID
    public function detail(int $id): void
    {
        $contact = $this->contactManager->findById($id);

        if (!$contact) {
            echo "Aucun contact avec l'id $id\n";
            return;
        }

        echo $contact->toString() . "\n";
    }

    // Crée un nouveau contact
    public function create(string $name, string $email, string $phoneNumber): void
    {
        $contact = $this->contactManager->create($name, $email, $phoneNumber);
        echo "Contact créé : " . $contact->toString() . "\n";
    }

    // Supprime un contact par son ID
    public function delete(int $id): void
    {
        if ($this->contactManager->delete($id)) {
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
