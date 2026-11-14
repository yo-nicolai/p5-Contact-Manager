<?php
require_once 'DBConnect.php';
require_once 'ContactManager.php';

$dbConnect = new DBConnect();
echo "Connexion à la bdd : \n";
var_dump($dbConnect->getPDO());

$contactManager = new ContactManager();
echo "Récupère les contacts : \n";
var_dump($contactManager->findAll());

while (true) {
    $line = readline("Entrez votre commande : ");
    echo "Vous avez saisi : $line\n";
    if ($line === "list") {
        echo "affichage de la liste ";
    }
}
