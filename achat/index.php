<?php
require '../auth/config/Config_Server.php';
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
?>


<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>E-COMMERCE | Teke ZIK</title>
        <meta name="description"
              content="Teke zik est un groupe camerounais de reprises de chansons contemporaines et classiques sur youtube
          formé à yaoundé par les amis: Ntsobe Belinga Wilfried Roger, zibi André Jude, et Ngazanga Ayissi Patrice isreal. Après avoir poursuivi
          leurs objectifs éducatifs respectifs étant passionné de musique, Wilfried (Percussionniste, guitariste) Jude(pianiste)
          isreal (Chanteur pianiste et guitariste) se rencontrent pour la première fois dans un club de musique de capitale ou ils commencent à partager
          la même scène lors des free jam. c'est le déclic les trois amis ne vont plus se quitter des yeux, ils vont ainsi multiplier de nombreux show dans divers clubs
          se faisant remarqué ils vont également être sollicité par des particuliers pour divers prestations privées.
          En 2020 ils décident ainsi d'officialiser leur groupe">
        <meta name="author" content="Bertin Mounok, bertin-dev, bertin.dev, https://bertin-mounok.cm, Wilfried (Percussionniste, guitariste), Jude(pianiste), isreal (Chanteur pianiste et guitariste)">
        <meta name="keywords" lang="fr" content="https://tekezik.com, Teke ZIK, acoustic, coversong, acousticcover, pianocover, guitarcover, covermusic, lovesong, love,
    cover, lovesongs, #cover, acousticguitar, youtubemusic, youtuber, free jam, freejam">
        <meta name="copyright" content="© <?= date('Y', time()); ?>, Teke ZIK.">
        <meta name="language" content="fr">

        <meta name="Application-Web-Portfolio" content="Mes Covers">
        <meta property="og:site_name" content="E-COMMERCE / TEKE ZIK">
        <meta property="og:title" content="E-COMMERCE | TEKE ZIK">
        <meta property="og:url" content="https://tekezik.com">
        <meta property="og:type" content="website">
        <meta property="og:locale" content="fr_FR">
        <meta property="og:locale:alternate" content="en_US">
        <meta property="og:image" content="<?= 'https://'.$_SERVER['HTTP_HOST'].'../../img/home.jpg';?>">

        <!-- Favicon-->
        <link href="../tz.png" rel="icon" type="image/png">
        <link href="../tz.ico" rel="shortcut icon" type="img/x-icon">
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>


        <!-- Navigation-->
        <nav id="articles" class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="../index.php">Teke ZIK</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    </ul>
                        <a href="../auth/Public/report.php" class="btn btn-outline-dark">
                            <i class="bi-cart-fill me-1"></i>
                            Panier
                            <span class="badge bg-dark text-white ms-1 rounded-pill">
                                <?= $nbr = $connexion->rowCount('SELECT * FROM paniers WHERE ip="'.get_ip().'" '); ?>
                                </span>
                        </a>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5 header-bg">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
                </div>
            </div>

            <div class="loader_blog" style="display: none; z-index: 10000; position: relative; text-align: center">
                <span class="loader loader-circle"></span>
                <p class="display-5 fw-bolder" ">Chargement......</p>
            </div>
        </header>

        <!-- Section-->
        <section  class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                    <?php
                    $requete = 'SELECT * FROM articles WHERE state="available" ORDER BY id';
                    foreach ($connexion->query($requete) as $article):

                        if($article->new_price != "0"){
                            echo '<div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" alt="'.$article->name.'" src="' . str_replace('../img/', '../auth/public/img/', $article->image) . '">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">'.$article->name.'</h5>
                                    <!-- Product price-->
                                   
                                          <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">'.$article->new_price.' FCFA</span>-
                                    '.$article->price.' FCFA
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto link_articles" data="articles=' . intval($article->id) . '" href="#">Ajouter au panier</a></div>
                            </div>
                        </div>
                    </div>              
                    ';
                        } else{
                            echo '<div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                             <img class="card-img-top" alt="'.$article->name.'" src="' . str_replace('../img/', '../auth/public/img/', $article->image) . '">
                           <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">'.$article->name.'</h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    '.$article->price.' FCFA
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto link_articles" data="articles=' . intval($article->id) . '" href="#">Ajouter au panier</a></div>
                            </div>
                        </div>
                    </div>';
                        }

                    endforeach;
                    ?>


                </div>
            </div>
        </section>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white" style="text-align:center;white-space:pre-wrap;">©️ Teke ZIK - <?= date('Y', time()); ?></p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="js/jquery.1.8.3.min.js"></script>
        <script src="js/treatment.js"></script>
    </body>
</html>
