<?php
session_start();

/*
    Array
    (
    [pays] => espagne
    )

    Le fichier cookie est stocké côté client, côté naviagteur, il contient des données non sensibles (derniers articles consultés, préférences du site etc...), ici le cookie a une durée de vie valable 1 an, l'internaute qui se connecte tout les mois verra son choix garder à l'infini !

    setCookie() est une fonction prédéfinie permettant de créer  un fichier cookie, cependant il n'y a de fonction prédéfinie permettant de la supprimer. Pour rendre inactif un cookie, une fois la durée de vie expirée, il est supprimé automatiquement.



    Le fichier de session et cookie sont liés, le cookie est à l'identifiant de la session : 

    [PHPSESSID] => c65b7bd3hrc4utbc5nanovaftb

*/

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TP - 1 | Exercice 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="col-6 mx-auto">
        <h1 class="text-center mb-3">Exercice 2.1</h1>

        <a href="?pays=france" class="btn btn-primary">France</a>
        <a href="?pays=italie" class="btn btn-success">Italie</a>
        <a href="?pays=espagne" class="btn btn-secondary">Espagne</a>
        <a href="?pays=angleterre" class="btn btn-warning">Angleterre</a>

        <?php 
        // echo '<pre>';
        // print_r($_GET);
        // echo '</pre>';


        // on entre dans le if lorceque nous avons cliqué sur un lien, et par conséquent envoyé un pays dans l'url
        if(isset($_GET['pays'])) {
            $pays = $_GET['pays'];
        }elseif (isset($_COOKIE['pays'])) {
            // on entre ici lorsque nous quittons et revenons sur la page, on stock la préférence du site dans le fichier cookie
            $pays = $_COOKIE['pays'];
        }else{
            // on entre dans le else lors de la toute première visite de la page
            $pays = 'France';
        }

        // setCookie("nom", "valeur", durée de vie en secondes)
        $un_an = 365*24*3600; // une année en seconde 
        // echo time(); // retourne le nombre de secondes écoulées depuis de 1er janvier 1970 (date clé en informatique), cela nous permet d'avoir un point de repère dans le temps

        setCookie("pays", $pays, time()+$un_an);

        echo '<pre>'; print_r($_COOKIE); echo '</pre>';

        // if($_GET){
            switch($pays){
                case 'france':
                    echo "Vous visitez un site en français ?";
                break;
                case 'italie':
                    echo "Vous visitez un site en italien ?";
                break;
                case 'espagne':
                    echo "Vous visitez un site en espagnol ?";
                break;
                case 'angleterre':
                    echo "Vous visitez un site en anglais ?";
                break;
            }
        // }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>