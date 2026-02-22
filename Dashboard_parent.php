<?php

include 'db.php';

//connexion du parent
if (!isset($_SESSION[ 'parent_id'])) {
    header("Location: inscription_parent.php");
    exit();
}

$parent_id = $_SESSION['parent_id'];


//Receuil des infos parent
$stmt = $pdo->prepare("SELECT nom, prenoms, age, telephone, email, adresse, profession, password FROM parents WHERE id = ?");
$stmt->execute([$parent_id]);
$parent = $stmt->fetch(PDO::FETCH_ASSOC);

//count des convers
$stmt = $pdo->prepare("SELECT COUNT(*) as count FROM conversations WHERE parent_id = ? AND status = 'active'");
$stmt->execute([$parent_id]);
$nb_conversations = $stmt->fetch()['count'];//conversations n'existe pas dans la BDD donc le conteur sera à 0

//count enfants 

$stmt = $pdo->prepare("SELECT COUNT(*) as count FROM enfant WHERE parent_id = ?");
$stmt->execute([$parent_id]);
$nb_enfants = $stmt->fetch()['count'];


include 'inscription_parent.php';