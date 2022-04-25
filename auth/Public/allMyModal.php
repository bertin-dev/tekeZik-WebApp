<!--EN TÊTE-->
<!-- Ajouter utilisateur-->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="add_user" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un utilisateur</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div id="idSiteWebRapport" class="alert alert-danger"
                                             style="display:none;"></div>

                                        <form id="singUp" class="user" role="form"
                                              action="controllers/traitement.php?singUp=singUp" method="post">

                                            <div class="form-group">
                                                <label for="last_name">Nom *</label>
                                                <input id="last_name" aria-describedby="last_name" class="form-control" type="text" name="last_name">
                                            </div>


                                            <div class="form-group">
                                                <label for="first_name">Prénom </label>
                                                <input id="first_name" aria-describedby="first_name" class="form-control" type="text" name="first_name">
                                            </div>

                                            <div class="form-group">
                                                <label for="phone">Telephone *</label>
                                                <input id="phone" class="form-control" type="tel" name="phone" required>

                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email </label>
                                                <input id="email" class="form-control" type="email" name="email">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password *</label>
                                                <input id="password" class="form-control" type="password" name="password" required>
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
                                                <input id="youtube" class="form-control" type="url" name="youtube"
                                                placeholder="https://youtube.com">
                                            </div>

                                            <div class="form-group">
                                                <label for="instagram">Instagram </label>
                                                <input id="instagram" class="form-control" type="url" name="instagram"
                                                placeholder="https://instagram.com">
                                            </div>

                                            <div class="form-group">
                                                <label for="tiktok">Tiktok </label>
                                                <input id="tiktok" class="form-control" type="url" name="tiktok"
                                                       placeholder="https://tiktok.com">
                                            </div>

                                            <div class="form-group">
                                                <label for="facebook">Facebook </label>
                                                <input id="facebook" class="form-control" type="url" name="facebook"
                                                       placeholder="https://facebook.com">
                                            </div>

                                            <div class="form-group">
                                                <label for="twitter">Twitter </label>
                                                <input id="twitter" class="form-control" type="url" name="twitter"
                                                       placeholder="https://twitter.com">
                                            </div>


                                            <div class="form-group">
                                                <label for="spotify">Spotify </label>
                                                <input id="spotify" class="form-control" type="url" name="spotify"
                                                       placeholder="https://spotify.com">
                                            </div>


                                            <div class="form-group">
                                                <label for="amazone">Amazone </label>
                                                <input id="amazone" class="form-control" type="url" name="amazone"
                                                       placeholder="https://amazone.com">
                                            </div>

                                            <div class="form-group">
                                                <label for="youtube_music">YoutubeMusic </label>
                                                <input id="youtube_music" class="form-control" type="url" name="youtube_music"
                                                       placeholder="https://youtube_music.com">
                                            </div>

                                            <div class="form-group">
                                                <label for="apple_music">Apple Music </label>
                                                <input id="apple_music" class="form-control" type="url" name="apple_music"
                                                       placeholder="https://apple_music.com">
                                            </div>

                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Ajouter"/>
                                                <center><img src="img/loader.gif" class="siteWebUploads" style="display:none;"></center>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ajouter Tourné -->
<div class="modal fade" id="add_tourne" tabindex="-1" role="alertdialog" aria-labelledby="add_tourne"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">TOUR DATES</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div id="submenuRapport" class="alert alert-danger" style="display:none;"></div>
                                        <form id="form_addTourne" class="user" role="form"
                                              action="controllers/traitement.php?event=event" method="post">

                                            <div class="form-group">
                                                <input type="text" class="form-control" id="name" name="name"
                                                       aria-describedby="name" placeholder="Libelle Tour Date *" required>
                                                <div id="result_submenu1"></div>
                                            </div>


                                            <div class="form-group">
                                                <input type="text" class="form-control" id="location" name="location"
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
                                                <label for="link_ticket">Ex:https://eventbrite.com</label>
                                                <input type="url" class="form-control" id="link_ticket" name="link_ticket"
                                                       aria-describedby="link_ticket" placeholder="Plateforme de distribution tickets">
                                            </div>

                                            <div class="form-group">
                                                <label for="start_event">Date de début</label>
                                                <input type="datetime-local" class="form-control" id="start_event" name="start_event"
                                                       aria-describedby="start_event" placeholder="Date d\'ouverture">
                                            </div>


                                            <div class="form-group">
                                                <label for="end_event">Date de fin</label>
                                                <input type="datetime-local" class="form-control" id="end_event" name="end_event"
                                                       aria-describedby="end_event" placeholder="Date fermeture">
                                            </div>


                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Ajouter"/>
                                                <center><img src="img/loader.gif" class="loader" style="display:none;">
                                                </center>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>



