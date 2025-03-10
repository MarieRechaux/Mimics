<?php
/*
    Différence entre include et require : 
        Il n'y a aucune différence entre les deux... dauf en cas d'erreur sur le nom, le chemin du fichier : 
            - include génère une erreur et continue l'execution du code
            - require génère une erreur mais stop l'éxecution du script

    le _conce permet de préciser que si le fichier est déjà inclu, on ne le réinclu pas
*/
include_once("includes/header.php");
require_once("includes/nav.php");
?>
       
    <main class="main">
        <p class="main__p">Nous sommes sur la page d'accueil</p>
        <p class="main__p">Nous sommes sur la page d'accueil</p>
        <p class="main__p">Nous sommes sur la page d'accueil</p>
        <p class="main__p">Nous sommes sur la page d'accueil</p>
        <p class="main__p">Nous sommes sur la page d'accueil</p>
        <p class="main__p">Nous sommes sur la page d'accueil</p>
        <p class="main__p">Nous sommes sur la page d'accueil</p>
        <p class="main__p">Nous sommes sur la page d'accueil</p>
    </main>

<?php 
require_once("includes/footer.php");
?>
        