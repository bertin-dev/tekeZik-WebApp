const success_msg = " ajouté avec succès.";
const identite = "utilisateur";
const ingredient = "Tour date";
const playlist = "Playlist";
const cover = "Cover";
const rs = "Réseau social";
const article = "article";
/* ==========================================================================
Ajout des recettes
========================================================================== */
$(function() {

    //souscription users
    $('#singUp input').focus(function () {
        $('#idSiteWebRapport').fadeOut(800);
    });

    $('#singUp').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();


        var statut1 = $('#idSiteWebRapport');
        var nom = $('#last_name').val(),
            prenom = $('#first_name').val(),
            phone = $('#phone').val(),
            email = $('#email').val(),
            password = $('#password').val();


        if (nom == '' || prenom == '' || phone == '' || email == '' || password == '') {
            statut1.html('Veuillez Remplir Tous les Champs').fadeIn(400);
        }


        $('.siteWebUploads').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'json', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#idSiteWebRapport');
                if(data.resultat === 'success'){
                    $('.siteWebUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html(identite + ' ' + success_msg).show();
                    setTimeout(function () {
                        cat.html(identite + ' ' + success_msg).slideDown().hide();
                        /*$('body').load('index.php?id=1', function() {
                        });*/
                        $(location).attr('href',"index.php?id=1");
                    }, 2000);

                } else if(data.resultat === 'success-update'){
                    $('.siteWebUploads').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Publier');
                    cat.html('l\'utilisateur a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html(identite + ' ' + success_msg).slideDown().hide();
                        $('body').load('index.php', function() {
                        });
                    }, 5000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data.resultat).show();
                    $('.siteWebUploads').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});

/* ==========================================================================
Mise à jour des utilisateurs
========================================================================== */
$(function() {
    $('.form_msg, .form_TSW, .form_S, .form_Ft').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'Encours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#rapportMsg, #rapportTSW, #rapportS, #rapportFt, #rapportTSW2, #rapportTSW3, #rapportTSW4, #rapportTSW5');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Un élément a été ajouté avec succès.').show();
                    setTimeout(function () {
                        cat.html('Un élément a été ajouté avec succès.').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"index.php?id=1");
                    }, 3000);

                } else if(data === 'success-update'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-info');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html('Un élément a été Modifié avec succès').show();
                    setTimeout(function () {
                        cat.html('Un élément a été Modifié avec succès').slideDown().hide();
                        //$('body').load('module.php?name=formation', function() {});
                        $(location).attr('href',"index.php?id=1");
                    }, 2000);
                }else {
                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }
                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});


/* ==========================================================================
Ajout des evenements
========================================================================== */
$(function() {
    $('#form_addTourne').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#submenuRapport');
                var result = $('#name');

                var result_submenu1 = $('#result_submenu1');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html(ingredient + ' ' + success_msg).show();


                    if(result.hasClass('is-invalid')){
                        result.removeClass('is-invalid');
                        result.addClass('is-valid');
                    }

                    setTimeout(function () {
                        cat.html(ingredient + ' ' + success_msg).slideDown().hide();
                        /*$('body').load('index.php?id=2', function() {
                        });*/
                        $(location).attr('href',"index.php?id=2");
                    }, 5000);

                } else {

                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    if(result.hasClass('is-valid')){
                        result.removeClass('is-valid');
                        result.addClass('is-invalid');
                    } else{
                        result.addClass('is-invalid');
                    }


                    result_submenu1.removeClass('valid-feedback');
                    result_submenu1.addClass('invalid-feedback');
                    result_submenu1.html(data).show();


                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});



