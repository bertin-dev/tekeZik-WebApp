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
                                                <label for="town">Ville </label>
                                                <input id="town" class="form-control" type="text" name="town">
                                            </div>

                                            <div class="form-group">
                                                <label for="quartier">Quartier </label>
                                                <input id="quartier" class="form-control" type="text" name="quartier">
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
                                                    foreach (App::getDB()->query('SELECT id, name FROM role ORDER BY id DESC') as $role):
                                                        echo '<option value="' . $role->id . '">' . $role->name . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <input type="submit"
                                                       class="btn btn-primary btn-user btn-block currentSend"
                                                       value="Ajouter"/>
                                                <center><img src="img/loader.gif" class="siteWebUploads"
                                                             style="display:none;"></center>

                                                <button type="reset" class="btn btn-success">Effacer</button>
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
                <h5 class="modal-title" id="exampleModalLabel">TOUR DATES</h5>
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
                                                <input type="url" class="form-control" id="link_ticket" name="link_ticket"
                                                       aria-describedby="link_ticket" placeholder="Plateforme de distribution tickets">
                                            </div>

                                            <div class="form-group">
                                                <input type="datetime-local" class="form-control" id="start_event" name="start_event"
                                                       aria-describedby="start_event" placeholder="Date d\'ouverture">
                                            </div>


                                            <div class="form-group">
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



<!-- Ajouter compositions -->
<div class="modal fade" id="add_composition" tabindex="-1" role="alertdialog" aria-labelledby="add_composition"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">COMPOSITION</h5>
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
                                        <form id="form_composition" class="user" role="form"
                                              action="controllers/traitement.php?composition=composition" method="post">

                                            <div class="form-group">
                                                <label class="my-1 mr-2" for="recette">Selectionner une recette</label>
                                                <select class="custom-select my-1 mr-sm-2" id="recette" name="recette" style="font-size: 15px!important;">
                                                    <?php
                                                    /*foreach (App::getDB()->query('SELECT id, nom FROM recettes ORDER BY id DESC') AS $menu):
                                                        echo '<option value="' . $menu->id . '">' . $menu->nom . '</option>';
                                                    endforeach;*/
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label class="my-1 mr-2" for="ingredient">Selectionner plusieurs ingrédients (Ctrl + Click)</label>
                                                <select class="custom-select my-1 mr-sm-2" multiple="multiple" id="ingredient" name="ingredient[]" style="font-size: 15px!important;">
                                                    <?php
                                                    /*foreach (App::getDB()->query('SELECT * FROM ingredients ORDER BY id DESC') AS $menu):
                                                        echo '<option value="' . $menu->id . '">' . $menu->nom . ' - ' . $menu->nb_calories . ' calories - quantité: ' . $menu->quantite . ' - unité: ' . $menu->unite . '</option>';
                                                    endforeach;*/
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
