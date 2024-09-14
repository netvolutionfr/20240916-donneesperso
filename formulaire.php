<?php
// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$motdepasse = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);
$adresse = $_POST['adresse'];
$adresse2 = $_POST['adresse2'];
$ville = $_POST['ville'];
$codepostal = $_POST['codepostal'];
$accept = isset($_POST['accept']) ? 1 : 0;

// Connexion à la base de données
require 'config.php';
global $db_host, $db_name, $db_user, $db_pass;
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
// Préparation de la requête
$query = $pdo->prepare('INSERT INTO formulaire (nom, prenom, email, motdepasse, adresse, adresse2, ville, codepostal, accept) VALUES (:nom, :prenom, :email, :motdepasse, :adresse, :adresse2, :ville, :codepostal, :accept)');
$query->bindParam(':nom', $nom);
$query->bindParam(':prenom', $prenom);
$query->bindParam(':email', $email);
$query->bindParam(':motdepasse', $motdepasse);
$query->bindParam(':adresse', $adresse);
$query->bindParam(':adresse2', $adresse2);
$query->bindParam(':ville', $ville);
$query->bindParam(':codepostal', $codepostal);
$query->bindParam(':accept', $accept);

// Exécution de la requête
$query->execute();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire de saisie</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container">
    <div class="row">
        <h1>Formulaire de saisie</h1>
        <p>Merci, nous vous recontacterons très prochainement.</p>
        <p>Allez maintenant vérifier dans la base de données que les informations du formulaire ont bien été enregistrées.</p>
    </div>
</div>
</body>
</html>