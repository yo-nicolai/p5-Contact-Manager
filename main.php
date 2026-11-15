<?php
require_once 'Command.php';

// Crée l'objet qui exécute les commandes
$command = new Command();

// Boucle infinie qui attend une commande la reconnaît et appelle la bonne méthode de Command
while (true) {
    $line = readline("Entrez votre commande : ");
    if ($line === "list") {
        $command->list();
    } else if (preg_match('/^detail (\d+)$/', $line, $matches)) {
        $command->detail($matches[1]);
    } else if (preg_match('/^delete (\d+)$/', $line, $matches)) {
        $command->delete($matches[1]);
    } else if (preg_match('/^create ([^,]+), ([^,]+), ([^,]+)$/', $line, $matches)) {
        $command->create($matches[1], $matches[2], $matches[3]);
    } else if ($line === "help") {
        $command->help();
    } else if ($line === "quit") {
        break;
    } else {
        echo "Commande inconnue. Tapez help pour voir les commandes.\n";
    }
}
