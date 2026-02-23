<?php
include 'db.php';

// Vérifier si la requête POST a été envoyée et si le bouton de soumission a été cliqué
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenoms'];
    $age = $_POST['age'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $prfession = $_POST['profession'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


// Vérifier si les mots de passe correspondent
if ($password !== $confirm_password) {
    die("Les mots de passe ne correspondent pas.");
}

// Sécuriser le mot de passe en le hachant
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Préparer la requête d'insertion
$sql = "INSERT INTO parents (nom, prenoms, age, telephone, email, adresse, profession, password) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Préparer la requête avec PDO
        $stmt = $pdo->prepare($sql);    

        // Exécuter la requête avec les données du formulaire
        $stmt->execute([
            $nom,
            $prenom, 
            $age, 
            $telephone, 
            $email, 
            $adresse, 
            $prfession, 
            $hashed_password
        ]);

        echo "Inscription réussie !";

    } else {
        echo "Aucune donnée reçue.";
    }
?>