<?php
require '../config/Config_Server.php';
session_start();
$connexion = App::getDB();

if (isset($_SESSION['ID_USER'])) {
    $user_id = intval($_SESSION['ID_USER']);
} else if (isset($_COOKIE['ID_USER'])) {
    var_dump($_COOKIE['NOM_USER']);
    $user_id = intval($_COOKIE['ID_USER']);
} else {
    $user_id = 0;
    $last_name = "";
    $first_name = "";
}


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
<html xmlns:og="http://ogp.me/ns#" lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <meta name="Application-Web-Portfolio" content="Mes commandes">
    <meta property="og:site_name" content="COMMANDES / TEKE ZIK">
    <meta property="og:title" content="COMMANDES | TEKE ZIK">
    <meta property="og:url" content="https://tekezik.com">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:image" content="<?= 'https://'.$_SERVER['HTTP_HOST'].'../../img/home.jpg';?>">



    <link href="../../tz.png" rel="icon" type="image/png">
    <link href="../../tz.ico" rel="shortcut icon" type="img/x-icon">
    <title>COMMANDE | TEKE ZIK</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">


        <!-- Main Content -->
        <div id="content">


            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                            $result = App::getDB()->rowCount('SELECT * FROM articles INNER JOIN paniers p 
                                                                       ON articles.id = p.article_id
                                                                       WHERE ip="'.get_ip().'" ');

                            // Si une erreur survient
                            if ($result == 0) {
                                echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste des commandes est vide</p>
                            </div>';
                            } else {
                                ?>
                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 text-center">
                                        <h6 class="m-0 font-weight-bold" style="font-size: 25px">Liste des commandes</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable_formation"
                                                   width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>Articles</th>
                                                    <th>Nbre Articles</th>
                                                    <th>Prix Unitaire</th>
                                                    <th>Prix Total</th>
                                                    <th>Image</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>Articles</th>
                                                    <th>Nbre Articles</th>
                                                    <th>Prix Unitaire</th>
                                                    <th>Prix Total</th>
                                                    <th>Image</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>

                                                <?php
                                                foreach (App::getDB()->query('SELECT p.id AS PiD, COUNT(*) AS nbrArticle, name, SUM(price) AS pTotal, price, image, article_id FROM articles INNER JOIN paniers p 
                                                                                       ON articles.id = p.article_id
                                                                                       WHERE ip = "'.get_ip().'"
                                                                                       GROUP BY price') as $ingredient):

                                                    echo '<tr>
                                                <td title="Articles">' . $ingredient->name . '</td> 
                                                <td title="Nbre Articles">' . $ingredient->nbrArticle . '</td>
                                                <td title="Prix Unitaire">' . $ingredient->price . '</td>
                                                <td title="Prix total">' . $ingredient->pTotal . '</td>
                                                <td title="Image"><img class="img-fluid" src="' . str_replace('../img/', 'img/', $ingredient->image) . '" alt="' . $ingredient->name . '" width="100"></td>
                                               <td title="Supprimer"><a href="report.php&delCmd=' . $ingredient->article_id . '" onclick="deleteCmd(' . $ingredient->article_id . '); return false;">Supprimer</a></td>
                                                 
                                            </tr>';
                                                endforeach;
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                    </div>


                    <div class="col-lg-12">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2 col-lg-2"><u><strong>COMMANDE</strong></u></h5>
                            <div class="card shadow mb-4 col-lg-10">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable_formation"
                                               width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>Articles commandés</th>
                                                <th>Prix Total</th>
                                                <th>Moyen de paiement</th>
                                                <th>Bénéficiaire</th>
                                                <th>Telephone</th>
                                                <th>Valider</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $total = 0;
                                            $nbre = 0;
                                            foreach (App::getDB()->query('SELECT COUNT(*) AS nbrArticle, name, SUM(price) AS pTotal 
                                                                                   FROM articles 
                                                                                   INNER JOIN paniers p 
                                                                                   ON articles.id = p.article_id
                                                                                   WHERE ip = "'.get_ip().'"
                                                                                   GROUP BY price') as $ingredient):

                                                $total += $ingredient->pTotal;
                                                $nbre += $ingredient->nbrArticle;
                                            endforeach;

                                            echo '<tr>
                                                <td title="Nbre Articles">' . $nbre . '</td>
                                                <td title="Prix total">' . $total . ' FCFA</td>
                                                <td title="Moyen de paiement" style="max-lines: 1"><img class="img-fluid" src="img/om.webp" width="75">
                                                ou <img class="img-fluid" src="img/mtn.webp" width="75"></td>';

                                              $requete = 'SELECT * FROM users INNER JOIN roles r
                                                          ON users.role_id = r.id 
                                                          WHERE name="administrateur" LIMIT 1';

                                              foreach ($connexion->query($requete) as $user):

                                              echo '<td title="Bénéficiaire">'.$user->last_name.' '.$user->first_name.'</td>
                                                <td title="Telephone">'.$user->phone.'</td>
                                               <td title="Valider"><a href="#">Valider la commande</a></td>';
                                              endforeach;
                                                 
                                            echo '</tr>';

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                    function deleteCmd(element) {
                        if (confirm("Êtes-vous sur de vouloir supprimer cet commande ?")) {
                            console.log('suppression effectué avec succès');


                            setTimeout(function () {
                                $(location).attr('href', "controllers/traitement.php?delCmd=" + element);
                            }, 3000);


                        } else {
                            console.log('suppression annulé');
                        }
                    }

                </script>
            </div>

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php require 'footer.php'; ?>
        <!-- End of Footer -->


    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php require 'allMyModal.php'; ?>
    <?php require 'required_js.php'; ?>

</body>

</html>
