<?php
require_once 'Command.php';

$command = new Command();

while (true) {
    $line = readline("Entrez votre commande : ");
    if ($line === "list") {
        $command->list();
    } else if (preg_match('/^detail (\d+)$/', $line, $matches)) {
        $command->detail($matches[1]);
    } else if ($line === "quit") {
        break;
    }
}
