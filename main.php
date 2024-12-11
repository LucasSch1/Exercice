<?php
require_once 'Command.php';

while (true) {
    $pattern = '/^detail (.*)$/'; // Pattern de détails d’un élément avec un ID numérique.
    $patternCreate = '/^create (.*), (.*), (.*)$/'; //Pattern de création d'un élément avec un nom, une description et un nombre entier.
    $patternModify = '/^modify (.*), (.*), (.*), (.*)$/'; //Pattern de modification d'un élément en indiquant un ID, deux noms et un nombre entier.
    $patternDelete = '/^delete (.*)$/'; //Pattern de suppression d'un élément avec un ID numérique
    $line = readline("Entrez votre commande (help, list, detail, create, delete, quit):");
    $command = new Command();

    if ($line == "help"){
        $command->help();
        continue;
    }


    if ($line == "list"){
        $command->list();
        continue;
    }

    if (preg_match($pattern, $line, $matches)) {
        $command->detail($matches[1]);
        continue;
    }

    if (preg_match($patternCreate, $line, $matches)) {
        $name = $matches[1];
        $email = $matches[2];
        $phone_number = $matches[3];
        $command->create($name, $email, $phone_number);
        continue;
    }


    if (preg_match($patternModify, $line, $matches)) {
        $command->modify($matches[1], $matches[2], $matches[3], $matches[4]);
        continue;
    }

    if (preg_match($patternDelete, $line, $matches)) {
        $command->delete($matches[1]);
        continue;
    }

    if ($line == "quit"){
        break;
    }

    echo "Commande non valide : $line\n";

}
