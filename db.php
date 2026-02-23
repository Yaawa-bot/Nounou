<?php

// Information de connexion à la base de données
$host = 'localhost';
$dbname = 'nanny';
$username = 'root';
$password = '';


try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO(
        "mysql:host = $host ;dbname = $dbname ;charset=utf8",
        $username,
        $password
    );

    // Définir le mode d'erreur de PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}   catch (PDOException $e) {
    // Afficher un message d'erreur en cas de problème de connexion
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}