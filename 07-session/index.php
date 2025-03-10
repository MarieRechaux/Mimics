<?php 
// Permet de créer un fichier de session ou  de l'ouvrir si il existe déja, il est stocké côté serveur (C://xampp/tmp)
session_start();

if($_POST){
    // On crée un indice 'email' dans le fichier de session auquel on stock l'email saisi dans le formulaire
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['nom'] = 'Rechaux';
    $_SESSION['prenom'] = 'Marie';
    $_SESSION['panier'] = 7;
    echo '<pre>'; print_r($_SESSION); echo '</pre>';

    // Redirection
    header('Location: profil.php');
}

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>07 - SESSION | Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="col-6 mx-auto">
        <h1 class="text-center mb-3">Identifiez-vous</h1>
        <form method="post" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Saisir votre email" id="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" placeholder="Saisir votre mot de passe" id="password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
</body>
</html>