<!-- Ajouter cover -->
<div class="modal fade" id="add_cover" tabindex="-1" role="alertdialog" aria-labelledby="add_cover"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">COVERS</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div id="submenuRapport11" class="alert alert-danger" style="display:none;"></div>
                                        <form id="form_addCover" class="user contact-form" role="form" enctype="multipart/form-data"
                                              action="controllers/traitement.php?cover=cover" method="post">

                                            <div class="form-group">
                                                <input type="text" class="form-control" id="cover_name" name="cover_name"
                                                       aria-describedby="cover_name" placeholder="Libelle Cover *" required>
                                                <div id="result_submenu11"></div>
                                            </div>


                                            <div class="form-group">
                                                <label for="cover">importer cover</label>
                                                <input type="file" class="form-control-file" id="cover" name="cover"
                                                       aria-describedby="cover" placeholder="Cover *" required>
                                            </div>


                                            <div class="form-group">
                                                <label for="out_date">Date de sortie</label>
                                                <input type="datetime-local" class="form-control" id="out_date" name="out_date"
                                                       aria-describedby="out_date" placeholder="Date de sortie">
                                            </div>


                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Ajouter"/>
                                                <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<!-- Ajouter playlist -->
<div class="modal fade" id="add_playlist" tabindex="-1" role="alertdialog" aria-labelledby="add_playlist"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">AJOUT PLAYLIST</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div id="submenuRapport12" class="alert alert-danger" style="display:none;"></div>
                                        <form id="form_playlist" class="user" role="form"
                                              action="controllers/traitement.php?playlist=playlist" method="post" enctype="multipart/form-data">

                                            <div class="form-group">
                                                <input type="text" class="form-control" id="playlist_name" name="playlist_name"
                                                       aria-describedby="playlist_name" placeholder="titre playlist *" required>
                                            </div>

                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Ajouter"/>
                                                <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<!-- Attribuer cover in playlist -->
<div class="modal fade" id="add_attr" tabindex="-1" role="alertdialog" aria-labelledby="add_attr"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">ATTRIBUER</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">


                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div id="submenuRapport13" class="alert alert-danger" style="display:none;"></div>
                                        <form id="form_attr" class="user" role="form"
                                              action="controllers/traitement.php?attr=attr" method="post">

                                            <div class="form-group">
                                                <label class="my-1 mr-2" for="attr_ply">Selectionner une playlist</label>
                                                <select class="custom-select my-1 mr-sm-2" id="attr_ply" name="attr_ply" style="font-size: 15px!important;">
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM playlists ORDER BY id DESC') AS $menu):
                                                        echo '<option value="' . $menu->id . '">' . $menu->name . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label class="my-1 mr-2" for="ingredient">Selectionner une ou plusieurs covers (Ctrl + Click)</label>
                                                <select class="custom-select my-1 mr-sm-2" multiple="multiple" id="attr_cover" name="attr_cover[]" style="font-size: 15px!important;">
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM covers ORDER BY id DESC') AS $menu):
                                                        echo '<option value="' . $menu->id . '">' . $menu->name . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Ajouter"/>
                                                <center><img src="img/loader.gif" class="loader" style="display:none;">
                                                </center>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<!-- Ajouter link -->
