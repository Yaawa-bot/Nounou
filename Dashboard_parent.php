<?php

include 'db.php';

//connexion du parent
if (!isset($_SESSION[ 'parent_id'])) {
    header("Location: inscription.parent.html");
    exit();
}

//Connexion à la db
try {
    $pdo = new PDO("mysql:host=$host;dbname=nanny;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Définir le mode d'erreur de PDO sur Exception
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage()); 
}

// Récupérer les informations du parent connecté
$stmt = $pdo->prepare("SELECT nom, prenoms, age, telephone, email, adresse, profession, password FROM parents WHERE id = ?");
$stmt->execute([$parent_id]);
$parent = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$parent) {
    die("Parent non trouvé.");
}

?>