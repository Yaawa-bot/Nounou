<?php

include 'db.php';

//connexion nn
if (!isset($_SESSION[ 'nounou_id'])) {
    header("Location: inscription_nounou.php");
    exit();
}

//Connexion à la db
try {
    $pdo = new PDO("mysql:host=$host;dbname=nanny;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Définir le mode d'erreur de PDO sur Exception
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage()); 
}

// Récupérer les informations de nounou connecté
$stmt = $pdo->prepare("SELECT nom, prenoms, age, telephone, email, adresse, profession, password FROM nounous WHERE id = ?");
$stmt->execute([$_SESSION['nounou_id']]);
$nounou = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$parent) {
    die("Parent non trouvé.");
}

?>