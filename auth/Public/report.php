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
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="cover">
    <meta name="author" content="Teke ZIK">
    <meta name="copyright" content="© <?= date('Y', time()); ?>, Teke ZIK.">
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
                <?php
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        if (isset($_GET['updateEvent'])) {
                            foreach (App::getDB()->query('SELECT * FROM events WHERE id=' . $_GET['updateEvent']) as $ing):
                                ?>
                                <h1 class="h3 mb-1 text-gray-800">Modifier Footer</h1>
                                <div id="rapportFt" class="alert alert-danger" style="display:none;"></div>
                                <form class="user form_Ft" role="form"
                                      action="controllers/traitement.php?updateIng=updateIng" method="post">
                                    <input type="hidden" name="event_id" value="<?= $ing->id; ?>">

                                    <div class="form-group">
                                        <input value="<?= $ing->name; ?>" type="text" class="form-control" id="name"
                                               name="name"
                                               aria-describedby="name" placeholder="Libelle Tour Date *" required>
                                    </div>


                                    <div class="form-group">
                                        <input value="<?= $ing->location; ?>" type="text" class="form-control"
                                               id="location" name="location"
                                               aria-describedby="location" placeholder="Lieu *" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="state_ticket">Etat des Tickets</label>
                                        <select class="custom-select my-1 mr-sm-2" id="state_ticket"
                                                name="state_ticket">
                                            <option value="available">Disponible</option>
                                            <option value="unavailable">Indisponible</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input value="<?= $ing->link_ticket; ?>" type="url" class="form-control"
                                               id="link_ticket" name="link_ticket"
                                               aria-describedby="link_ticket"
                                               placeholder="Plateforme de distribution tickets">
                                    </div>

                                    <div class="form-group">
                                        <input value="<?= $ing->start_event; ?>" type="datetime-local"
                                               class="form-control" id="start_event" name="start_event"
                                               aria-describedby="start_event" placeholder="Date d\'ouverture"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <input value="<?= $ing->end_event; ?>" type="datetime-local"
                                               class="form-control" id="end_event" name="end_event"
                                               aria-describedby="end_event" placeholder="Date fermeture" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                               value="Ajouter"/>
                                        <center><img src="img/loader.gif" class="loader" style="display:none;">
                                        </center>
                                    </div>

                                </form>
                            <?php
                            endforeach;
                        } else {
                            $result = App::getDB()->rowCount('SELECT * FROM articles INNER JOIN paniers p 
                                                                       ON articles.id = p.article_id');

                            // Si une erreur survient
                            if ($result == 0) {
                                echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste de commandes est vide</p>
                            </div>';
                            } else {
                                ?>
                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 text-center">
                                        <h6 class="m-0 font-weight-bold text-primary">Liste de commandes</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable_formation"
                                                   width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>#id</th>
                                                    <th>Articles</th>
                                                    <th>Nbre Articles</th>
                                                    <th>Prix Unitaire</th>
                                                    <th>Prix Total</th>
                                                    <th>Image</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#id</th>
                                                    <th>Articles</th>
                                                    <th>Nbre Articles</th>
                                                    <th>Prix Unitaire</th>
                                                    <th>Prix Total</th>
                                                    <th>Image</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>

                                                <?php
                                                foreach (App::getDB()->query('SELECT p.id AS PiD, COUNT(*) AS nbrArticle, name, SUM(price) AS pTotal, price, image FROM articles INNER JOIN paniers p 
                                                                                       ON articles.id = p.article_id
                                                                                       GROUP BY price') as $ingredient):

                                                    echo '<tr>
                                                <td title="ID">#' . $ingredient->PiD . '</td>
                                                <td title="Articles">' . $ingredient->name . '</td> 
                                                <td title="Nbre Articles">' . $ingredient->nbrArticle . '</td>
                                                <td title="Prix Unitaire">' . $ingredient->price . '</td>
                                                <td title="Prix total">' . $ingredient->pTotal . '</td>
                                                <td title="Image"><img class="img-fluid" src="' . str_replace('../img/', 'img/', $ingredient->image) . '" alt="' . $ingredient->name . '" width="100"></td>
                                            
                                                 
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
                        }
                        ?>
                    </div>
                </div>
                <?php
                ?>
                <script>
                    function deleteEvent(element) {
                        if (confirm("Êtes-vous sur de vouloir supprimer cet evenement ?")) {
                            console.log('suppression effectué avec succès');


                            setTimeout(function () {
                                $(location).attr('href', "controllers/traitement.php?delEvent=" + element);
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
