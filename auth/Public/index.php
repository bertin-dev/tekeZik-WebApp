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
    <title>ADMIN | TEKE ZIK</title>

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


            <!-- Topbar -->
            <?php require 'topbar.php'; ?>
            <!-- End of Topbar -->


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
                                            <input value="<?= $recette->last_name; ?>" id="last_name"
                                                   aria-describedby="last_name" class="form-control" type="text"
                                                   name="last_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="first_name">Prénom </label>
                                            <input value="<?= $recette->first_name; ?>" id="first_name"
                                                   aria-describedby="first_name" class="form-control" type="text"
                                                   name="first_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Telephone *</label>
                                            <input value="<?= $recette->phone; ?>" id="phone" class="form-control"
                                                   type="tel" name="phone" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email </label>
                                            <input value="<?= $recette->email; ?>" id="email" class="form-control"
                                                   type="email" name="email">
                                        </div>


                                        <div class="form-group">
                                            <label for="password">Password *</label>
                                            <input value="<?= $recette->password; ?>" id="password" class="form-control"
                                                   type="password" name="password" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="role">Privilèges *</label>
                                            <select id="role" name="role"
                                                    class="form-control">
                                                <?php
                                                foreach (App::getDB()->query('SELECT id, name FROM roles ORDER BY id DESC') as $role):
                                                    echo '<option value="' . $role->id . '">' . $role->name . '</option>';
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>



                                        <div class="form-group">
                                            <label for="youtube">Youtube </label>
                                            <input value="<?= $recette->youtube; ?>" id="youtube" class="form-control" type="url" name="youtube"
                                                   placeholder="https://youtube.com">
                                        </div>

                                        <div class="form-group">
                                            <label for="instagram">Instagram </label>
                                            <input value="<?= $recette->instagram; ?>" id="instagram" class="form-control" type="url" name="instagram"
                                                   placeholder="https://instagram.com">
                                        </div>

                                        <div class="form-group">
                                            <label for="tiktok">Tiktok </label>
                                            <input value="<?= $recette->tiktok; ?>" id="tiktok" class="form-control" type="url" name="tiktok"
                                                   placeholder="https://tiktok.com">
                                        </div>

                                        <div class="form-group">
                                            <label for="facebook">Facebook </label>
                                            <input value="<?= $recette->facebook; ?>" id="facebook" class="form-control" type="url" name="facebook"
                                                   placeholder="https://facebook.com">
                                        </div>

                                        <div class="form-group">
                                            <label for="twitter">Twitter </label>
                                            <input value="<?= $recette->twitter; ?>" id="twitter" class="form-control" type="url" name="twitter"
                                                   placeholder="https://twitter.com">
                                        </div>


                                        <div class="form-group">
                                            <label for="spotify">Spotify </label>
                                            <input value="<?= $recette->spotify; ?>" id="spotify" class="form-control" type="url" name="spotify"
                                                   placeholder="https://spotify.com">
                                        </div>


                                        <div class="form-group">
                                            <label for="amazone">Amazone </label>
                                            <input value="<?= $recette->amazone; ?>" id="amazone" class="form-control" type="url" name="amazone"
                                                   placeholder="https://amazone.com">
                                        </div>

                                        <div class="form-group">
                                            <label for="youtube_music">YoutubeMusic </label>
                                            <input value="<?= $recette->youtube_music; ?>" id="youtube_music" class="form-control" type="url" name="youtube_music"
                                                   placeholder="https://youtube_music.com">
                                        </div>

                                        <div class="form-group">
                                            <label for="apple_music">Apple Music </label>
                                            <input value="<?= $recette->apple_music; ?>" id="apple_music" class="form-control" type="url" name="apple_music"
                                                   placeholder="https://apple_music.com">
                                        </div>


                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                                   value="Modifier"/>
                                            <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
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
                                                        <th>phone</th>
                                                        <th>email</th>
                                                        <th>password</th>
                                                        <th>Role</th>
                                                        <th>Etat</th>
                                                        <th>youtube</th>
                                                        <th>instagram</th>
                                                        <th>tiktok</th>
                                                        <th>facebook</th>
                                                        <th>twitter</th>
                                                        <th>spotify</th>
                                                        <th>amazone</th>
                                                        <th>youtube_music</th>
                                                        <th>apple_music</th>
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
                                                        <th>phone</th>
                                                        <th>email</th>
                                                        <th>password</th>
                                                        <th>Role</th>
                                                        <th>Etat</th>
                                                        <th>youtube</th>
                                                        <th>instagram</th>
                                                        <th>tiktok</th>
                                                        <th>facebook</th>
                                                        <th>twitter</th>
                                                        <th>spotify</th>
                                                        <th>amazone</th>
                                                        <th>youtube_music</th>
                                                        <th>apple_music</th>
                                                        <th>Crée le</th>
                                                        <th>Modifié le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT users.id AS id, last_name, first_name, youtube, instagram, phone, email, password, role_id, user_state, created_at, 
                                                                                           updated_at, tiktok, facebook, twitter, spotify, amazone, youtube_music, apple_music, roles.name
                                                                                           FROM users INNER JOIN roles ON users.role_id=roles.id
                                                                                           ORDER BY users.id DESC') as $user):

                                                        echo '<tr>
                                                <td title="ID">#' . $user->id . '</td>
                                                <td title="Nom">' . $user->last_name . '</td> 
                                                <td title="Prénom">' . $user->first_name . '</td> 
                                                 <td title="Telephone">' . $user->phone . '</td> 
                                                <td title="Email">' . $user->email . '</td>
                                                <td title="Password">' . $user->password . '</td> 
                                                <td title="Privilège">' . $user->name . '</td>
                                                <td title="Etat">Activé</td>
                                                
                                                <td title="youtube"><a href="' . $user->youtube . '">' . $user->youtube . '</a></td>
                                                <td title="instagram"><a href="' . $user->instagram . '">' . $user->instagram . '</a></td> 
                                                <td title="tiktok"><a href="' . $user->tiktok . '">' . $user->tiktok . '</a></td>
                                                <td title="facebook"><a href="' . $user->facebook . '">' . $user->facebook . '</a></td> 
                                                <td title="twitter"><a href="' . $user->twitter . '">' . $user->twitter . '</a></td>
                                                <td title="spotify"><a href="' . $user->spotify . '">' . $user->spotify . '</a></td> 
                                                <td title="amazone"><a href="' . $user->amazone . '">' . $user->amazone . '</a></td>
                                                <td title="youtube_music"><a href="' . $user->youtube_music . '">' . $user->youtube_music . '</a></td> 
                                                <td title="apple_music"><a href="' . $user->apple_music . '">' . $user->apple_music . '</a></td> 
                                                
                                                <td title="Crée le">' . date('d/m/Y', $user->created_at) . '</td>
                                                <td title="Modifier"><a href="index.php?id=' . $_GET['id'] . '&updateUser=' . $user->id . '">Modifier</a></td>
                                                <td title="Supprimer"><a href="index.php?id=' . $_GET['id'] . '&delUser=' . $user->id . '" onclick="deleteUser(' . $user->id . '); return false;">Supprimer</a></td>
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
                }
                elseif (isset($_GET['id']) && $_GET['id'] == '2') {
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
                                          action="controllers/traitement.php?updateEvent=updateEvent" method="post">
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
                                                <td title="Modifier"><a href="index.php?id=' . $_GET['id'] . '&updateEvent=' . $ingredient->id . '">Modifier</a></td>
                                                <td title="Supprimer"><a href="index.php?id=' . $_GET['id'] . '&delEvent=' . $ingredient->id . '" onclick="deleteEvent(' . $ingredient->id . '); return false;">Supprimer</a></td>
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
                }
                elseif (isset($_GET['id']) && $_GET['id'] == '3') {
                    ?>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="rapportTSW" class="alert alert-danger" style="display:none;"></div>
                            <?php
                            if (isset($_GET['updateCover'])) {
                                foreach (App::getDB()->query('SELECT * FROM covers WHERE id=' . $_GET['updateCover']) as $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier cover</h1>
                                    <div id="rapportTSW2" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_TSW" role="form" enctype="multipart/form-data"
                                          action="controllers/traitement.php?updateCover=updateCover" method="post">
                                        <input type="hidden" name="cover_id" value="<?= $mod->id; ?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cover_name"
                                                   id="cover_name" aria-describedby="cover_name"
                                                   value="<?= $mod->name; ?>"
                                                   placeholder="Titre du cover">
                                        </div>

                                        <div class="form-group">
                                            <label for="cover">importer cover</label>
                                            <input type="file" class="form-control-file" id="cover" name="cover"
                                                   value="<?= $mod->cover; ?>"
                                                   aria-describedby="cover" placeholder="Cover *" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="out_date">Date de sortie</label>
                                            <input type="datetime-local" class="form-control" id="out_date"
                                                   name="out_date" value="<?= $mod->out_date; ?>"
                                                   aria-describedby="out_date" placeholder="<?= $mod->out_date; ?>">
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
                                $result = App::getDB()->rowCount('SELECT id FROM covers');

                                // Si une erreur survient
                                if ($result == 0) {
                                    echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste de covers est vide</p>
                            </div>';
                                } else {
                                    ?>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Liste des covers</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_formation"
                                                       width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Titre</th>
                                                        <th>Cover</th>
                                                        <th>Sortie le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Titre</th>
                                                        <th>Cover</th>
                                                        <th>Sortie le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>

                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM covers
                                                                                                   ORDER BY id DESC') as $mod):

                                                        echo '<tr>
                                                <td title="ID">#' . $mod->id . '</td>
                                                <td title="Titre">' . $mod->name . '</td>
                                                <td title="cover"><img class="img-fluid" src="' . str_replace('../img/', 'img/', $mod->cover) . '" alt="' . $mod->name . '" width="100"></td>
                                                <td title="Sortie le">' . $mod->out_date . '</td>
                                                <td title="Modifier"><a href="index.php?id=' . $_GET['id'] . '&updateCover=' . $mod->id . '">Modifier</a></td>
                                                <td title="Supprimer"><a href="index.php?id=' . $_GET['id'] . '&delCover=' . $mod->id . '" onclick="deleteCover(' . $mod->id . '); return false;">Supprimer</a></td>
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
                }
                elseif (isset($_GET['id']) && $_GET['id'] == '4') {
                    ?>
                    <div class="row">
                        <div class="col-lg-4">
                            <?php
                            if (isset($_GET['updatePlaylist'])) {
                                foreach (App::getDB()->query('SELECT * FROM playlists WHERE id=' . $_GET['updatePlaylist']) as $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier cover</h1>
                                    <div id="rapportTSW3" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_TSW" role="form"
                                          action="controllers/traitement.php?updatePlaylist=updatePlaylist"
                                          method="post">
                                        <input type="hidden" name="playlist_id" value="<?= $mod->id; ?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="playlist_name"
                                                   id="playlist_name" aria-describedby="playlist_name"
                                                   value="<?= $mod->name; ?>"
                                                   placeholder="Titre de la playlist">
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
                                $result = App::getDB()->rowCount('SELECT id FROM playlists');
                                // Si une erreur survient
                                if ($result == 0) {
                                    echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre playlist est vide</p>
                            </div>';
                                } else {
                                    ?>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Fiche de Playlist</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_formation"
                                                       width="100%"
                                                       cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Titre</th>
                                                        <th>Créé le</th>
                                                        <th>Modifié le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Titre</th>
                                                        <th>Créé le</th>
                                                        <th>Modifié le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>

                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM playlists             
                                                                                                   ORDER BY id DESC') as $ingredient):

                                                        echo '<tr>
                                                <td title="ID">#' . $ingredient->id . '</td>
                                                <td title="Titre">' . $ingredient->name . '</td> 
                                                <td title="Créé le">' . date('d/m/Y', $ingredient->created_at) . '</td>
                                                <td title="Modifié le">' . date('d/m/Y', $ingredient->updated_at) . '</td>
                                                <td title="Modifier"><a href="index.php?id=' . $_GET['id'] . '&updatePlaylist=' . $ingredient->id . '">Modifier</a></td>
                                                <td title="Supprimer"><a href="index.php?id=' . $_GET['id'] . '&delPlaylist=' . $ingredient->id . '" onclick="deletePlaylist(' . $ingredient->id . '); return false;">Supprimer</a></td>
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
                        <div class="col-lg-8">
                            <?php

                            $result = App::getDB()->rowCount('SELECT id FROM cover_playlist');

                            // Si une erreur survient
                            if ($result == 0) {
                                echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre playlist de cover est vide</p>
                            </div>';
                            } else {
                                ?>
                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Liste de covers attribué à une
                                            Playlist</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable_formation" width="100%"
                                                   cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>#id</th>
                                                    <th>Playlist</th>
                                                    <th>Cover</th>
                                                    <th>Image couverture</th>
                                                    <th>Sortie le</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#id</th>
                                                    <th>Playlist</th>
                                                    <th>Cover</th>
                                                    <th>Image couverture</th>
                                                    <th>Sortie le</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>

                                                <?php
                                                foreach (App::getDB()->query('SELECT DISTINCT playlists.name AS playlistName, cover_playlist.id AS MyID, covers.name AS coverName, covers.cover AS coverImg, out_date
                                                                                                   FROM cover_playlist
                                                                                                   INNER JOIN covers
                                                                                                   ON cover_playlist.cover_id = covers.id  
                                                                                                   INNER JOIN playlists 
                                                                                                   ON cover_playlist.playlist_id = playlists.id              
                                                                                                   ORDER BY MyID DESC') as $ingredient):

                                                    echo '<tr>
                                                <td title="ID">#' . $ingredient->MyID . '</td>
                                                <td title="Playlist">' . $ingredient->playlistName . '</td> 
                                                <td title="Titre">' . $ingredient->coverName . '</td>
                                                <td title="cover"><img class="img-fluid" src="' . str_replace('../img/', 'img/', $ingredient->coverImg) . '" alt="' . $ingredient->coverName . '" width="100"></td>
                                                <td title="Sortie le">' . $ingredient->out_date . '</td>
                                                <td title="Modifier"><a href="index.php?id=' . $_GET['id'] . '&updateCoverPlayList=' . $ingredient->MyID . '">Modifier</a></td>
                                                <td title="Supprimer"><a href="index.php?id=' . $_GET['id'] . '&delCoverPlayList=' . $ingredient->MyID . '" onclick="deleteCoverPlayList(' . $ingredient->MyID . '); return false;">Supprimer</a></td>
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
                elseif (isset($_GET['id']) && $_GET['id'] == '5') {
                    ?>
                    <div class="row">
                        <div class="col-lg-4">
                            <?php
                            if (isset($_GET['update_rs'])) {
                                foreach (App::getDB()->query('SELECT * FROM release_platforms WHERE id=' . $_GET['update_rs']) as $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier cover</h1>
                                    <div id="rapportTSW4" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_TSW" role="form"
                                          action="controllers/traitement.php?update_rs=update_rs"
                                          method="post">
                                        <input type="hidden" name="rs_id" value="<?= $mod->id; ?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="rs_name"
                                                   id="rs_name" aria-describedby="rs_name"
                                                   value="<?= $mod->name; ?>"
                                                   placeholder="Nom du réseau social">
                                        </div>


                                        <div class="form-group">
                                            <input value="<?= $mod->link_sm; ?>" type="url" class="form-control" id="link_rs" name="link_rs"
                                                   aria-describedby="link_rs" placeholder="Lien *" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="logo">importer logo</label>
                                            <input value="<?= $mod->logo; ?>" type="file" class="form-control-file" id="logo" name="logo"
                                                   aria-describedby="logo" placeholder="Logo *" required>
                                        </div>


                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                                   value="Ajouter"/>
                                            <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
                                        </div>

                                    </form>
                                <?php
                                endforeach;
                            } else {
                                $result = App::getDB()->rowCount('SELECT id FROM release_platforms');
                                // Si une erreur survient
                                if ($result == 0) {
                                    echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste de réseaux sociaux est vide</p>
                            </div>';
                                } else {
                                    ?>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Fiche de réseaux sociaux</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_formation"
                                                       width="100%"
                                                       cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Nom</th>
                                                        <th>Lien</th>
                                                        <th>Logo reseau social</th>
                                                        <th>Créé le</th>
                                                        <th>Modifié le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Nom</th>
                                                        <th>Lien</th>
                                                        <th>Logo reseau social</th>
                                                        <th>Créé le</th>
                                                        <th>Modifié le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>

                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM release_platforms             
                                                                                                   ORDER BY id DESC') as $ingredient):

                                                        echo '<tr>
                                                <td title="ID">#' . $ingredient->id . '</td>
                                                <td title="Titre">' . $ingredient->name . '</td> 
                                                <td title="Lien">' . $ingredient->link_sm . '</td> 
                                                <td title="logo"><img class="img-fluid" src="' . str_replace('../img/', 'img/', $ingredient->logo) . '" alt="' . $ingredient->name . '"></td>
                                                <td title="Créé le">' . date('d/m/Y', $ingredient->created_at) . '</td>
                                                <td title="Modifié le">' . date('d/m/Y', $ingredient->updated_at) . '</td>
                                                <td title="Modifier"><a href="index.php?id=' . $_GET['id'] . '&update_rs=' . $ingredient->id . '">Modifier</a></td>
                                                <td title="Supprimer"><a href="index.php?id=' . $_GET['id'] . '&del_rs=' . $ingredient->id . '" onclick="delete_rs(' . $ingredient->id . '); return false;">Supprimer</a></td>
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
                        <div class="col-lg-8">
                            <?php

                            $result = App::getDB()->rowCount('SELECT id FROM cover_release_platform');

                            // Si une erreur survient
                            if ($result == 0) {
                                echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre list de cover est vide</p>
                            </div>';
                            } else {
                                ?>
                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Liste de covers attribué à un
                                            réseau social</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable_formation" width="100%"
                                                   cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>#id</th>
                                                    <th>Cover</th>
                                                    <th>Image couverture</th>
                                                    <th>Sortie le</th>
                                                    <th>réseau social</th>
                                                    <th>lien</th>
                                                    <th>logo reseau social</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#id</th>
                                                    <th>Cover</th>
                                                    <th>Image couverture</th>
                                                    <th>Sortie le</th>

                                                    <th>réseau social</th>
                                                    <th>lien</th>
                                                    <th>logo reseau social</th>
                                                    <th>Modifier</th>
                                                    <th>Supprimer</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>

                                                <?php
                                                foreach (App::getDB()->query('SELECT DISTINCT covers.name AS coversName, cover_release_platform.id AS MyID, covers.cover AS coverImg, out_date,
                                                                                                   release_platforms.id, release_platforms.name AS rpName, release_platforms.link_sm AS rpLink, release_platforms.logo AS rpLogo
                                                                                                   FROM cover_release_platform
                                                                                                   INNER JOIN covers
                                                                                                   ON cover_release_platform.cover_id = covers.id  
                                                                                                   INNER JOIN release_platforms 
                                                                                                   ON cover_release_platform.release_platform_id = release_platforms.id              
                                                                                                   ORDER BY MyID DESC') as $ingredient):

                                                    echo '<tr>
                                                <td title="ID">#' . $ingredient->MyID . '</td>
                                                <td title="Titre">' . $ingredient->coversName . '</td>
                                                <td title="cover"><img class="img-fluid" src="' . str_replace('../img/', 'img/', $ingredient->coverImg) . '" alt="' . $ingredient->coversName . '" width="100"></td>
                                                <td title="Sortie le">' . $ingredient->out_date . '</td>
                                                
                                                 <td title="reseau social">' . $ingredient->rpName . '</td> 
                                                 <td title="lien">' . $ingredient->rpLink . '</td> 
                                                 <td title="cover"><img class="img-fluid" src="' . str_replace('../img/', 'img/', $ingredient->rpLogo) . '" alt="' . $ingredient->rpName . '"></td>
                                               
                                                 
                                                <td title="Modifier"><a href="index.php?id=' . $_GET['id'] . '&update_rp=' . $ingredient->MyID . '">Modifier</a></td>
                                                <td title="Supprimer"><a href="index.php?id=' . $_GET['id'] . '&del_rp=' . $ingredient->MyID . '" onclick="delete_rp(' . $ingredient->MyID . '); return false;">Supprimer</a></td>
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
                elseif (isset($_GET['id']) && $_GET['id'] == '6') {
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if (isset($_GET['update_article'])) {
                                foreach (App::getDB()->query('SELECT * FROM articles WHERE id=' . $_GET['update_article']) as $mod):
                                    ?>
                                    <h1 class="h3 mb-1 text-gray-800">Modifier article</h1>
                                    <div id="rapportTSW5" class="alert alert-danger" style="display:none;"></div>
                                    <form class="user form_TSW" role="form"
                                          action="controllers/traitement.php?update_article=update_article"
                                          method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="article_id" value="<?= $mod->id; ?>">

                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name"
                                                   id="name" aria-describedby="name"
                                                   value="<?= $mod->name; ?>"
                                                   placeholder="Nom de l'article">
                                        </div>


                                        <div class="form-group">
                                            <input value="<?= $mod->price; ?>" type="number" class="form-control" id="prix" name="prix"
                                                   aria-describedby="prix" placeholder="prix *" required>
                                        </div>

                                        <div class="form-group">
                                            <input value="<?= $mod->new_price; ?>" type="number" class="form-control" id="new_prix" name="new_prix"
                                                   aria-describedby="new_prix" placeholder="new_prix ">
                                        </div>


                                        <div class="form-group">
                                            <label for="image">importer image</label>
                                            <input value="<?= $mod->image; ?>" type="file" class="form-control-file" id="image" name="image"
                                                   aria-describedby="logo" placeholder="image *" required>
                                        </div>


                                        <div class="form-group">
                                            <label for="cover">importer couverture</label>
                                            <input type="file" class="form-control-file" id="cover" name="cover"
                                                   aria-describedby="cover" placeholder="cover ">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-user btn-block currentSend"
                                                   value="Ajouter"/>
                                            <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
                                        </div>

                                        <div class="form-group">
                                            <label class="my-1 mr-2" for="state_article">Etat des articles</label>
                                            <select class="custom-select my-1 mr-sm-2" id="state_article"
                                                    name="state_article">
                                                <option value="available">Disponible</option>
                                                <option value="unavailable">Indisponible</option>
                                            </select>
                                        </div>

                                    </form>
                                <?php
                                endforeach;
                            } else {
                                $result = App::getDB()->rowCount('SELECT id FROM articles');
                                // Si une erreur survient
                                if ($result == 0) {
                                    echo '
                            <div class="card shadow mb-4 text-center">
                            <p>Votre liste d\'articles est vide</p>
                            </div>';
                                } else {
                                    ?>
                                    <!-- DataTales Example -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Fiche des articles</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable_formation"
                                                       width="100%"
                                                       cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Nom</th>
                                                        <th>prix</th>
                                                        <th>prix en solde</th>
                                                        <th>Etat</th>
                                                        <th>Image</th>
                                                        <th>Couverture</th>
                                                        <th>Créé le</th>
                                                        <th>Modifié le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Nom</th>
                                                        <th>prix</th>
                                                        <th>prix en solde</th>
                                                        <th>Etat</th>
                                                        <th>Image</th>
                                                        <th>Couverture</th>
                                                        <th>Créé le</th>
                                                        <th>Modifié le</th>
                                                        <th>Modifier</th>
                                                        <th>Supprimer</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>

                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM articles             
                                                                                                   ORDER BY id DESC') as $ingredient):

                                                        echo '<tr>
                                                <td title="ID">#' . $ingredient->id . '</td>
                                                <td title="Nom">' . $ingredient->name . '</td> 
                                                <td title="prix">' . $ingredient->price . '</td>
                                                <td title="prix en solde">' . $ingredient->new_price . '</td> 
                                                <td title="etat">' . $ingredient->state . '</td>
                                                <td title="Image"><img class="img-fluid" src="' . str_replace('../img/', 'img/', $ingredient->image) . '" alt="' . $ingredient->name . '"></td>
                                                <td title="couverture"><img class="img-fluid" src="' . str_replace('../img/', 'img/', $ingredient->cover) . '" alt="' . $ingredient->name . '"></td>
                                                <td title="Créé le">' . date('d/m/Y', $ingredient->created_at) . '</td>
                                                <td title="Modifié le">' . date('d/m/Y', $ingredient->updated_at) . '</td>
                                                <td title="Modifier"><a href="index.php?id=' . $_GET['id'] . '&update_article=' . $ingredient->id . '">Modifier</a></td>
                                                <td title="Supprimer"><a href="index.php?id=' . $_GET['id'] . '&del_article=' . $ingredient->id . '" onclick="delete_article(' . $ingredient->id . '); return false;">Supprimer</a></td>
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
                }
                else {
                    ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <h5>Covers attribués à une playlist</h5>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <?php
                        $requet = 'SELECT cover_playlist.id AS cPlyID, cover_playlist.cover_id, cover_playlist.playlist_id, 
                                          covers.id, covers.name, covers.cover, covers.out_date, covers.user_id, covers.created_at, covers.updated_at, 
                                          p.id AS PlyID, p.name AS PlyName, p.created_at, p.updated_at 
                                   FROM cover_playlist INNER JOIN covers ON cover_playlist.cover_id = covers.id
                                   INNER JOIN playlists p on cover_playlist.playlist_id = p.id';

                        foreach ($connexion->query($requet . ' GROUP BY PlyID ORDER BY cPlyID DESC') as $retour):
                            echo '<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">' . $retour->PlyName . '</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">' . $connexion->rowCount($requet . ' WHERE cover_playlist.playlist_id=' . $retour->PlyID) . '</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
                        endforeach;
                        ?>
                        <br>

                        <div class="col-xl-12 col-md-12">
                            <h5>utilisateurs par rôle</h5>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <?php
                        $requet = 'SELECT * FROM roles';

                        foreach ($connexion->query($requet . ' ORDER BY id DESC') as $retour):
                            echo '<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">' . $retour->name . '</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">' . $connexion->rowCount('SELECT * FROM users 
                                                            INNER JOIN roles
                                                            ON users.role_id=roles.id
                                                            WHERE users.role_id=' . $retour->id) . '</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
                        endforeach;
                        ?>
                        <br>

                        <div class="col-xl-12 col-md-12">
                            <h5>Tour dates par utilisateur</h5>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <?php
                        $requet = 'SELECT DISTINCT users.id AS uid, last_name, first_name, phone, email, password, role_id, user_state,
                                  events.id AS eid, name, location, state_ticket, link_ticket, user_id, start_event, end_event
                                 FROM users INNER JOIN events ON events.user_id = users.id';

                        foreach ($connexion->query($requet . ' ORDER BY events.id DESC') as $retour):
                            echo '<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">' . $retour->first_name . '</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">' . $connexion->rowCount($requet . ' WHERE events.id=' . $retour->eid) . '</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
                        endforeach;
                        ?>
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

                    function deleteCover(element) {
                        if (confirm("Êtes-vous sur de vouloir supprimer ce cover ?")) {
                            console.log('suppression effectué avec succès');


                            setTimeout(function () {
                                $(location).attr('href', "controllers/traitement.php?delCover=" + element);
                            }, 3000);


                        } else {
                            console.log('suppression annulé');
                        }
                    }

                    function deletePlaylist(element) {
                        if (confirm("Êtes-vous sur de vouloir supprimer cette playlist ?")) {
                            console.log('suppression effectué avec succès');


                            setTimeout(function () {
                                $(location).attr('href', "controllers/traitement.php?delPlaylist=" + element);
                            }, 3000);


                        } else {
                            console.log('suppression annulé');
                        }
                    }


                    function deleteCoverPlayList(element) {
                        if (confirm("Êtes-vous sur de vouloir effectuer une supression ?")) {
                            console.log('suppression effectué avec succès');


                            setTimeout(function () {
                                $(location).attr('href', "controllers/traitement.php?delCoverPlayList=" + element);
                            }, 3000);


                        } else {
                            console.log('suppression annulé');
                        }
                    }


                    function delete_rs(element) {
                        if (confirm("Êtes-vous sur de vouloir supprimer ce réseau social ?")) {
                            console.log('suppression effectué avec succès');


                            setTimeout(function () {
                                $(location).attr('href', "controllers/traitement.php?del_rs=" + element);
                            }, 3000);


                        } else {
                            console.log('suppression annulé');
                        }
                    }

                    function delete_rp(element) {
                        if (confirm("Êtes-vous sur de vouloir supprimer ce réseau social ?")) {
                            console.log('suppression effectué avec succès');


                            setTimeout(function () {
                                $(location).attr('href', "controllers/traitement.php?del_rp=" + element);
                            }, 3000);


                        } else {
                            console.log('suppression annulé');
                        }
                    }


                    function delete_article(element) {
                        if (confirm("Êtes-vous sur de vouloir supprimer cet article ?")) {
                            console.log('suppression effectué avec succès');


                            setTimeout(function () {
                                $(location).attr('href', "controllers/traitement.php?del_article=" + element);
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
