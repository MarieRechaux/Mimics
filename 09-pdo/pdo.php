<?php
echo "<h2> 01. PDO (php data object): CONNEXION</h2>";

// 
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
]);

/*
    PDO est une classe prédéfinie en PHP permetant de se connecter et de dialoguer avec une base de données.
    Nous avons besoin d'instancier la classe 'new' pour pouvoir nous en servir, $pdo est un objet issu de la classe PDO.
    Nous devons lui fournir en argument, les coordonnées de la BDD:
     - 1. mysql : serveur
     - 2. host : localhost -> adress http du serveur (127.0.0.1)
     - 3. dbname : le nom de la base de données
     - 4. root : utilisateur (par defaut root en local)
     - 5. mot de passe (par defaut vide en local)
     - 6. options (erreur warning, encodage des colonnes en utf8)
*/

echo '<pre>'; var_dump($pdo); echo '</pre>';

// get_class_methods est une fonction prédéfinie permettant d'afficher toutes les méthodes (fonctions) issue d'une classe

/*
    Toutes les méthodes (fonctions) issue de la classe PDO
    Array
    (
        [0] => __construct
        [1] => beginTransaction
        [2] => commit
        [3] => errorCode
        [4] => errorInfo
        [5] => exec
        [6] => getAttribute
        [7] => getAvailableDrivers
        [8] => inTransaction
        [9] => lastInsertId
        [10] => prepare
        [11] => query
        [12] => quote
        [13] => rollBack
        [14] => setAttribute
    )
*/

echo '<pre>'; print_r(get_class_methods($pdo)); echo '</pre>';

echo "<h2> 02. EXEC - INSERT, UPDATE, DELETE</h2>";