<div class="modal fade" id="add_link" tabindex="-1" role="alertdialog" aria-labelledby="add_link"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">réseau social</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div id="submenuRapport14" class="alert alert-danger" style="display:none;"></div>
                                        <form id="form_rs" class="user" role="form"
                                              action="controllers/traitement.php?rs=rs" method="post" enctype="multipart/form-data">

                                            <div class="form-group">
                                                <input type="text" class="form-control" id="rs_name" name="rs_name"
                                                       aria-describedby="rs_name" placeholder="Nom Réseau social *" required>
                                            </div>

                                            <div class="form-group">
                                                <input type="url" class="form-control" id="link_rs" name="link_rs"
                                                       aria-describedby="link_rs" placeholder="Lien *" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="logo">importer logo</label>
                                                <input type="file" class="form-control-file" id="logo" name="logo"
                                                       aria-describedby="logo" placeholder="Logo *" required>
                                            </div>


                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Ajouter"/>
                                                <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>



<!-- Attributed cover in social media -->
<div class="modal fade" id="add_attr_sm" tabindex="-1" role="alertdialog" aria-labelledby="add_attr_sm"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">ATTRIBUER</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">


                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div id="submenuRapport15" class="alert alert-danger" style="display:none;"></div>
                                        <form id="form_attr_sm" class="user" role="form"
                                              action="controllers/traitement.php?attr_sm=attr_sm" method="post">

                                            <div class="form-group">
                                                <label class="my-1 mr-2" for="attr_ply">Selectionner une cover</label>
                                                <select class="custom-select my-1 mr-sm-2" id="attr_cov" name="attr_cov" style="font-size: 15px!important;">
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM covers ORDER BY id DESC') AS $menu):
                                                        echo '<option value="' . $menu->id . '">' . $menu->name . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label class="my-1 mr-2" for="ingredient">Selectionner un ou plusieur réseaux sociaux (Ctrl + Click)</label>
                                                <select class="custom-select my-1 mr-sm-2" multiple="multiple" id="attr_cov_sm" name="attr_cov_sm[]" style="font-size: 15px!important;">
                                                    <?php
                                                    foreach (App::getDB()->query('SELECT * FROM release_platforms ORDER BY id DESC') AS $menu):
                                                        echo '<option value="' . $menu->id . '">' . $menu->name . ' - Lien: ' . $menu->link_sm . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>


                                        <!--    <div class="form-group">
                                                <input type="text" class="form-control" id="direct_link" name="direct_link"
                                                       aria-describedby="direct_link" placeholder="Lien direct *" required>
                                            </div>-->


                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Ajouter"/>
                                                <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>




<!-- Ajouter article -->
<div class="modal fade" id="add_article" tabindex="-1" role="alertdialog" aria-labelledby="add_article"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Articles</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div id="submenuRapport16" class="alert alert-danger" style="display:none;"></div>
                                        <form id="form_article" class="user" role="form"
                                              action="controllers/traitement.php?article=article" method="post" enctype="multipart/form-data">

                                            <div class="form-group">
                                                <input type="text" class="form-control" id="name" name="name"
                                                       aria-describedby="name" placeholder="Nom de l'article *" required>
                                            </div>

                                            <div class="form-group">
                                                <input type="number" class="form-control" id="prix" name="prix"
                                                       aria-describedby="prix" placeholder="prix *" required>
                                            </div>


                                            <div class="form-group">
                                                <input type="number" class="form-control" id="new_prix" name="new_prix"
                                                       aria-describedby="new_prix" placeholder="Nouveau Prix">
                                            </div>


                                            <div class="form-group">
                                                <label for="image">importer image</label>
                                                <input type="file" class="form-control-file" id="image" name="image"
                                                       aria-describedby="image" placeholder="Image *" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="cover">importer couverture</label>
                                                <input type="file" class="form-control-file" id="cover" name="cover"
                                                       aria-describedby="cover" placeholder="cover ">
                                            </div>


                                            <div class="form-group">
                                                <label class="my-1 mr-2" for="state_article">Etat des articles</label>
                                                <select class="custom-select my-1 mr-sm-2" id="state_article"
                                                        name="state_article">
                                                    <option value="available">Disponible</option>
                                                    <option value="unavailable">Indisponible</option>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Ajouter"/>
                                                <center><img src="img/loader.gif" class="loader" style="display:none;"></center>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
