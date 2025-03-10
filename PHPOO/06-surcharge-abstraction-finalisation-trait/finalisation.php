<?php
final class Application {
    public function lancementApp(){
        return "l'application est lancée !<br>";
    }
}

// class Extension extends Application {} /!\ erreur ! il n'est pas possible de hériter d'une classe finale 

// Une classe finale reste instanciable
$app = new Application();
echo $app->lancementApp();

class Application2 {
    final public function lancementApp(){
        return "l'application est lancée !<br>";
    }
}

class Extension2 extends Aplication2{
    // erreur ! je ne peu pas surcharger ou redéfinir la méthode car elle est final dans la classe mère (Application2)
    // public function lancementApp(){
    //     return "l'application est lancée !<br>";
    // }
}

/*
    L'intéret de mettre le mot clé final sur une méthode est de vérouiller afin d'empêcher toute sous-classe de la redéfinir, quand nous voulons être sur que le comportement d'une méthode est préservé durant l'héritage
*/