/* ==========================================================================
Ajout des covers
========================================================================== */
$(function() {
    $('#form_addCover').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#submenuRapport11');
                var result = $('#cover_name');

                var result_submenu1 = $('#result_submenu11');
                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html(cover + ' ' + success_msg).show();


                    if(result.hasClass('is-invalid')){
                        result.removeClass('is-invalid');
                        result.addClass('is-valid');
                    }

                    setTimeout(function () {
                        cat.html(cover + ' ' + success_msg).slideDown().hide();
                        /*$('body').load('index.php?id=2', function() {
                        });*/
                        $(location).attr('href',"index.php?id=3");
                    }, 5000);

                } else {

                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    if(result.hasClass('is-valid')){
                        result.removeClass('is-valid');
                        result.addClass('is-invalid');
                    } else{
                        result.addClass('is-invalid');
                    }


                    result_submenu1.removeClass('valid-feedback');
                    result_submenu1.addClass('invalid-feedback');
                    result_submenu1.html(data).show();


                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});






/* ==========================================================================
Ajout des PLAYLISTS
========================================================================== */
$(function() {
    $('#form_playlist').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#submenuRapport12');

                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html(playlist + ' ' + success_msg).show();

                    setTimeout(function () {
                        cat.html(playlist + ' ' + success_msg).slideDown().hide();
                        /*$('body').load('index.php?id=3', function() {
                        });*/
                        $(location).attr('href',"index.php?id=4");
                    }, 2000);

                } else {

                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});



/* ==========================================================================
Attribuer des covers à une PLAYLISTS
========================================================================== */
$(function() {
    $('#form_attr').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#submenuRapport13');

                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html(playlist + ' ' + success_msg).show();

                    setTimeout(function () {
                        cat.html(playlist + ' ' + success_msg).slideDown().hide();
                        /*$('body').load('index.php?id=3', function() {
                        });*/
                        $(location).attr('href',"index.php?id=4");
                    }, 2000);

                } else {

                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});





/* ==========================================================================
Ajout des liens vers les reseaux
========================================================================== */
$(function() {
    $('#form_rs').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#submenuRapport14');

                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html(rs + ' ' + success_msg).show();

                    setTimeout(function () {
                        cat.html(rs + ' ' + success_msg).slideDown().hide();
                        /*$('body').load('index.php?id=3', function() {
                        });*/
                        $(location).attr('href',"index.php?id=5");
                    }, 2000);

                } else {

                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});




/* ==========================================================================
Attribuer des covers à un ou plusieurs réseaux sociaux
========================================================================== */
$(function() {
    $('#form_attr_sm').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#submenuRapport15');

                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html(cover + ' ' + success_msg).show();

                    setTimeout(function () {
                        cat.html(cover + ' ' + success_msg).slideDown().hide();
                        /*$('body').load('index.php?id=3', function() {
                        });*/
                        $(location).attr('href',"index.php?id=5");
                    }, 2000);

                } else {

                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});




/* ==========================================================================
Ajout articles
========================================================================== */
$(function() {
    $('#form_article').on('submit', function (e) {
        /* On empêche le navigateur de soumettre le formulaire*/
        e.preventDefault();
        $('.loader').show();
        $('.currentSend').attr('value', 'En cours...');
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();

        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            contentType: false, /* obligatoire pour de l'upload*/
            processData: false, /* obligatoire pour de l'upload*/
            dataType: 'html', /* selon le retour attendu*/
            data:data,
            success:function(data){
                var cat = $('#submenuRapport16');

                if(data === 'success'){
                    $('.loader').hide();
                    cat.removeClass('alert-danger');
                    cat.addClass('alert-success');
                    $('.currentSend').attr('value', 'Ajouter');
                    cat.html(article + ' ' + success_msg).show();

                    setTimeout(function () {
                        cat.html(article + ' ' + success_msg).slideDown().hide();
                        /*$('body').load('index.php?id=3', function() {
                        });*/
                        $(location).attr('href',"index.php?id=6");
                    }, 2000);

                } else {

                    if(cat.hasClass('alert-success')){
                        cat.removeClass('alert-success');
                        cat.addClass('alert-danger');
                    }

                    cat.html(data).show();
                    $('.loader').hide();
                    $('.currentSend').attr('value', 'Ajouter');
                }
            }

        });
    });
});
