<?php
/*
        Exercice : Espace de dialogue (livre d'or, tchat)
        1. Modélisation de la base de données
            BDD : tchat
            Table : commentaire 
                    id_commentaire  // INT(11) PK - AI
                    pseudo          // VARCHAR(255) NOT NULL
                    dateEnregistrement // DATETIME
                    message // LONGTEXT
        3. création du formulaire HTML (pour l'ajout de message)
        
        
        7. Afficher le nombre de messages enregistrés dans la BDD
    */

// 2. Connexion à la base de données
$connect_db = new PDO('mysql:host=localhost;dbname=tchat', 'user_tchat', 'tchat28!', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
]);

// 4. Récupération et affichage des données saisie en PHP (POST)
// echo '<pre>'; var_dump($_POST); echo '</pre>';

if (isset($_POST['submit'])) {
    // FAILLES XSS : injections de balises HTML dans la base de données, ces balises sont interprétés par le navigateur et donc potentiellement dangereurse.
    /*
        <script>
        let bug = true;
        while(bug){
            alert("ton site est buggé");    
        }
        </script>
    */
    // Pour parer aux failles XSS, ils existent des fonctions prédéfinies : 
    // strip_tags() : fonction prédéfinie permettant de supprimer les balises HTML
    // htmlentities() : Convertissez tous les caractères applicables en entités HTML
    // htmlspecialchars() ; Convertissez les caractères spéciaux en entités HTML
    $_POST['pseudo'] = strip_tags($_POST['pseudo']);
    $_POST['message'] = strip_tags($_POST['message']);

    //                 pseudo   Greg28
    foreach ($_POST as $key => $value) {
        // $_POST['pseudo'] = strip_tags(<script>Greg28</script>)
        $_POST[$key] = strip_tags(addslashes($value));
        // fonction prédéfinie permettant d'échapper les apostrophes dans une chaine de caratères
    }

    // 5. Requête SQL d'enregistrement (INSERT)
    // $req = "INSERT INTO commentaire (pseudo, dateEnregistrement, message) VALUES ('$_POST[pseudo]', NOW(), '$_POST[message]')";
    // $result = $connect_db->exec($req);
    // echo $req . '<hr>';

    $req = "INSERT INTO commentaire (pseudo, dateEnregistrement, message) VALUES (:pseudo, NOW(), :message)";
    $data = $connect_db->prepare($req);
    $data->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $data->bindValue(':message', $_POST['message'], PDO::PARAM_STR);
    $data->execute();
    echo $req;

    /*
        Les injections SQL est le fait d'injecter un morceau de code SQL directement en base de données (via un formulaire ou URL), l'injection SQL va détourner la requête initiale et va permettre d'en éxecuter une autre, elle est éxécuter en base de données.
        la méthode prepare() de la classe PDOStatement permet de préparer la requête si elle est redondante dans le code mais aussi de pouvoir définir des marqueurs nominatif (:pseudo, :message), nous les définissons, ce sont comme des boites vide dans lesquelles nous enfermons une valeur, de ce fait nous ne pouvons plus détounrer la requête initiale
        bindValue() est une méthode de la classe PDOStatement permettant de renseigner les valeurs des marqueurs, il y a 3 paramètres : 
        1. Le nom du marqueur (:pseudo)
        2. La valeur du marqueur ($_POST[pseudo])
        3. le type de données de la valeur du marqueur (string, int, boolean etc...)
        execute() est une méthode de la classe PDOStatement permettant d'executer la requête préparée

        Si l'internaute a la possibilité d'injecter une valeur dans une requête SQL (formulaire ou URL), il faut préparer la requête et déclarer des marqueurs nominatifs
    */

    // ok'); DELETE FROM commentaire; (
}

// 6. Affichage des messages (date au format français DATE_FORMAT)
// $data --> object PDOStatement
$data = $connect_db->query("SELECT pseudo, DATE_FORMAT(dateEnregistrement, 'Le %d/%m/%Y à %H:%i:%s') as datetimeFr, message FROM commentaire");
// echo '<pre>'; print_r($data); echo '</pre>';

$msgContent = '';
while ($comment = $data->fetch(PDO::FETCH_ASSOC)) {
    // echo '<pre>'; print_r($comment); echo '</pre>';

    $msgContent .= '<div class="col-8 mx-auto alert alert-primary mt-2">';
    $msgContent .= "<p class='fst-italic'>Posté par $comment[pseudo]</p>";
    $msgContent .= "<small>$comment[datetimeFr]</small>";
    $msgContent .= "<p class='w-100'>$comment[message]</p>";
    $msgContent .= '</div>';
}

// FAILLES XSS 
/*
        <script>
        let bug = true;
        while(bug){
            alert("ton site est buggé");
        }
        </script>
    */

// INJECTIONS SQL

// echo '<pre>'; print_r($msgContent); echo '</pre>';
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>10 - Tchat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="col-6 mx-auto">
        <h1 class="text-center my-3">TCHAT</h1>
        <?= $msgContent ?>
        <form method="post" action="">
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" name="pseudo" class="form-control" placeholder="Saisir votre pseudo" id="pseudo">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea type="text" name="message" class="form-control" rows="10" placeholder="Saisir votre message" id="message"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Poster</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
