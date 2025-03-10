<?php

namespace General;

require_once("namespace_commerce.php");

use Commerce1, Commerce2, Commerce3; // permet de spécifier quelle namespace je souhaite importer du fichier namespace_commerce

$connect_db = new \PDO('mysql:host=localhost;dbname=shop', 'root', '', [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
]);

/*
    Sans l'anti-slash devant la classe PDO, l'interpréteur cherche d'abord la classe PDO dans l'espace de nom General, l'anti-slash permet de revenir dans l'espace glogal afin que la classe PDO soit bien existante
*/

echo '<pre>'; var_dump($connect_db); echo '</pre><hr>';

$commande = new Commerce1\Commande;
echo '<pre>'; var_dump($commande); echo '</pre>';
echo "nombre de commandes : " . $commande->nbCommande . "<hr>";

$produit = new Commerce2\Produit;
echo '<pre>'; var_dump($produit); echo '</pre>';
echo "nombre de produits : " . $produit->nbProduit . "<hr>";

$panier = new Commerce3\Panier;
echo '<pre>'; var_dump($panier); echo '</pre>';
echo "nombre de paniers : " . $panier->nbProduit . "<hr>";

$produit2 = new Commerce3\Produit;
echo '<pre>'; var_dump($panier); echo '</pre>';
echo "nombre de paniers : " . $produit2->nbProduit . "<hr>";