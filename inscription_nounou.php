<?php
include 'db.php';

if($_SERVER['REQUEST_METHOD']== 'POST' && isset ($_POST['submit'])) {

$nom=$_POST['nom'];
$prenom =$POST['prenom'];
$age =$POST['age'];
$sexe =$POST['sexe'];
$telephone =$POST['telephone'];
// Récupérer les compétences sélectionnées et les convertir en chaîne de caractères
$competences =isset($_POST['competences']) ? implode(',', $_POST['competences']) : "";
$NiveauScolaire =$POST['NiveauScolaire'];
$LieudeResidence =$POST['LieuResidence'];
$TarifHoraire =$POST['TarifHoraire'];
$motDePasse =$_POST['motDePasse'];
$confirmerMotDePasse =$_POST['confirmerMotDePasse'];


if($motDePasse !==$confirmerMotDePasse) {
    die("les mots de passe ne sont pas identiques");
}

//Validation des compétences (au moins une doit être sélectionnée)
if (empty($competences)) {
    die("Veuillez sélectionner au moins une compétence.");
}

$hashed_password =password_hash($motDePasse, PASSWORD_DEFAULT);


$sql = "INSERT INTO nounous (nom, prenom, age, sexe, telephone, competences, niveauScolaire, lieuResidence, tarifhoraire, motDePasse) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt =$pdo->prepare($sql);


        $stmt->execute ([
            $nom,
            $prenom,
            $age,
            $sexe,
            $telephone,
            $competences,
            $NiveauScolaire,
            $LieudeResidence,
            $TarifHoraire,
            $hashed_password
        ]);

        echo "inscription réussie !!";

}else {
    echo "eéchec de l'inscription";
}
?>