// INSERT
// $execute = true;
if(isset($execute)){
    $result = $pdo->exec('INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire)
    VALUES ("Marie", "RECHAUX", "f", "PDG", "2025-02-04", 30000)');
    echo "Nombre d'enregistrement affecté par insert : $result<br>";
}

/*
    exec() est une méthode issue de la classe PDO perettant d'executer des requetes SQL en BDD.
    On doit lui fournir en argument la requete SQL.
    Elle permet d'executer les requetes INSERT, UPDATE, DELETE.
    Elle retourne le nombre d'execution de requetes enregistrées dans la BDD
*/

// UPDATE 
// exo : executer le script permettant de modifier le salaire de jean-pierre par 1300 et son service par 'Marketing' en fonction de son id 350
$resultUpdate = $pdo->exec("UPDATE employes SET salaire = 1300, service = 'Marketing' WHERE id_employes = 350");
echo "nombre d'enregitrement affecté par update : $resultUpdate<br>";

// DELETE
// exo : executer le script perettant de supprimer l'employé id 350
$resultDelete = $pdo->exec('DELETE FROM employes WHERE id_employes = 350');
echo "nombre d'enregitrement affecté par update : $resultDelete<br>";

echo "<h2> 03. PDO : QUERY - SELECT + FETCH_ASSOC (1 seul résultat)</h2>";

// La methode query() de la classe PDO retourne un autre objet issu d'une classe PDOStatement ! Cette classe contient ses propres méthodes (fonctions) permettant de rendre le résultat exploitable
$data = $pdo->query("SELECT * FROM employes WHERE prenom = 'Daniel'");

echo '<pre>'; var_dump($data); echo '<pre>';

echo '<pre>'; print_r(get_class_methods($data)); echo '<pre>';

// FETCH_ASSOC : constante de la classe PDO qui retourne un array indéxé avec le nom des champs/colonnes de la table SQL
$arrayEmploye = $data->fetch(PDO::FETCH_ASSOC);
// FETCH_NUM : constante de la classe PDO qui retourne un array indéxé numériquement
// $arrayEmploye = $data->fetch(PDO::FETCH_NUM);
// FETCH_OBJ : constante de la classe PDO qui retourne un objet de la classe stdClass (class par défaut en PHP) avec comme propriété public les champs/colonnes de la table SQL ($arrayEmploye->prenom)
// $arrayEmploye = $data->fetch(PDO::FETCH_OBJ);
echo '<pre>'; print_r($arrayEmploye); echo '</pre>';

/*
    $pdo représente un objet issu de la classe prédéfinie PDO
    Quand on execute une requête de séléction via la méthode query() sur l'objet PDO : 
    - Succès : On obtient un autre objet issu d'une autre classe PDOStatement . Cet objet à donc des méthodes et propriétés différentes ! 
    - Echec : boolean False
    $data est inexploitable en l'état.
    La méthode fetch() issu de l'objet PDOStatement $data permet de convertir l'objet en un tableau de données Array indéxé avec le nom des champs/colonnes de la table SQL

    Array
    (
        [id_employes] => 854
        [prenom] => Daniel
        [nom] => Chevel
        [sexe] => m
        [service] => informatique
        [date_embauche] => 2011-09-28
        [salaire] => 1700
    )
*/


echo "bonjour, je suis $arrayEmploye[prenom] $arrayEmploye[nom] et je travail au service $arrayEmploye[service]<br>";

foreach($arrayEmploye as $key => $value){
    echo "$key: $value<br>";
}

echo "<h2> 04. PDO : QUERY - SELECT + FETCH_ASSOC (plusieurs résultats)</h2>";

$data = $pdo->query("SELECT * FROM employes");

// tant qu'il y a des resultats que retourne la méthode fetch(), tant que $arrayEmploye retourne true, la boucle continue de tourner
// si la requete retourne plusieurs résultats, nous somme obligé de boucler le résultat 
while($arrayEmploye = $data->fetch(PDO::FETCH_ASSOC)){
    echo '<pre>'; print_r($arrayEmploye); echo '</pre>';
    echo '<div style="background: lightblue; padding: 1rem; margin-bottom: 1rem;">';
        echo "$arrayEmploye[prenom]<br>";
        echo "$arrayEmploye[nom]<br>";
        echo "$arrayEmploye[service]<br>";
    echo '</div>';
}

// rowCount() est une méthode issue de la classe PDOStatement qui retourne le nombre de lignes séléctionnées dans la base de données, dans la table SQL (ex: proatique pour compter le nombre de produits stockés en BDD)
echo "nombre d'employes : " . $data->rowCount() . '<hr>';

echo "<h2> 05. PDO : QUERY - SELECT + FETCH_ALL + FETCH_ASSOC (plusieurs résultats)</h2>";

$data = $pdo->query("SELECT * FROM employes");
echo '<pre>'; print_r($data); echo '</pre>';

// la méthode fetchAll() issue de la classe PDOStatement retourne un tableau multidimensionnel, chaque ligne de résultat est indéxé numériquement dans le tableau multidimensionnel
$arrayAllEmployes = $data->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($arrayAllEmployes); echo '</pre>';

// exo : afficher successivement les données des employés en passant par le tableau multidimensionnel à l'aide de boucles foreach (boucle imbriquée)
foreach($arrayAllEmployes as $key => $arrayUnEmploye){
    echo '<div style="background: lightgrey; padding: 1rem; margin-bottom: 1rem;>';
    foreach($arrayUnEmploye as $key2 => $value){
        echo '<pre>'; print_r($key2); echo '</pre>';
        echo '<pre>'; print_r($value); echo '</pre>';
    }
    echo '</div>';
}

echo "<h2> 06. PDO : QUERY - SELECT + FETCH</h2>";

// exo : afficher la liste des base de données dans une liste <ul><li></li> HTML

$data = $pdo->query("SHOW DATABASES");
echo '<pre>'; print_r($data); echo '</pre>';
echo '<pre>'; print_r(get_class_methods($data)); echo '</pre>';

$arrayDatabase = $data->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($arrayDatabase); echo '</pre>';

echo '<ul>';
foreach($arrayDatabase as $key => $array){
    echo '<li>';
        echo "$array[Database]";
    echo '</li>';
}
echo '</ul>';

echo "<h2> 06. PDO : QUERY - SELECT - FETCH - table</h2>";

// data est un objet de la classe PDOStatement
$data = $pdo->query("SELECT * FROM employes");
echo '<pre>'; print_r($data); echo '</pre>';
echo '<pre>'; print_r(get_class_methods($data)); echo '</pre>';

$arrayAllEmployes = $data->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($arrayAllEmployes); echo '</pre>'; 

// columnCount() : méthode issue de la classe PDOStatement qui retourne le nombre de colonnes selectionnées dans la table SQL (ici 7 colonnes)
print_r($data->columnCount());

/*
    La boucle FOR tourne autant de fois que nous avons selectionné de colonne dans la BDD, dans la table SQL (ici 7 colonnes)
    getColumnMeta() : fonction issue de la classe PDOStatement qui retourne les méta données des colonnes de la table SQL (description de la colone : nom, taille, varchar, primary key etc..)
    Pour chaque tour de boucle FOR, getColumnMeta retourne les données d'une colonne, il faut lui trnsmettre le numéro de la colonne en argument
    Pour afficher le nom de la colonne, il faut crocheter à l'indice $dataColonne[name] du tableau Array retourné par getColumnMeta
*/

echo '<table border="2">';
    echo '<tr>';
    for($colonne = 0; $colonne < $data->columnCount(); $colonne++){
        $dataColonne = $data->getColumnMeta($colonne);
        echo '<pre>'; print_r($dataColonne); echo '</pre>';
        echo "<th>$dataColonne[name]</th>";
    }
echo '</tr>';

// echo '<tr>';
// foreach($arrayAllEmployes[0] as $key => $arrayUnEmploye){
//     echo "<th>$key</th>";
// }
// echo '</tr>';

foreach($arrayAllEmployes as $key => $arrayUnEmploye){
    echo '<tr>';
    foreach($arrayUnEmploye as $key2 => $value){
         echo "<th>$value</th>";
    }
    echo '</tr>';
}
echo '</table>';

/*
    $arrayAllEmployes contient un tableau multidimensionnel contenant l'ensemble des employés, indexé numériquement
    $arrayUnEmploye réceptionne 1 Array (1 ligne de la table SQL) d'1 employé par tour de boucle.
    Il n'est pas possible de faire un 'echo $arrayUnEmploye', on ne peut pas convertir un array en chaines de caractères
    Nous devons donc le transmettre à la 2ème boucle foreach pour parcourir l'ensemble des données
*/

?>