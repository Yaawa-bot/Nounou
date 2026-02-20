<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "nanny";

$conn = mysqli_connect("localhost","root","","nanny");

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

//traitement du formulaire d'inscription 
$message = "";
$error = "";

if ($_POST) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // vérifier si email existe déjà
    $check_email = mysqli_query($conn, "SELECT * FROM parents WHERE email='$email'");
    if (mysqli_num_rows($check_email) > 0) {
        $error = "Cet email existe déjà !";
    } else {
        // hacher le password et inserer 
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO parents (nom, prenom, lieu_hab, profession, age, tel, password, email) VALUES ('".mysqli_real_escape_string($conn, $_POST['nom'])."','".mysqli_real_escape_string($conn, $_POST['prenom'])."','".mysqli_real_escape_string($conn, $_POST['lieu_hab'])."','".mysqli_real_escape_string($conn, $_POST['profession'])."',".$_POST['age'].",'".mysqli_real_escape_string($conn, $_POST['tel'])."','$password_hash','$email')";

        if (mysqli_query($conn, $sql)) {
            $message = "Inscription réussie !!!";
        } else { 
            $error = "Erreur :" . mysqli_error($conn);
        }
    }
}
?>