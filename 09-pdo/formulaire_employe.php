<!--
1. créer un formulaire html avec les champs correspondant aux colonnes de la table 'employes' (prenom, nom, sexe, service, date_embauche, salaire)

2. controler en php que l'on réceptionne bien toute les données saisie dans le formulaire (print_r)

3. créer le script permettant d'insérer un employé dans la BDD à la validation du formulaire

-->

<?php 
$connect_db = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
]);

echo '<pre>';
print_r($_POST);
echo '</pre>';

if(isset($_POST['submit'])){
    // on injecte directement dans la requête les données saisie dans le formulaire en passant par la superglobale $_post
    $result = $connect_db->exec("INSERT INTO employes VALUES (NULL, '$_POST[prenom]', '$_POST[nom]', '$_POST[sexe]', '$_POST[service]', '$_POST[date_embauche]', '$_POST[salaire]')");

    echo "Nombre d'enregistrement <span class='badge text-bg-success'>$result</span>";

}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

    <div class="col-6 mx-auto">
        <h1 class="text-center mb-3">Exo</h1>
        <form method="post" action="">
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control" placeholder="Saisir votre prénom" id="prenom">
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" placeholder="Saisir votre nom" id="nom">
            </div>
            <select class="form-select" name="sexe">
                <label for="sexe" class="form-label">Sexe</label>
                <option value="feminin">F</option>
                <option value="masculin">M</option>
            </select>
            <div class="mb-3">
                <label for="service" class="form-label">Service</label>
                <input type="text" name="service" class="form-control" placeholder="Saisir votre service" id="service">
            </div>
            <div class="mb-3">
                <label for="date_embauche" class="form-label">Date d'embauche</label>
                <input type="date" name="date_embauche" class="form-control" placeholder="Saisir votre date d'embauche" id="date_embauche">
            </div>
            <div class="mb-3">
                <label for="salaire" class="form-label">Salaire</label>
                <input type="number" name="salaire" class="form-control" placeholder="Saisir votre salaire" id="salaire">
            </div>

            <input type="submit" name="submit" class="btn btn-primary"></button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>