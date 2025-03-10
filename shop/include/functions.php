<?php 
// ------ FONCTION UTILISATEUR AUTHENTIFIE
// Fontion permettant de savoir si l'utilisateur est authentifié sur le site
function userConnected(){
    // Si l'indice 'user' dans le fichier de session n'est pas définit, cela veut dire que l'internaute n'est pas passé par la page connexion et n'est pas authentifié
    if(isset($_SESSION['user']))
        return true;
    else
        return false; // on retourne true si l'indice 'user' est définit dans la session
}

// ------ FONCTION ADMINISTRATEUR AUTHENTIFIE
// Fonction permettant de savoir si un administrateur est authentifié sur le site

function adminConnected(){
    // Si à l'indice 'roles' dans la session, la valeur est admin, cela veut dire que dire que c'est un administrateur on retourne true

    if(userConnected() && $_SESSION['user']['roles'] == 'admin') 
        return true;
    else
        return false; // on retourne false si dans la session le roles n'est pas 'admin'
}

// ------------- FONCTION CREATION PANIER SESSION 

function createCart(){
    // si l'indice cart est pas définit dans la session de l'utilisateur, cela veut dire que l'utilisateur n'a ajouté aucun  produit dans le panier, alors on crée les différents tableaux dans la session
    if (!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
        $_SESSION['cart']['id_product'] = [];
        $_SESSION['cart']['title'] = [];
        $_SESSION['cart']['picture'] = [];
        $_SESSION['cart']['reference'] = [];
        $_SESSION['cart']['quantity'] = [];
        $_SESSION['cart']['price'] = [];
    }
}

// ------------- FONCTION AJOUTER PRODUIT DANS LE PANIER SESSION

function addProductToCart($id_product, $title, $picture, $reference, $quantity, $price){
    createCart(); // on controle si le panier existe ou non dans la session 

    // on controle si l'id du produit que l'on tente d'ajouter dans la session pannier existe déjà 
    $positionProduct = array_search($id_product, $_SESSION['cart']['id_product']);
    // var_dump($positionProduct);

    // si la valeur de $positionProduct est différente de false, cela veux dire que l'id_product existe dans le pannier, on modifie seulement la quantité du produit 
    if($positionProduct !== false){
        $_SESSION['cart']['quantity'][$positionProduct] += $quantity;
    }else{
        // sinon l'id n'est pas dans la session, on crée une nouvelle ligne dans le panier 
        // les [] vide permettent de créer des indices numérique dans les tableau array 
        $_SESSION['cart']['id_product'][] = $id_product;
        $_SESSION['cart']['title'][] = $title;
        $_SESSION['cart']['picture'][] = $picture;
        $_SESSION['cart']['reference'][] = $reference;
        $_SESSION['cart']['quantity'][] = $quantity;
        $_SESSION['cart']['price'][] = $price;
    }

}

// ---------- FONCTION MONTANT TOTAL DU PANIER

function totalAmount(){
    $total = 0;
    for($i = 0; $i < count($_SESSION['cart']['id_product']); $i++){
        $total += $_SESSION['cart']['quantity'][$i] * $_SESSION['cart']['price'][$i];
    }
    return round($total, 2);
}

// ---------- FONCTION LIEN ACTIF NAV

function activeLink($url){
    if($_SERVER['PHP_SELF'] == $url){
        echo ' active';
    }
}