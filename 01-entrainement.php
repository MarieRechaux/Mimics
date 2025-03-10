<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>01 - entrainement PHP</title>
</head>
<body>
    <!-- Il est possible d'écrire du HTML dans un fichier portant l'extension PHP, l'inverse n'est pas possible -->

    <div class="container">
        <h2 class="title__h2">Ecriture et affichage</h2>

        <?php 
        // Ouverture de la balise PHP
        // La balise PHP peut être ouverte/fermé autant de fois que souhaité 

        // echo est une instruction d'affichage que l'on peut traduire par 'affiche moi'
        echo 'Bonjour';
        echo '<br>';
        echo 'Bienvenue<br>';

        // fermeture de la balise PHP
        ?>
        
        <!-- Raccourci pour excuter une instruction d'affichage 'echo' -->
        <?= "Allo !!" ?>

        <?php
        // Commentaire sur une seule ligne
        /*
            Commentaire sur 
            plusieurs lignes
        */
        # Commentaire sur une seule ligne

        echo '<h2 class="title__h2">Variable : types / déclarations / affectation</h2>';

        // chaque instruction en PHP se termine toujours par un ';', c'est le délimiteur
        // Une variable est espace nommé permettant de conserver une valeur
        // Toujours le signe $ suivi du nom de la variable que nous définissons
        // Une variable ne peut pas commencer par un chiffre 
        // $2a --> erreur | $a2 --> OK  

        $a = 127;
        echo gettype($a); // Type : INTEGER
        echo '<br>';
        
        $b = 1.5;
        echo gettype($b); // Type : DOUBLE
        echo '<br>';

        $c = "une chaine de caractères"; // Type : STRING
        echo gettype($c);
        echo '<br>';

        $d = '127';
        echo gettype($d); // Type : STRING
        echo '<br>';

        $e = true; // ou false
        echo gettype($e); // Type : Boolean
        echo '<br>';

        // Il existe d'autres type de données, commes les types ARRAY et OBJECT (prochain chapitre)

        echo '<h2 class="title__h2">Concaténation</h2>';    

        $x = "Bonjour ";
        $y = "tout le monde";
        echo $x . $y . "<br>"; // point de concaténation que l'on peut traduire par 'suivi de'
        echo "$x $y <br>"; // entre guillemets, les variables sont évaluées
        echo '$x $y <br>'; // entre quote, les variables ne sont pas évaluées, c'est une chaine de caractères

        echo '<h2 class="title__h2">Concaténation lors de l\'affectation</h2>';
        $prenom1 = "Bruno";
        $prenom1 .= " Claire";
        echo $prenom1 . '<br>'; // Affiche "Bruno Claire", cela permet d'ajouter une valeur à la variable $prenom1 sans écraser sa valeur précédente

        echo '<h2 class="title__h2">Constante et constante magique</h2>';

        // define() : fonction prédéfinie permettant de déclarer une constante, par convention elle se déclare toujours en majuscule, et comme son nom l'indique, sa valeur est constante ! On ne pourra modifier sa valeur durant l'execution du script
        define("CAPITALE", "Paris");
        echo CAPITALE . '<br>';

        // define("CAPITALE", "Rome"); /!\ erreur !!!

        // constante magique
        echo __FILE__ . '<br>'; // Chemin complet vers le fichier
        echo __LINE__ . '<br>'; // Affiche le numéro de la ligne (91)

        echo '<h2 class="title__h2">Exercice variables</h2>';
        // Afficher vert-jaune-rouge (avec les tirets) en mettant chaque couleur dans une variable. Faites en sorte que chaque mot soit de la bonne couleur
        $vert = '<span class="vert">vert</span>';
        $jaune = '<span class="jaune">jaune</span>';
        $rouge = '<span class="rouge">rouge</span>';

        echo $vert . '-' . $jaune . '-' . $rouge . '<br>';
        echo "$vert-$jaune-$rouge<br>";

        echo '<h2 class="title__h2">Opérateurs arithmétique</h2>';

        $a = 10;
        $b = 2;
        $c = 3;

        echo $a + $b . '<br>';
        echo $a - $b . '<br>';
        echo $a * $b . '<br>';
        echo $a / $b . '<br>';
        echo $a % $c . '<br>'; // modulo, c'est le reste de la division, j'ai 10 billes et 3 personnes, je donne 3 billes par personne, il m'en reste une.

        // operation / affectation
        $a += $b; // equivaut $a = $a + $b; la valeur $a vaut 12 !
        $a -= $b; // equivaut à $a = $a - $b; la valeur $a vaut 10 !
        // *= | /= 
        echo $a . '<br>';

        echo '<h2 class="title__h2">Structure conditionnelle (if / else) - opérateurs de comparaison</h2>';

        // Isset et empty   

        // $var1 = 0;
        $var2 = "";

        // empty() renvoi TRUE si la variable envoyé en argument contient 0, si elle n'est pas défini ou si sa valeur est vide
        // ex : pratique pour contrôler si le champs d'un formulaire est vide ou non
        // Si il n'y a qu'un seule instruction dans la condition if, les accolades en sont pas nécessaires
        if(empty($var2)) echo "0, vide ou non définie<br>";

        // Isset 
        if(isset($var2)) echo "var2 existe et est définie par rien<br>";
        // la fonction isset() test l'existance d'une variable, isset renvoi TRUE si la variable est définit, FALSE si la variable n'est pas définit

        /*
            =       affectation
            ==      comparaison de la valeur
            ===     comparaison de la valeur et du type
            <       strictement inférieur à
            >       strictement supérieur à
            <=      inférieur ou égal à
            >=      supérieur ou égal à
            !       N'EST PAS 
            !=      différent de
            && AND  ET 
            || OR   OU
            XOR     OU unique
        */

        $a = 10; 
        $b = 5;
        $c = 2;
        if($a == 8){
            echo 'A est égal à 8<br>';
        }elseif($b > $c){
            echo 'B est supérieur à C<br>';
        }else{
            echo 'Tout le monde a faux !!';
        }

        // On entre dans le cas ELSEIF, on sort de la condition, tout les autres cas ne sont pas évalués
        // avec XOR, il faut que seulement l'une des 2 conditions soit vrai pour entrer dans les accolades
        if($a == 10 XOR $b == 6){
            echo 'ok condition exclusive<br>';
        }

        // Condition ternaire (forme contractée)
        echo ($a == 10) ? "A est égal à 10<br>" : "A n'est pas égal à 10<br>";
        $var1 = isset($maVar) ? $maVar : 'maVar n\'exsite pas<br>';
        echo $var1 . '<br>';

        $var2 = $maVar ?? 'maVar n\'exsite pas<br>'; // La même chaose en plus court avec les "??", soit l'un soit l'autre
        echo $var2 . '<br>';

        echo '<h2 class="title__h2">Condition Switch</h2>';
        // Les 'case' représente les cas dans lesquels nous potentiellement tomber
        // Le cas par defaut n'est pas obligatoire

        $perso = 'Mario';
        switch($perso){
            case 'Luigi': 
                echo "C'est Luigi le meilleur";
            break;
            case 'Bowser': 
                echo "C'est Bowser le meilleur";
            break;
            case 'Toad': 
                echo "C'est Toad le meilleur";
            break;
            default: 
                echo "Vous êtes fou c'est Mario le meilleur !<br>";
            break;
        }

        // Exo : Pouvez-vous faire la même chose que le Swicth avec des conditions if/else, si oui faites le.

        $perso = 'Mario';
        if($perso == 'Luigi')
            echo "C'est Luigi le meilleur";
        elseif($perso == 'Bowser')
            echo "C'est Bowser le meilleur";
        elseif($perso == 'Toad')
            echo "C'est Bowser le meilleur";
        else
            echo "Vous êtes fou c'est Mario le meilleur !<br>";
 
        echo '<h2 class="title__h2">Fonctions prédéfinies</h2>';
        // Une fonction prédéfinie permet de réaliser un traitement spécifique, voici la documentation https://www.php.net/manual/fr/indexes.functions.php

        echo "Date : " . date("d/m/Y") . "<br>";
        // Une fonction se déclare toujours avec des parenthèses puisqu'elle peut potentiellement recevoir des arguments, ils ne viennent pas de null part, consulter la documentation

        $email1 = "gregory.lacroix@afpa.fr";
        echo "@ se trouve à la position : " . strpos($email1, '@') . '<br>'; // 15
        // strpos() : string position, permet de trouver la position d'un caractère dans une chaine de caractères, retourne un INTEGER si le caractère est trouvé

        $email2 = "bonjour";
        echo "@ se trouve à la position : " . strpos($email2, '@') . '<br>'; // cette ligne sort rien, pourtant il y a bien quelque chose à l'intérieur FALSE
        var_dump(strpos($email2, '@')); // On peut visualiser FALSE gràce à l'instruction d'affichage améliorée var_dump(), c'est un outil de debug similaire à console.log en JS, il en existe un autre print_r()

        $phrase = "Nous sommes mercredi et il pleut";
        echo "<br>Taille de la chaine de caractères : " . iconv_strlen($phrase) . '<br>';
        // iconv_strlen() : fonction prédéfinie permettant de calculer la taille d'une chaine de caractères

        $texte = "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque similique amet molestiae quasi, temporibus recusandae quo ut soluta quas ipsam possimus, et molestias architecto fugit pariatur vero labore deserunt animi!";

        echo substr($texte, 0, 20) . "...<a href=''>Lire la suite</a><br>";
        /*
            substr() : fonction prédéfinie qui retourne une partie de la chaine de caractères: 
            arguments: 
            1. la chaine que l'on souhaite couper
            2. position de départ
            3. le nombre de caractères souhaités
        */

        echo '<h2 class="title__h2">Fonctions utilisateur</h2>';
        
        //              'Asmaa'
        function bonjour($qui = 'Thomas'){
            //            'Asmaa'
            echo "Bonjour $qui <br>";
        }
        bonjour("Albert"); // Bonjour Albert
        bonjour(); // Si la variable de reception $qui contient une valeur par défaut, il n'est pas nécessaire d'envoyer un paramètre à l'execution de la fonction
        $prenom = 'Asmaa';
        bonjour($prenom); // le paramètre peut être une variable

        //                      200
        function appliqueTva($nombre){
            //         200
            return $nombre*1.2;
            echo 'Allo !'; //  ne s'affiche pas, une fois return executée, on sort de la fonction
        }

        echo appliqueTva(200) . '<br>'; // execution de la fonction

        // Exercice : Pourrions-nous améliorer cette fonction afin que l'on puisse calculer un montant en fonction du taux de notre choix (5.5%, 19.6% etc...)
        //                      200    , 19.6
        function appliqueTvaExo($nombre, $taux = 20){
            //      200          19.6
            return $nombre * (1+$taux/100);
        }

        echo appliqueTvaExo(200, 19.6) . '<br>';
        echo appliqueTvaExo(400) . '<br>';

        //              'hiver', 6
        function meteo($saison, $temperature){
            //                    hiver                 6
            echo "Nous sommes en $saison et il fait $temperature degré(s)<br>";
        }
        meteo('hiver', 6);
        
        // Exo : gérer le S de dégré en fonction de la temperature, attention au terme 'en hiver', 'au printemps'
        //                          0
        function exoMeteo($saison, $temperature){
            $degre = 'degré';
            //   0                      0
            if($temperature > 1 || $temperature < -1) $degre = 'degrés';

            $preposition = 'en';
            if($saison == 'printemps') $preposition = 'au';

            echo "Nous sommes $preposition $saison et il fait $temperature $degre<br>";
        }

        exoMeteo('hiver', 2);
        exoMeteo('automne', 0);
        exoMeteo('automne', 1);
        exoMeteo('automne', -1);
        exoMeteo('printemps', -5);

        // Espace local et global
        function jourSemaine() {
            // Espace locale
            $jour = 'Mercredi'; // variable LOCALE
            return $jour;
        }

        // echo $jour; /!\ Undefined variable $jour, cette variable n'est accessible qu'à l'intérieur de la fonction jourSemaine
        echo jourSemaine() . '<br>';

        //----------------------------------------------------------
        $pays = 'France'; // variable GLOBALE
        function affichagePays(){
            global $pays; // le mot clé global permet d'importer une variable de l'espace globale (à l'extérieur de la fonction) vers l'espace local (à l'intérieur de la fonction)
            echo $pays;
        }

        affichagePays();

        /*
            2 espaces en PHP
            - espace LOCAL, à l'intérieur d'une fonction
            - espace GLOABL, espace par défaut, à l'éxtèrieur d'une fonction
        */
        
        echo '<h2 class="title__h2">Structure itératives : boucle</h2>';
        // Les boucles permettent d'autmotaiser un traitement, une tache, elles sont courantes en PHP.
        // Ex: si nous avons besoin d'afficher les données de 500 produits de la BDD sur la page Web, c'est une boucle qui automatisera cette affichage

        // Boucle WHILE 
        $i = 0; // 3
        //     3
        while($i < 3){
            //     2---
            echo "$i---";
            $i++; // équivaut à $i = $i + 1;
        }

        echo '<br>';

        // 0---1---2---

        // Exo : faites en sorte de ne pas les tirets à la fin : 0---1---2
        $j = 0;
        while($j < 3){
            if($j == 2)
                echo $j;
            else 
                echo "$j---";
            $j++;
        }

        echo '<br>';

        // Boucle FOR
        //  Initialisation; condition d'entrée; incrémentation

        //           16
        for($s = 0; $s < 16; $s++){
            // Instruction pour chaque tour de boucle
            //     15---
            echo "$s---";
        }

        // 0---1---2---3---15---

        // Exo : créer un selecteur contenant 30 options
        echo '<hr><select>';
        for($option = 1; $option <= 30; $option++){
            echo "<option>$option</option>";
        }
        echo '</select><hr>';
        ?>

        <select>
        <?php for($option = 1; $option <= 30; $option++): ?>
            <option value=""><?= $option ?></option>
        <?php endfor; ?>
        </select>

        <?php 
        /*
            Autre synthaxe de la boucle for, utiliser en orienté objet dans le template de rendu afin de miniser le code PHP et privilégier le code HTML
            for(): les ';' remplace l'accolade ouvrante
            endfor : remplace l'accolade fermante
            while(): / endwhile;
            foreach(): / endforeach; 
        */

        // Exo : faites une boucle qui affiche de 0 à 9 sur la même ligne (soit 10 tours) dans un tableau HTML 

        /*
            -----------------------------------------
            | 0 | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 |
            -----------------------------------------

            <table>
                <tr>
                    <td></td>
                </tr>
            </table>
        */

        echo '<table><tr>';
        for($cellule = 0; $cellule < 10; $cellule++){
            echo "<td>$cellule</td>";
        }
        echo '</tr></table>';

        // Exo : Faire la même chose en allant de 0 à 99 sur plusieurs lignes sans faire 10 boucles

        /*
            ---------------------------------------------------
            | 0  | 1  | 2  | 3  | 4  | 5  | 6  | 7  | 8  | 9  |
            ---------------------------------------------------
            | 90 | 91 | 92 | 93 | 94 | 95 | 96 | 97 | 98 | 99 |
            ---------------------------------------------------

            <table>
                <tr>
                    <td></td>
                </tr>
            </table>

            10 tour pour créer 10 lignes <tr>
            for(){

                10 tour pour créer 10 cellule <td> dans chaque ligne
                for(){

                }
            }
        */

        $compteur = 0; // 19
        echo '<table>';
        for($ligne = 0; $ligne < 10; $ligne++){
            echo '<tr>';
            //              
            for($cellule = 0; $cellule < 10; $cellule++){
                echo "<td>$compteur</td>";
                $compteur++; // 29
            }
            echo '</tr>';
        }
        echo '</table>';

        echo '<h2 class="title__h2">Tableau de données ARRAY</h2>';
        // Un tableau est déclaré un peu comme une variable améliorée, car on ne conserve pas qu'une seule valeur mais un ensemble de valeur.
        // Les tableaux ARRAY sont souvent utilisés en PHP, par exemple, si nous séléctionnons dans la base de données des produits, nous les réceptionnons en règle général sous forme de tableau ARRAY

        $perso = ['Mario', 'Luigi', 'Bowser', 'Peach', 'Toad'];
        // echo $perso; /!\ Warning: Array to string conversion, il n'est pas possible un tableau de données array en chaine de caractères

        // <pre> (presentation) est une balise HTML permettant de formater le texte, cela nous permet de mettre en forme la sortie du print_r()
        echo '<pre>';
        print_r($perso);
        echo '</pre>';

        /*
            Array
            (
              indice   valeur
                [0] => Mario
                [1] => Luigi
                [2] => Bowser
                [3] => Peach
                [4] => Toad
            )
        */

        echo '<pre>';
        var_dump($perso);
        echo '</pre>';

        // Exo : tenter d'afficher sur la page web Bowser en passant par le tableau array $perso sans faire un 'echo Bowser'

        echo $perso[2] . '<br>';

        echo '<h2 class="title__h2">Boucle foreach pour les tableaux de données ARRAY</h2>';

        $perso = ['Mario', 'Luigi', 'Bowser', 'Peach', 'Toad'];

        //                  Toad
        foreach($perso as $value){
            //      Toad
            echo "$value<br>";
        }

        echo '<hr>';
        //                  1      Luigi
        foreach($perso as $key => $value){
            //     1      Luigi
            echo "$key : $value<br>";
        }

        /*
           La boucle foreach permet de parcourir les tableaux Array et les objets
           $key et $value sont des variables de réception que nous définssons, il n'y a pas besoin de les déclarer à l'éxtèrieur de la boucle
           $key réceptionne un indice du tableau Array par tour de boucle
           $value réceptionne une valeur du tableau Array par tour de boucle 
           Lorsqu'il n'y a qu'une seule vraible de réception, par défaut elle réceptionne les valeurs du tableau array
        */

        // count et sizeof sont 2 fonctions similaire, pas de différence, elles retournent le nombre d'éléments déclarés dans le tableau Array
        echo 'Taille du tableau: ' . count($perso) . '<br>';
        echo 'Taille du tableau: ' . sizeof($perso) . '<br>'; 

        echo implode("-", $perso); // implode() est une fonction prédéfinie qui rassemble les éléments d'un tableau en une chaine de caractère, séparé par un symbole

        $url = "assets/image/photographer/Mimi Keel.jpg";
        $arrayUrl = explode('/', $url);

        echo '<pre>';
        print_r($arrayUrl);
        echo '</pre>';

        echo '<h2 class="title__h2">Tableau Array multidimensionnel</h2>';
        // Nous parlons de tableau multidimensionnel quand un tableau est contenu dans un autre tableau
        $arrayMulti = [
            0 => [
                'prenom' => 'Julien',
                'nom' => 'Cottet'
            ],
            1 => [
                'prenom' => 'Thomas',
                'nom' => 'Winter'
            ]
        ];

        echo '<pre>';
        print_r($arrayMulti);
        echo '</pre>';

        // Exo : tenter d'afficher 'Thomas' en passant par la tableau multidimensionnel arrayMulti sans faire un 'echo Thomas'
        echo $arrayMulti[1]['prenom'] . '<hr>';

        // Exo : afficher successivement les données du tableu multi à l'aide de boucle foreach (boucle imbriquée, 2 boucles foreach)
        foreach($arrayMulti as $array){
            //               nom   Winter 
            foreach($array as $key => $value){
                // echo '<pre>';print_r($key);echo '</pre>';
                // echo '<pre>';print_r($value);echo '</pre>';
                echo "$key: $value<br>";
            }
        }
        
        /*
            prenom: Julien
            nom: Cottet
            prenom: Thomas
            nom: Winter
        */

        echo '<h2 class="title__h2">Les superglobales</h2>';

        echo '<pre>';
        print_r($_SERVER);
        echo '</pre>';

        /*
            Les superglobales sont des variables prédéfinies dans le langage, de type ARRAY, accessible n'importe où (espace local / gloable) permettant de véhiculer certain type de données:
            $_SERVER
            $_GET : permet de véhiculer les données transmise dans l'url (?id=243)
            $_POST : permet de récupérer toutes les données saisie dans un formulaire
            $_FILES: permet de récupérer toutes les données d'un fichier uploadé
            $_COOKIE: données au fichier cookie (préférences du site, dreniers articles consultés etc..)
            $_SESSION: permet de véhiculer les données de la session en cours (authentification sur un site)
        */

        echo '<h2 class="title__h2">Classes et objets</h2>';

        /*
            Un objet est un autre type de données. Un peu à la manière d'un Array, il pemret de regrouper des informations.
            Cependant, cela va beaucoup plus loin car on peux y déclarer des varaibles (appelées propriétés) mais aussi des fonctions (appelées méthodes)
        */

        class Etudiant {
            public $prenom = "Marie"; // public permet de préciser que l'élément sera accessible de partout 'extérieur et interieur de la classe); il en existe d'autre 'protected' et 'private'
            public $age = 23;
            public function pays(){
                return "France";
            }
        }

        // echo $age; /!\ erreur

        /*
            le mot clé 'new' permet d'instancier la classe Etudiant et d'en faire un objet, c'est ce qui nous permet de déployer la classe afin de pouvoir l'utiliser, new permet de créer un enfant de la classe, c'est à travers l'objet que l'on peut utiliser ce qui est déclaré dans la classe.
            pour piocher dans un objet, on utilise la flèche '->'
        */

        $objet = new Etudiant();
        echo '<pre>'; var_dump($objet); echo '</pre>';
        echo "Prenom : " . $objet->prenom . '<br>';
        echo "Age : " . $objet->age . '<br>';
        // il ne faut pas mettre le '$' devant la propriété
        echo "Pays : " . $objet->pays() . '<br>';

        ?>
    </div>
</body>
</html>