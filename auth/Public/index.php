<?php
require '../config/Config_Server.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Institut Salomon, IS, formation, centre de formation agréé, minfop, certification, vae, paj, va">
    <meta name="author" content="">
    <meta name="copyright" content="© <?= date('Y', time()); ?>, bertin.dev, Inc.">

    <title>Liste des Recettes</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php require 'sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">


        <!-- Main Content -->
        <div id="content">

            <div class="container-fluid">
                <?php
                if (isset($_GET['id']) && $_GET['id'] == '1') {
                    ?>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Border Left Utilities -->
                        <div class="col-lg-12">
                            <div id="rapportSupp" class="alert alert-danger" style="display:none;"></div>
                            <?php
                            if (isset($_GET['updateUser'])) {
                                foreach (App::getDB()->query('SELECT * FROM users WHERE id=' . $_GET['updateUser']) as $recette):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier Utilisateur</h1>
                                    <div id="rapportMsg" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_msg" role="form"
                                          action="controllers/traitement.php?updateUser=update" method="post">
                                        <input type="hidden" name="user_id" value="<?= $recette->id; ?>">

                                        <div class="form-group">
                                            <label for="last_name">Nom *</label>
                                            <input value="<?= $recette->last_name; ?>" id="last_name" aria-describedby="last_name" class="form-control" type="text" name="last_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="first_name">Prénom </label>
                                            <input value="<?= $recette->first_name; ?>" id="first_name" aria-describedby="first_name" class="form-control" type="text" name="first_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="town">Ville </label>
                                            <input value="<?= $recette->town; ?>" id="town" class="form-control" type="text" name="town">
                                        </div>

                                        <div class="form-group">
                                            <label for="quartier">Quartier </label>
                                            <input value="<?= $recette->quartier; ?>" id="quartier" class="form-control" type="text" name="quartier">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Telephone *</label>
                                            <input value="<?= $recette->phone; ?>" id="phone" class="form-control" type="tel" name="phone" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email </label>
                                            <input value="<?= $recette->email; ?>" id="email" class="form-control" type="email" name="email">
                                        </div>


                                        <div class="form-group">
                                            <label for="password">Password *</label>
                                            <input value="<?= $recette->password; ?>" id="password" class="form-control" type="password" name="password" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="role">Privilèges *</label>
                                            <select id="role" name="role"
                                                    class="form-control">
                                                <?php
                                                foreach (App::getDB()->query('SELECT id, name FROM role ORDER BY id DESC') as $role):
                                                    echo '<option value="' . $role->id . '">' . $role->name . '</option>';
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>



                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                                   value="Modifier"/>
                                            <center><img src="img/loader.gif" class="loader" style="display:none;">
                                            </center>
                                        </div>

                                    </form>
                                <?php
                                endforeach;
                            } else {
                                $result = App::getDB()->rowCount('SELECT id FROM users');

                                // Si une erreur survient
                                if ($result == 0) {
                                    echo '<h1 class="h3 mb-1 text-gray-800">Ajout des utilisateurs</h1>
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste d\'utilisateurs est vide</p>
                            </div>';
                                } else {
                                    ?>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste utilisateurs</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_module" width="100%"
                                                       cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Nom</th>
                                                        <th>Prénom</th>
                                                        <th>ville</th>
                                                        <th>quartier</th>
                                                        <th>phone</th>
                                                        <th>email</th>
                                                        <th>password</th>
                                                        <th>Role</th>
                                                        <th>Etat</th>
                                                        <th>Crée le</th>
                                                        <th>Modifié le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Nom</th>
                                                        <th>Prénom</th>
                                                        <th>ville</th>
                                                        <th>quartier</th>
                                                        <th>phone</th>
                                                        <th>email</th>
                                                        <th>password</th>
                                                        <th>Role</th>
                                                        <th>Etat</th>
                                                        <th>Crée le</th>
                                                        <th>Modifié le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT name, description, users.id AS id, last_name, first_name, town, quartier, phone, email, password, user_state, created_at 
                                                                                           FROM users INNER JOIN role ON users.role_id=role.id
                                                                                           ORDER BY users.id DESC') as $user):

                                                        echo '<tr>
                                                <td title="ID">#' . $user->id . '</td>
                                                <td title="Nom">' . $user->last_name . '</td> 
                                                <td title="Prénom">' . $user->first_name . '</td> 
                                                <td title="Ville">' . $user->town . '</td>
                                                <td title="Quartier">' . $user->quartier . '</td> 
                                                 <td title="Telephone">' . $user->phone . '</td> 
                                                <td title="Email">' . $user->email . '</td>
                                                <td title="Password">' . $user->password . '</td> 
                                                <td title="Privilège">' . $user->name . '</td>
                                                <td title="Etat">Activé</td>
                                                <td title="Crée le">' . date('d/m/Y', $user->created_at) . '</td>
                                                <td title="Modifier"><a href="index.php?id='.$_GET['id'].'&updateUser=' . $user->id . '">Modifier</a></td>
                                                <td title="Supprimer"><a href="index.php?id='.$_GET['id'].'&delUser=' . $user->id . '" onclick="deleteUser(' . $user->id . '); return false;">Supprimer</a></td>
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
                        <script>
                            function deleteUser(element) {

                                if (confirm("Êtes-vous sur de vouloir supprimer cet utilisateur ?")) {
                                    console.log('suppression effectué avec succès');


                                    setTimeout(function () {
                                        $(location).attr('href', "controllers/traitement.php?delUser=" + element);
                                    }, 1000);


                                } else {
                                    console.log('suppression annulé');
                                }
                            }

                        </script>

                    </div>
                    <?php
                } elseif (isset($_GET['id']) && $_GET['id'] == '2') {
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
                                            <input value="<?= $ing->name; ?>" type="text" class="form-control" id="name" name="name"
                                                   aria-describedby="name" placeholder="Libelle Tour Date *" required>
                                        </div>


                                        <div class="form-group">
                                            <input value="<?= $ing->location; ?>" type="text" class="form-control" id="location" name="location"
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
                                            <input value="<?= $ing->link_ticket; ?>" type="url" class="form-control" id="link_ticket" name="link_ticket"
                                                   aria-describedby="link_ticket" placeholder="Plateforme de distribution tickets">
                                        </div>

                                        <div class="form-group">
                                            <input value="<?= $ing->start_event; ?>" type="datetime-local" class="form-control" id="start_event" name="start_event"
                                                   aria-describedby="start_event" placeholder="Date d\'ouverture" required>
                                        </div>

                                        <div class="form-group">
                                            <input value="<?= $ing->end_event; ?>" type="datetime-local" class="form-control" id="end_event" name="end_event"
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
                                $result = App::getDB()->rowCount('SELECT id FROM events');

                                // Si une erreur survient
                                if ($result == 0) {
                                    echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste d\'évenements est vide</p>
                            </div>';
                                } else {
                                    ?>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste des Evenements</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_formation"
                                                       width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Libelle</th>
                                                        <th>Lieu</th>
                                                        <th>Etat des tickets</th>
                                                        <th>Lien des tickets</th>
                                                        <th>Début</th>
                                                        <th>Fin</th>
                                                        <th>Crée le</th>
                                                        <th>Modifié le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Libelle</th>
                                                        <th>Lieu</th>
                                                        <th>Etat des tickets</th>
                                                        <th>Lien des tickets</th>
                                                        <th>Début</th>
                                                        <th>Fin</th>
                                                        <th>Crée le</th>
                                                        <th>Modifié le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>

                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM events
                                                                                                   ORDER BY id DESC') as $ingredient):

                                                        echo '<tr>
                                                <td title="ID">#' . $ingredient->id . '</td>
                                                <td title="Name">' . $ingredient->name . '</td> 
                                                <td title="lieu">' . $ingredient->location . '</td>
                                                <td title="Etat des tickets">' . $ingredient->state_ticket . '</td>
                                                <td title="Lien événement"><a href="' . $ingredient->link_ticket . '">' . $ingredient->link_ticket . '</a></td>
                                                <td title="Debut évément">' . $ingredient->start_event . '</td>
                                                <td title="Fin évément">' . $ingredient->end_event . '</td>
                                                <td title="Crée le">' . $ingredient->created_at . '</td>
                                                <td title="Modifié le">' . $ingredient->updated_at . '</td>
                                                <td title="Modifier"><a href="index.php?id='.$_GET['id'].'&updateEvent=' . $ingredient->id . '">Modifier</a></td>
                                                <td title="Supprimer"><a href="index.php?id='.$_GET['id'].'&delEvent=' . $ingredient->id . '" onclick="deleteEvent(' . $ingredient->id . '); return false;">Supprimer</a></td>
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
                } elseif (isset($_GET['id']) && $_GET['id'] == '3') {
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php

                            $result = App::getDB()->rowCount('SELECT id FROM ingredient_recette');

                            // Si une erreur survient
                            if ($result == 0) {
                                echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre composition est vide</p>
                            </div>';
                            } else {
                                ?>
                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Fiche recette + ingrédients</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable_formation" width="100%"
                                                   cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>#id</th>
                                                    <th>Recette</th>
                                                    <th>nom Ingrédient</th>
                                                    <th>unité Ingrédient</th>
                                                    <th>calorie Ingrédient</th>
                                                    <th>quantité Ingrédient</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#id</th>
                                                    <th>Recette</th>
                                                    <th>nom Ingrédient</th>
                                                    <th>unité Ingrédient</th>
                                                    <th>calorie Ingrédient</th>
                                                    <th>quantité Ingrédient</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>

                                                <?php
                                                foreach (App::getDB()->query('SELECT DISTINCT recettes.nom AS NomRecette, ingredient_recette.id AS MyID, ingredients.nom AS NomIng, ingredients.unite AS unites, ingredients.nb_calories AS calIngredient,
                                                                                            quantite FROM ingredient_recette
                                                                                                   INNER JOIN recettes
                                                                                                   ON ingredient_recette.recette_id = recettes.id  
                                                                                                   INNER JOIN ingredients 
                                                                                                   ON ingredient_recette.ingredient_id = ingredients.id              
                                                                                                   ORDER BY MyID DESC') as $ingredient):

                                                    echo '<tr>
                                                <td title="ID">#' . $ingredient->MyID . '</td>
                                                <td title="Recette">' . $ingredient->NomRecette . '</td> 
                                                <td title="nom Ingrédient">' . $ingredient->NomIng . '</td>
                                                <td title="unité Ingrédient">' . $ingredient->unites . '</td>
                                                <td title="calorie Ingrédient">' . $ingredient->calIngredient . '</td>
                                                <td title="quantité Ingrédient">' . $ingredient->quantite . '</td>
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
                    </div>
                    <?php
                }
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
