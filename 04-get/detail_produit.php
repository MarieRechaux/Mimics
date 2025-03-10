<?php 
echo '<pre>';
print_r($_GET);
echo '</pre>';

// Les données transmises dans l'URL sont automatiquement stockées en PHP dans la superglobale $_GET, sous forme de tableau ARRAY

// Afficher les données du produit en passant par la supergloable $_GET
// Si l'indice 'prix' N'EST PAS définit dans l'URL, alors on entre dans le IF
if(!isset($_GET['id']) || !isset($_GET['article']) || !isset($_GET['couleur']) || !isset($_GET['prix'])){
    // On redirige l'internaute vers la page d'acceuil de la boutique
    // header() : fonction prédéfinie permettant d'exécuter une redirection http, on doit lui fournir l'url de destinaton (pas d'espace entre location et les ':' 'Location:')
    header('Location: index.php');
}

echo "Ref : $_GET[id]<br>";
echo "Article : $_GET[article]<br>";
echo "Couleur : $_GET[couleur]<br>";
echo "Prix : $_GET[prix]€<br><hr>";

// Exo : afficher successivement les données de l'URL en passant par $_GET d'une boucle foreach, faites en sorte de ne pas avoir l'id d'afficher
/*
    Array
    (
        [id] => 243
        [article] => chaussure
        [couleur] => jaune
        [prix] => 45
    )
*/
//                id        243
//                article   chaussure
foreach($_GET as $key => $value){   
    // Si la valeur de $key est différente de 'id', alors on affiche les données de l'URL
    // ucfirst() : fonction prédéfinie permettant de mettre la première lettre de la chaine de caractères en majuscule
    if($key != 'id')
        echo ucfirst($key) . " : $value<br>";
}

?>