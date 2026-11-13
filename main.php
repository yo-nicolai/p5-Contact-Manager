<?php
require_once 'DBConnect.php';

$dbConnect = new DBConnect();
var_dump($dbConnect->getPDO());

while (true) {
    $line = readline("Entrez votre commande : ");
    echo "Vous avez saisi : $line\n";
    if ($line === "list") {
        echo "affichage de la liste ";
    }
}
