<?php 
session_start();

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

// permet de supprimer les données d'un indice dans la session, exemple, si nous supprimons tout les produits du panier 
unset($_SESSION['panier']);

// suppression de la session 
session_destroy();

/*
    Les informations de la session sont enregistrées coté serveur, elle contient des informations sensible comme l'email, les données du panier, elles sont stockées et accessibles via la superglobale $_SESSION, qui est un tableau de données Array (identique à $_GET et $_POST), la session permet d'avoir accès à des données sur n'importe quelle page de l'application, il y a un fichier de session par utilisateur, la sessiona une durrée de vie illimiée, si on ne la supprime pas, elle perdure.
    Elle permet d'être enthentifier sur une application, sans elle nous serions déconnecter à chaque changement de page.
*/