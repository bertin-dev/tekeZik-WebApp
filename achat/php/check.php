<?php
require '../../auth/Config/Config_Server.php';

session_start();
$connexion = App::getDB();


//recuperation de la veritable adresse ip du visiteur
function get_ip(){

    //IP si internet partagé
    if(isset($_SERVER['HTTP_CLIENT_IP'])){
        return $_SERVER['HTTP_CLIENT_IP'];
    }


    //IP derriere un proxy
    elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    //IP normal
    else{
        return isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : '';
    }
}

/* ==========================================================================
SYSTEME DE GESTION DES ARTICLES CLIQUES PAR L'UTILISATEUR
========================================================================== */

if(isset($_GET['articles_click']))
{

    // Génération de la clef d'activation
    $caracteres = array("a", "b", "c", "d", "e", "f", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
    $transaction_id = array_rand($caracteres, 8);


    $connexion->insert('INSERT INTO paniers(number, ip, article_id, created_at)
 VALUES (:transaction, :ip, :article, :time)',
        ['transaction'=>$transaction_id, 'ip'=>get_ip(), 'article'=>$_GET['articles_click'], 'time'=>time()]);
}

if($_GET['get_articles']){

    $data = '<div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Teke ZIK</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    </ul>
                    
                        <a href="../auth/Public/report.php" class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Panier
                            <span class="badge bg-dark text-white ms-1 rounded-pill">
                               '.$connexion->rowCount('SELECT * FROM paniers WHERE ip="'.get_ip().'" ').'
                                </span>
                        </a>
                   
                </div>
            </div>';

    $resultat = array (
        'result' => $data
    );


    echo $data;
}