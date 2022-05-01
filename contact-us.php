<?php
require 'auth/config/Config_Server.php';
session_start();
$connexion = App::getDB();

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, maximum-scale=1" name="viewport">

    <title>CONTACT | Teke ZIK</title>
    <link href="tz.png" rel="icon" type="image/png">
    <link href="tz.ico" rel="shortcut icon" type="img/x-icon">

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,800italic,700italic,600italic,400italic,300italic,800,700,600'
          rel='stylesheet' type='text/css'>

    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <link href="css/animate.css" rel="stylesheet" type="text/css">

    <!--[if IE]>
    <style type="text/css">.pie {
        behavior: url(PIE.htc);
    }</style><![endif]-->

    <script src="js/jquery.1.8.3.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <!--<script src="js/jquery-scrolltofixed.js" type="text/javascript"></script>
    <script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="js/jquery.isotope.js" type="text/javascript"></script>
    <script src="js/wow.js" type="text/javascript"></script>
    <script src="js/classie.js" type="text/javascript"></script>-->


    <!--[if lt IE 9]>
    <script src="js/respond-1.1.0.min.js"></script>
    <script src="js/html5shiv.js"></script>
    <script src="js/html5element.js"></script>
    <![endif]-->


</head>
<body class="medium-button-style-outline">

