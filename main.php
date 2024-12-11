<?php
require_once 'Command.php';

while (true) {
    $pattern = '/^detail (\d+)$/';
    $patternCreate = '/^create ([^,]+),\s*([^,]+),\s*(\d+)$/';
    $patternModify = '/^modify (\d+),\s*([^,]+),\s*([^,]+),\s*(\d+)$/';
    $patternDelete = '/^delete (\d+)$/';
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
