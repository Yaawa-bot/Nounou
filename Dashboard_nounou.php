<?php

include 'db.php';

//connexion nn
if (!isset($_SESSION[ 'nounou_id'])) {
    header("Location: inscription_nounou.php");
    exit();
}

$nounou_id = $_SESSION['nounou_id'];

//Receuil des infos nn
$stmt = $pdo->prepare("SELECT nom, prenom, niveau_scolaire, lieu_residence, telephone, tarif_horaire, sexe, competences FROM nounous WHERE id = ?");
$stmt->execute([$nounou_id]);
$nounou = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$nounou) {
    die("Profil introuvable.");
}

//count des convers et demandes
$stmt = $pdo->prepare("SELECT COUNT(*) as count FROM conversations WHERE nounou_id = ? AND status = 'active'");
$stmt->execute([$nounou_id]);
$nb_conversations = $stmt->fetch()['count'];//conversations n'existe pas dans la BDD donc le conteur sera à 0   

$stmt = $pdo->prepare("SELECT COUNT(*) as count FROM demandes WHERE nounou_id = ? AND status = 'active'");
$stmt->execute([$nounou_id]);
$nb_demandes = $stmt->fetch()['count'];//demandes n'existe pas dans la BDD donc le conteur sera à 0