<div id="siteWrapper">

    <div class="index-section-image content-fill">
        <header>
            <nav class="main-nav-outer text-center" id="test" style="margin-left: -53px;margin-bottom: -1px;"><!--main-nav-start-->
                <div class="container">
                    <ul class="main-nav" style="white-space: normal;display: block;">
                        <li><a href="index.php#header">HOME</a></li>
                        <li><a href="index.php#service">TOUR</a></li>
                        <!--<li><a href="#music">MUSIC</a></li>-->
                        <li><a href="index.php#merch">MERCH</a></li>
                        <li class="small-logo">
                            <a class="logo animated fadeInDown delay-07s" href="index.php#header">
                                <img alt="Teke Zik" title="Teke Zik" src="tz.png"></a>
                        </li>
                        <li><a href="index.php#video">VIDEO</a></li>
                        <li><a href="index.php#follow">FOLLOW</a></li>
                        <li><a href="index.php#contact">CONTACT</a></li>
                    </ul>
                    <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
                </div>
            </nav><!--main-nav-end-->
        </header>
        <div class="index-image-overlay"></div>
    </div>


    <section>
        <div class="container">
            <div class="row">
                <div class="sqs-block html-block sqs-block-html col-lg-12" data-block-type="2"
                     id="block-yui_3_17_2_1_1587740377942_35202">
                    <div class="sqs-block-content">
                        <h1 style="text-align:center;white-space:pre-wrap;">CONTACTEZ-NOUS</h1>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div id="idContact2" class="alert alert-danger"
                         style="display:none;"></div>
                    <form id="singContact2" class="user" role="form" method="post"
                          action="auth/Public/controllers/traitement.php?singContact2=singContact2">

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">Prénom *</label>
                                <input type="text" class="form-control" id="first_name" placeholder="Prénom" name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">Nom *</label>
                                <input type="text" class="form-control" id="last_name" placeholder="Nom" name="last_name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="email">Addresse Email *</label>
                                <input type="email" class="form-control" id="email" placeholder="Ex: contact@tekezik.com" required name="email">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="subject">Objet *</label>
                                <input type="text" class="form-control" id="subject" placeholder="Objet" name="subject" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12 mb-3">
                            <label for="message">Message *</label>
                            <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group col-md-12 mb-3">
                            <button class="btn btn-primary currentSend" type="submit">Envoyer</button>
                            <img src="auth/Public/img/loader.gif" class="siteWebUploads" style="display:none;">
                        </div>
                    </form>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </section>


    <footer class="footer" id="contact">
        <div class="container">
            <div class="row">

                <div class="nav-wrapper desktop-nav-wrapper" id="secondaryNavWrapper">
                    <nav data-content-field="navigation" id="secondaryNavigation">
                        <?php
                        $requete = 'SELECT * FROM users INNER JOIN roles r
                                                             ON users.role_id = r.id 
                                                             WHERE name="administrateur" LIMIT 1';
                        foreach ($connexion->query($requete) as $user):

                            echo '<div class="">
                            <a class="external" href="'.$user->youtube.'" target="_blank">
                                <span>YOUTUBE</span>
                            </a>
                        </div>
                        <div class="">
                            <a class="external" href="'.$user->instagram.'" target="_blank">
                                <span>INSTAGRAM</span>
                            </a>
                        </div>
                        <div class="">
                            <a class="external" href="'.$user->tiktok.'">
                                <span>TIKTOK</span>
                            </a>
                        </div>
                        <div class="">
                            <a class="external" href="'.$user->facebook.'" target="_blank">
                                <span>FACEBOOK</span>
                            </a>
                        </div>
                        <div class="">
                            <a class="external" href="'.$user->twitter.'" target="_blank">
                                <span>TWITTER</span>
                            </a>
                        </div>
                        <div class="collection">
                            <a class="external" href="#">
                                <span>PRIVACY POLICY</span>
                            </a>
                        </div>';

                        endforeach;
                        ?>
                    </nav>
                </div>

                <div id="siteInfo">
                    <?php
                    foreach ($connexion->query($requete) as $user):

                        echo '<a class="site-email" href="mailto:3peacemanagement@gmail.com">'.$user->email.'</a>';
                    endforeach;
                    ?>
                </div>


                <div class="col-lg-12">
                    <div class="sqs-block horizontalrule-block sqs-block-horizontalrule" data-block-type="47"
                         id="block-yui_3_17_2_1_1545330975522_32055">
                        <div class="sqs-block-content">
                            <hr>
                        </div>
                    </div>
                    <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                         id="block-713fe491a2c303b33937">
                        <div class="sqs-block-content">
                            <p class="" style="text-align:center;white-space:pre-wrap;">©️ Teke ZIK - <?= date('Y', time()); ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>

    <script>
        $(function() {

            //souscription users
            $('#singContact2 input').focus(function () {
                $('#idContact2').fadeOut(800);
            });

            $('#singContact2').on('submit', function (e) {
                /* On empêche le navigateur de soumettre le formulaire*/
                e.preventDefault();


                var statut1 = $('#idContact2');
                var email = $('#email').val(),
                    firstname = $('#first_name').val(),
                    lastname = $('#last_name').val(),
                    subject = $('#subject').val(),
                    message = $('#message').val();


                if (email === '' || firstname === '' || lastname === '' || subject === '' || message === '') {
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
                        var cat = $('#idContact2');
                        if(data.resultat === 'success'){
                            $('.siteWebUploads').hide();
                            cat.removeClass('alert-danger');
                            cat.addClass('alert-success');
                            $('.currentSend').attr('value', 'Submit');
                            cat.html("Email enregistré avec succès").show();
                            setTimeout(function () {
                                cat.html("Message enregistré avec succès").slideDown().hide();
                                /*$('body').load('index.php?id=1', function() {
                                });*/
                                $(location).attr('href',"index.php");
                            }, 2000);

                        } else if(data.resultat === 'success-update'){
                            $('.siteWebUploads').hide();
                            cat.removeClass('alert-danger');
                            cat.addClass('alert-info');
                            $('.currentSend').attr('value', 'Submit');
                            cat.html('l\'utilisateur a été Modifié avec succès').show();
                            setTimeout(function () {
                                cat.html("utilisateur modifié avec succès.").slideDown().hide();
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
                            $('.currentSend').attr('value', 'Submit');
                        }
                    }

                });
            });
        });
    </script>

</div>
</body>
</html>