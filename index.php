<?php
// Connexion à la base de données
require 'config.php';
global $db_host, $db_name, $db_user, $db_pass;

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

// Vérification que la table "formulaire" existe
$query = $pdo->prepare('SHOW TABLES LIKE "formulaire"');

$query->execute();

if ($query->rowCount() === 0) {
    // Création de la table "formulaire"
    $query = $pdo->prepare('CREATE TABLE formulaire (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255),
        prenom VARCHAR(255),
        email VARCHAR(255),
        motdepasse VARCHAR(255),
        adresse VARCHAR(255),
        adresse2 VARCHAR(255),
        codepostal VARCHAR(255),
        ville VARCHAR(255),
        accept BOOLEAN
    )');

    $query->execute();
}
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
        <form class="row g-3" method="post" action="formulaire.php">
            <div class="col-md-6">
                <label for="inputPrenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" aria-label="Prénom" name="prenom" id="inputPrenom">
            </div>
            <div class="col-md-6">
                <label for="inputNom" class="form-label">Nom</label>
                <input type="text" class="form-control" aria-label="Nom" name="nom" id="inputNom">
            </div>
            <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" aria-label="Email" name="email" id="inputEmail">
            </div>
            <div class="col-md-6">
                <label for="inputPassword" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" aria-label="Mot de passe" name="motdepasse" id="inputPassword">
            </div>
            <div class="col-12">
                <label for="inputAddresse" class="form-label">Addresse</label>
                <input type="text" class="form-control" aria-label="Votre adresse" id="inputAddresse" name="adresse">
            </div>
            <div class="col-12">
                <label for="inputAddresse2" class="form-label">Address 2</label>
                <input type="text" class="form-control" id="inputAddresse2" aria-label="Complément d'adresse" name="adresse2">
            </div>
            <div class="col-md-4">
                <label for="inputCodePostal" class="form-label">Code postal</label>
                <input type="text" class="form-control" id="inputCodePostal" name="codepostal" aria-label="Code postal">
            </div>
            <div class="col-md-8">
                <label for="inputVille" class="form-label">Ville</label>
                <input type="text" class="form-control" id="inputVille" name="ville" aria-label="Ville">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" name="accept">
                    <label class="form-check-label" for="gridCheck">
                        J'accepte que mes données soient utilisées pour me contacter
                    </label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>