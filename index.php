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

    <title>HOME | Teke ZIK</title>
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
    <script src="js/jquery-scrolltofixed.js" type="text/javascript"></script>
    <script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="js/jquery.isotope.js" type="text/javascript"></script>
    <script src="js/wow.js" type="text/javascript"></script>
    <script src="js/classie.js" type="text/javascript"></script>


    <!--[if lt IE 9]>
    <script src="js/respond-1.1.0.min.js"></script>
    <script src="js/html5shiv.js"></script>
    <script src="js/html5element.js"></script>
    <![endif]-->


</head>
<body class="medium-button-style-outline">

<div id="siteWrapper">





    <div style="overflow:hidden;">
        <header class="header" id="header">
            <div class="container">
                <div class="row">
                    <header>
                        <nav class="text-center" id="myHeader"><!--main-nav-start-->
                            <div class="container">
                                <ul class="main-nav" style="white-space: normal;display: block;">
                                    <li><a href="#header">HOME</a></li>
                                    <li><a href="#service">TOUR</a></li>
                                    <!--<li><a href="#music">MUSIC</a></li>-->
                                    <li><a href="#merch">MERCH</a></li>
                                    <li class="small-logo">
                                        <a class="logo animated fadeInDown delay-07s" href="#header"><img alt="" src="tz.png"></a>
                                    </li>
                                    <li><a href="#video">VIDEO</a></li>
                                    <li><a href="#follow">FOLLOW</a></li>
                                    <li><a href="#contact">CONTACT</a></li>
                                </ul>
                                <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
                            </div>
                        </nav><!--main-nav-end-->
                    </header>
                </div>
            </div>
        </header>
    </div>


    <div class="index-section-image content-fill">
        <header>
            <nav class="main-nav-outer text-center" id="test"><!--main-nav-start-->
                <div class="container">
                    <ul class="main-nav" style="white-space: normal;display: block;">
                        <li><a href="#header">HOME</a></li>
                        <li><a href="#service">TOUR</a></li>
                        <!--<li><a href="#music">MUSIC</a></li>-->
                        <li><a href="#merch">MERCH</a></li>
                        <li class="small-logo">
                            <a class="logo animated fadeInDown delay-07s" href="#header"><img alt="" src="tz.png"></a>
                        </li>
                        <li><a href="#video">VIDEO</a></li>
                        <li><a href="#follow">FOLLOW</a></li>
                        <li><a href="#contact">CONTACT</a></li>
                    </ul>
                    <a class="res-nav_click" href="#"><i class="fa-bars"></i></a>
                </div>
            </nav><!--main-nav-end-->
        </header>
        <div class="index-image-overlay"></div>
    </div>


    <section class="main-section" id="service"><!--main-section-start-->
        <div class="container">
            <h1 class="entry-title">
                <center data-preserve-html-node="true">
                    <span data-preserve-html-node="true">BOOKING</span>
                </center>
            </h1>

            <div class="sqs-block sqs-block-horizontalrule"
                 data-block-type="47">
                <div class="sqs-block-content">
                    <hr>
                </div>
            </div>

            <?php


            $date = date_create(date('Y-m-d'));
            date_add($date, date_interval_create_from_date_string('7 days'));
            //echo date_format($date, 'Y-m-d');
            setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
            /*
             * @param CURDATE()
             * @return 0=monday, 1=tuesday, 2=wednesday, 3=thursday, 4=friday, 5=saturday, 6=sunday
             */

            $currentDay = $connexion->query('SELECT WEEKDAY( CURDATE() ) AS day');

            if($currentDay[0]->day==4){
                $connexion->update('UPDATE events SET start_event=:start_event, updated_at=:updated_at WHERE id=:id',
                    array('start_event'=>date_format($date, 'Y-m-d') .' 20:00:00', 'updated_at'=>time(),
                        'id' => 2));
            }

            if($currentDay[0]->day==5){
                $connexion->update('UPDATE events SET start_event=:start_event, updated_at=:updated_at WHERE id=:id',
                    array('start_event'=>date_format($date, 'Y-m-d') .' 17:00:00', 'updated_at'=>time(),
                        'id' => 1));
            }

            foreach ($connexion->query('SELECT id, name, location, state_ticket, link_ticket, 
                                                 created_at, updated_at, user_id, DATE_FORMAT(start_event, "%a") AS a, DATE_FORMAT(start_event, "%M") AS m, DATE_FORMAT(start_event, "%D") AS d,
                                                 DATE_FORMAT(start_event, "%h:%i%p") AS hour, end_event 
                                                 FROM events ORDER BY id DESC LIMIT 8') as $tour_date):

                echo '<div class="row">
                <div class="col-lg-12 col-sm-12 wow fadeInLeft delay-05s"
                     style="padding-top: 50px; padding-bottom: 50px;">
                    <div class="service-list">
                        <div class="service-list-col2 col-lg-4 col-md-4">
                            <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                                 id="block-yui_3_17_2_1_1642100407572_175616">
                                <div class="sqs-block-content">
                                    <h2 style="text-align:center;white-space:pre-wrap;color: white">'.$tour_date->a.' '.$tour_date->m.' '.strtoupper($tour_date->d).'<br><br>'.strtoupper($tour_date->hour).'</h2>
                                </div>
                            </div>
                        </div>

                        <div class="service-list-col2 col-lg-4 col-md-4">
                            <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                                 id="block-yui_3_17_2_1_1642100407572_180618">
                                <div class="sqs-block-content">
                                    <h2 style="text-align:center;white-space:pre-wrap;color: white">'.strtoupper($tour_date->location).'<br><br>'.strtoupper($tour_date->name).'</h2>
                                </div>
                            </div>
                        </div>';

            if($tour_date->state_ticket == 'available'){
                echo '<div class="service-list-col2 col-lg-4 col-md-4 animated fadeInUp delay-1s">
                            <div class="sqs-block button-block sqs-block-button" data-block-type="53"
                                 id="block-yui_3_17_2_1_1642100407572_178508">
                                <div class="sqs-block-content" id="yui_3_17_2_1_1649089012158_138">
                                    <div class="sqs-block-button-container sqs-block-button-container--center"
                                         data-alignment="center" data-animation-role="button" data-button-size="medium"
                                         data-button-type="primary" id="yui_3_17_2_1_1649089012158_137">
                                        <a class="sqs-block-button-element--medium sqs-button-element--primary sqs-block-button-element"
                                           data-initialized="true"
                                           href="'.$tour_date->link_ticket.'">
                                            Réservation
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }

                    echo '</div>
                </div>
            </div>

            <div class="sqs-block sqs-block-horizontalrule"
                 data-block-type="48">
                <div class="sqs-block-content">
                    <hr>
                </div>
            </div>';
            endforeach;
            ?>


        </div>
    </section><!--main-section-end-->

    <?php
    $requete = 'SELECT * FROM users INNER JOIN roles r
                ON users.role_id = r.id 
                WHERE name="administrateur" LIMIT 1';
    ?>
    <!--main-section client-part-start-->
    <!--<section class="main-section client-part index-section-image content-fill" id="music" style="overflow: hidden">

        <div class="index-section-wrapper">
            <div class="index-image-overlay"></div>

            <div class="content page-content has-main-media has-main-image tmpl-loading" id="music-page">
                <div class="content-inner has-content">


                    <?php
                    $query = 'SELECT cover_playlist.id AS myID, cover_playlist.cover_id,
                                                         cover_playlist.playlist_id, 
                                                         covers.id, covers.name AS cName,covers.cover AS cover, covers.out_date, covers.user_id, covers.created_at, 
                                                         covers.updated_at, 
                                                         playlists.id, playlists.name, playlists.created_at, playlists.updated_at
                                                 FROM cover_playlist 
                                                 INNER JOIN covers  
                                                 ON cover_playlist.cover_id = covers.id
                                                 INNER JOIN playlists
                                                 ON cover_playlist.playlist_id=playlists.id';

                    $playList = 'SELECT id, name, created_at, updated_at FROM playlists';
                    $i = 0;
                    foreach ($connexion->query($playList .' ORDER BY id DESC') as $plyCover):
                        $i++;
                        echo '<div class="sqs-layout sqs-grid-12 columns-12">
                        <div class="row sqs-row">
                            <div class="sqs-block html-block sqs-block-html" data-block-type="2">
                                <div class="sqs-block-content">';
                        if($i==1){
                         echo '<h1 data-shrink-original-size="72" style="text-align:center;white-space:pre-wrap;">Music</h1>';
                        }
                        echo '<h2 style="text-align:center;white-space:pre-wrap;">'.strtoupper($plyCover->name).'</h2>
                                </div>
                            </div>
                        </div>
                    </div>';


                    echo '<div class="sqs-block gallery-block sqs-block-gallery">';

                    foreach ($connexion->query($query .' WHERE cover_playlist.playlist_id='.$plyCover->id) as $retour):

                        echo '<ul class="client wow fadeIn delay-05s col-lg-3 col-md-6 col-xs-12">
                            <li>
                            <a href="detail-cover.php">
                                <img alt="'.$retour->cName.'" class="dev" src="' . str_replace('../img/', 'auth/public/img/', $retour->cover) . '">
                                <div class="image-slide-title">'.$retour->cName.'</div>
                            </a>
                            </li>
                        </ul>';

                    endforeach;


                        echo '</div>';

                    endforeach;
                    ?>

                    <div class="row">
                        <?php
                        $requete = 'SELECT * FROM users INNER JOIN roles r
                                                             ON users.role_id = r.id 
                                                             WHERE name="administrateur" LIMIT 1';
                        foreach ($connexion->query($requete) as $user):

                            echo '<div class="col-lg-2 col-md-12 col-xs-12">
                            <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21"
                                 id="block-yui_3_17_2_1_1541682513204_31408">
                                <div class="sqs-block-content">&nbsp;</div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-xs-12">
                            <div class="sqs-block code-block sqs-block-code" data-block-type="23">
                                <div class="sqs-block-content">
                                    <center>
                                        <a href="'.$user->spotify.'"
                                           target="_blank">
                                            <img name="image1" onmouseout="http://content.boyceavenue.com/images/spotify_color.png" onmouseover="http://content.boyceavenue.com/images/spotify_color.png"
                                                 src="img/spotify_color.png"
                                                 style="border: 0;opacity:.8;"
                                                 title="'.$user->spotify.'" width="200">
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-xs-12">
                            <div class="sqs-block code-block sqs-block-code" data-block-type="23"
                                 id="block-yui_3_17_2_2_1458575950937_32896">
                                <div class="sqs-block-content">
                                    <center><a href="'.$user->apple_music.'"
                                               target="_blank">
                                        <img name="image1" onmouseout="http://content.boyceavenue.com/images/applemusic.png" onmouseover="http://content.boyceavenue.com/images/applemusic.png"
                                             src="img/applemusic.png"
                                             style="border: 0;opacity:.8;"
                                             title="'.$user->apple_music.'" width="200">
                                    </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-xs-12">
                            <div class="sqs-block code-block sqs-block-code" data-block-type="23">
                                <div class="sqs-block-content">
                                    <center>
                                        <a href="'.$user->youtube_music.'"
                                           target="_blank">
                                            <img name="image1" onmouseout="http://content.boyceavenue.com/imagesyoutubemusic.png" onmouseover="http://content.boyceavenue.com/images/youtubemusic.png"
                                                 src="img/youtubemusic.png"
                                                 style="border: 0;opacity:.8;"
                                                 title="'.$user->youtube_music.'" width="200">
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-xs-12">
                            <div class="sqs-block code-block sqs-block-code" data-block-type="23"
                                 id="block-yui_3_17_2_2_1458575950937_27305">
                                <div class="sqs-block-content">
                                    <center>
                                        <a href="'.$user->amazone.'"
                                           target="_blank">
                                            <img name="image1" onmouseout="http://content.boyceavenue.com/images/amazon_02.png" onmouseover="http://content.boyceavenue.com/images/amazon_02.png"
                                                 src="img/amazon_02.png"
                                                 style="border: 0;opacity:.8;"
                                                 title="'.$user->amazone.'" width="200">
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-12 col-xs-12">
                            <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21">
                                <div class="sqs-block-content">&nbsp;</div>
                            </div>
                        </div>';
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </section>-->
    <!--main-section client-part-end-->


    <section id="merch"><!--main-section alabaster-start-->
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                         id="block-yui_3_17_2_1_1571172005667_9277">
                        <div class="sqs-block-content">
                            <h1 style="text-align:center;white-space:pre-wrap;">ARTICLES</h1>
                            <p class="" style="white-space:pre-wrap;">&nbsp;</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-xs-12 featured-work text-center">
                    <?php
                        foreach ($connexion->query('SELECT * FROM articles WHERE state="available" ORDER BY id DESC LIMIT 4') as $dev):
                            echo '<div class="featured-box col-lg-3 col-xs-12">
                        <div class="featured-box-col2 wow fadeInRight delay-02s">
                            <img alt="'.$dev->name.'" class="img-size" src="' . str_replace('../img/', 'auth/public/img/', $dev->image) . '">
                        </div>
                    </div>';

                        endforeach;
                    ?>
                    <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                         id="block-yui_3_17_2_1_1571172005667_10034">
                        <div class="sqs-block-content">
                            <h2 style="text-align:center;white-space:pre-wrap;">
                                <a href="achat" target="_blank" style="font-weight: bold; color: white">EFFECTUER UN ACHAT</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--main-section alabaster-end-->


    <section class="index-section no-main-image page alt-section" id="video"><!--header-start-->
        <div class="index-section-wrapper has-main-media">

            <!-- For Pages -->
            <div class="index-section-image content-fill">
                <div class="sqs-video-background content-fill mobile"
                     data-config-filter="" data-config-filter-strength=""
                     data-config-playback-speed="1" data-config-url="https://www.youtube.com/watch?v=3G8CM-6BZC4" style="overflow: hidden;">
                    <img alt="Perfect (YouTube Final).00_00_01_16.Still002.jpg"
                         class="custom-fallback-image"
                         data-image="https://images.squarespace-cdn.com/content/v1/56d1077e8a65e2c2b911c5fa/1540563252241-L4F5L0CINVLXHQUCZGC2/Perfect+%28YouTube+Final%29.00_00_01_16.Still002.jpg" data-image-dimensions="2500x1407"
                         data-image-focal-point="0.5,0.5" data-image-resolution="1500w"
                         data-parent-ratio="2.5"
                         data-src="https://images.squarespace-cdn.com/content/v1/56d1077e8a65e2c2b911c5fa/1540563252241-L4F5L0CINVLXHQUCZGC2/Perfect+%28YouTube+Final%29.00_00_01_16.Still002.jpg" src="https://images.squarespace-cdn.com/content/v1/56d1077e8a65e2c2b911c5fa/1540563252241-L4F5L0CINVLXHQUCZGC2/Perfect+%28YouTube+Final%29.00_00_01_16.Still002.jpg?format=1500w"
                         style="left: 0px; top: -108.609px; width: 1349px; height: 759.217px; position: relative;">
                    <div id="player"></div>
                </div>
            </div>
            <div class="index-image-overlay"></div>
            <div class="content page-content has-main-media tmpl-loading" data-url-id="video" id="video-page">
                <div class="content-inner has-content">
                    <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1555350152285"
                         id="page-56e99cec8259b5479796ead5">
                        <div class="row sqs-row">
                            <div class="col sqs-col-12 span-12">
                                <div class="sqs-block markdown-block sqs-block-markdown" data-block-type="44"
                                     id="block-yui_3_17_2_2_1458242679173_13796">
                                    <div class="sqs-block-content" id="yui_3_17_2_1_1649144140028_870">
                                        <h1 data-shrink-original-size="72"
                                            id="-center-data-preserve-html-node-true-span-data-preserve-html-node-true-style-color-ffffff-video-span-">
                                            <center data-preserve-html-node="true">
                                                <span data-preserve-html-node="true"
                                                      style="color: #FFFFFF;">VIDEO</span>
                                            </center>
                                        </h1>
                                    </div>
                                </div>
                                <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                                     id="block-yui_3_17_2_1_1524672773120_8523">
                                    <div class="sqs-block-content">
                                        <p style="text-align:center;white-space:pre-wrap;"><a
                                                href="https://www.youtube.com/user/boyceavenue" target="_blank">CLIQUER ICI POUR VOIR LES</a> VIDEOS</p>
                                    </div>
                                </div>
                                <div class="row sqs-row">
                                    <div class="col sqs-col-4 span-4">
                                        <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1"
                                             data-block-type="21" id="block-yui_3_17_2_12_1458149909129_65112">
                                            <div class="sqs-block-content">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="col sqs-col-4 span-4">
                                        <div class="sqs-block code-block sqs-block-code" data-block-type="23"
                                             id="block-yui_3_17_2_12_1458149909129_63822">
                                            <div class="sqs-block-content">
                                                <center>
                                                    <a href="https://www.youtube.com/user/boyceavenue" target="_blank">
                                                        <img name="image1" onmouseout="http://content.boyceavenue.com/images/youtube.png" onmouseover="http://content.boyceavenue.com/images/youtube.png"
                                                             src="img/youtube_grey.png"
                                                             style="border: 0;opacity:.7;"
                                                             title="Title Text" width="200">
                                                    </a>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col sqs-col-4 span-4">
                                        <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1"
                                             data-block-type="21" id="block-yui_3_17_2_12_1458149909129_65923">
                                            <div class="sqs-block-content">&nbsp;</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- For Galleries -->
            <!-- For Albums -->
        </div>
    </section><!--header-end-->


    <section class="index-section page client-follow" id="follow">
        <div class="index-section-wrapper has-main-media has-main-image">

            <div class="content page-content has-main-media has-main-image tmpl-loading" data-url-id="follow"
                 id="follow-page">
                <div class="content-inner has-content">
                    <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1571836444324"
                         id="page-5ae0ab73f950b7b39120879f">
                        <div class="row sqs-row">
                            <div class="col sqs-col-12 span-12">
                                <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21"
                                     id="block-yui_3_17_2_1_1545329701154_40773">
                                    <div class="sqs-block-content">&nbsp;</div>
                                </div>
                                <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21"
                                     id="block-yui_3_17_2_1_1545329701154_42297">
                                    <div class="sqs-block-content">&nbsp;</div>
                                </div>
                                <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21"
                                     id="block-yui_3_17_2_1_1545330753129_8508">
                                    <div class="sqs-block-content">&nbsp;</div>
                                </div>
                                <div class="sqs-block markdown-block sqs-block-markdown" data-block-type="44"
                                     id="block-yui_3_17_2_1_1524677504950_33737">
                                    <div class="sqs-block-content" id="yui_3_17_2_1_1649089012158_794">
                                        <h1 data-shrink-original-size="72"
                                            id="-center-data-preserve-html-node-true-span-data-preserve-html-node-true-style-color-f-follow-span-">
                                            <center data-preserve-html-node="true">
                                                <span data-preserve-html-node="true" style="color: #F;">Follow</span>
                                            </center>
                                        </h1>

                                    </div>
                                </div>
                                <div class="row sqs-row text-center">
                                    <?php
                                    foreach ($connexion->query($requete) as $user):

                                        echo '<div class="col-lg-2 col-md-2 col-xs-12">
                                        <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1"
                                             data-block-type="21" id="block-47288335b132b01948d0">
                                            <div class="sqs-block-content">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-6">
                                        <div class="sqs-block code-block sqs-block-code" data-block-type="23"
                                             id="block-e15fb9a107d54cefed12">
                                            <div class="sqs-block-content">
                                                <center><a href="'.$user->instagram.'"
                                                           target="_blank"><img
                                                        name="image1"
                                                        onmouseout="http://content.boyceavenue.com/images/instagram_grey.png"
                                                        onmouseover="http://content.boyceavenue.com/images/instagram_grey.png"
                                                        src="img/instagram_grey.png"
                                                        style="border: 0;opacity:.8;"
                                                        title="'.$user->instagram.'" width="250"></a>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-6">
                                        <div class="sqs-block code-block sqs-block-code" data-block-type="23"
                                             id="block-3f1c92bd215989bd8b5d">
                                            <div class="sqs-block-content">
                                                <center><a href="'.$user->facebook.'" target="_blank"><img
                                                        name="image1"
                                                        onmouseout="http://content.boyceavenue.com/images/facebook_grey.png"
                                                        onmouseover="http://content.boyceavenue.com/images/facebook_grey.png"
                                                        src="img/facebook_grey.png"
                                                        style="border: 0;opacity:.8;"
                                                        title="'.$user->facebook.'" width="250"></a>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-6">
                                        <div class="sqs-block code-block sqs-block-code" data-block-type="23"
                                             id="block-4f250f0030cde19a2071">
                                            <div class="sqs-block-content">
                                                <center><a href="'.$user->twitter.'" target="_blank"><img
                                                        name="image1"
                                                        onmouseout="http://content.boyceavenue.com/images/twitter_grey.png"
                                                        onmouseover="http://content.boyceavenue.com/images/twitter_grey.png"
                                                        src="img/twitter_grey.png"
                                                        style="border: 0;opacity:.8;"
                                                        title="'.$user->twitter.'" width="250"></a>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-6">
                                        <div class="sqs-block code-block sqs-block-code" data-block-type="23"
                                             id="block-1acf444b937390a4741e">
                                            <div class="sqs-block-content">
                                                <center><a href="'.$user->youtube.'"
                                                           target="_blank"><img
                                                        name="image1"
                                                        onmouseout="http://content.boyceavenue.com/images/youtube_grey.png"
                                                        onmouseover="http://content.boyceavenue.com/images/youtube_grey.png"
                                                        src="img/youtube_grey.png"
                                                        style="border: 0;opacity:.8;"
                                                        title="'.$user->youtube.'" width="250"></a>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-xs-12">
                                        <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1"
                                             data-block-type="21" id="block-87209315cf8d49babf37">
                                            <div class="sqs-block-content">&nbsp;</div>
                                        </div>
                                    </div>';
                                    endforeach;
                                    ?>
                                </div>
                                <div class="sqs-block html-block sqs-block-html col-lg-12" data-block-type="2"
                                     id="block-yui_3_17_2_1_1545001233574_31787">
                                    <div class="sqs-block-content">
                                        <h2 style="white-space:pre-wrap;">Salut les amis, Inscrivez-vous pour un accès anticipé aux billets, aux rencontres et aux salutations,
                                            aux offres de merchandising, au contenu exclusif et plus encore !</h2>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-10">

                                        <div id="idContact" class="alert alert-danger"
                                             style="display:none;"></div>

                                        <form id="singContact" class="user" role="form"
                                              action="auth/Public/controllers/traitement.php?singContact=singContact" method="post">
                                            <div class="form-group">
                                                <label for="email">Adresse Email *</label>
                                                <input class="form-control is-valid" id="email" name="email"
                                                       placeholder="Ex: contact@tekezik.com" required type="email">
                                            </div>

                                            <div class="form-group">
                                                <label for="country">Pays *</label>
                                                <input class="form-control is-invalid" id="country" name="country"
                                                       placeholder="Ex: Cameroun" required type="text">
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-primary currentSend" type="submit">Envoyer</button>
                                                <img src="auth/Public/img/loader.gif" class="siteWebUploads" style="display:none;">
                                            </div>

                                        </form>
                                    </div>
                                    <div class="col-lg-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer" id="contact">
        <div class="container">
            <div class="row">
                <div class="sqs-block html-block sqs-block-html col-lg-12" data-block-type="2"
                     id="block-yui_3_17_2_1_1587740377942_35202">
                    <div class="sqs-block-content">
                        <h1 style="text-align:center;white-space:pre-wrap;">CONTACTEZ-NOUS</h1>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="col-lg-12" style="padding-top: 17px;outline: none;">
                        <a class="link animated fadeInUp delay-1s" href="contact-us.php">CONTACTEZ-NOUS</a>
                    </div>

                    <!--<div class="col-lg-12">
                        <a class="link animated fadeInUp delay-1s" href="#">Sync Enquiries</a>
                    </div>-->
                </div>
                <div class="col-lg-6 text-center">
                    <div class="col-lg-12" style="padding-top: 17px;outline: none;">
                        <p class="animated fadeInUp delay-1s text-center">N'HÉSITEZ PAS À NOUS CONTACTER POUR DES RÉSERVATIONS OU DES DEMANDES D'AFFAIRES. NOUS AIMERIONS RECEVOIR DE VOS NOUVELLES.</p>
                    </div>

                    <div class="col-lg-12" style="padding-top: 17px;outline: none;">
                        <p class="animated fadeInUp delay-1s text-center">POUR LES DEMANDES VEUILLEZ NOUS CONTACTER.</p>
                    </div>

                </div>

                <div class="divider">
                    <img  class="img-responsive" alt="" src="img/footer-tz.jpg" style="padding-top: 50px; padding-bottom: 50px; overflow: hidden;">
                </div>

                <div class="nav-wrapper desktop-nav-wrapper" id="secondaryNavWrapper">
                    <nav data-content-field="navigation" id="secondaryNavigation">
                        <?php
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
        <!--
            All links in the footer should remain intact.
            Licenseing information is available at: http://bootstraptaste.com/license/
            You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Knight
        -->
    </footer>

    <script type="text/javascript">
        $(document).ready(function (e) {
            $('#test').scrollToFixed();
            $('.res-nav_click').click(function () {
                $('.main-nav').slideToggle();
                return false

            });

        });
    </script>


    <script>
        wow = new WOW(
            {
                animateClass: 'animated',
                offset: 100
            }
        );
        wow.init();

    </script>


    <script type="text/javascript">
        $(window).load(function () {

            $('.main-nav li a').bind('click', function (event) {
                var $anchor = $(this);

                $('html, body').stop().animate({
                    scrollTop: $($anchor.attr('href')).offset().top - 102
                }, 1500, 'easeInOutExpo');
                /*
                if you don't want to use the easing effects:
                $('html, body').stop().animate({
                    scrollTop: $($anchor.attr('href')).offset().top
                }, 1000);
                */
                event.preventDefault();
            });
        })
    </script>

    <script type="text/javascript">

        $(window).load(function () {


            var $container = $('.portfolioContainer'),
                $body = $('body'),
                colW = 375,
                columns = null;


            $container.isotope({
                // disable window resizing
                resizable: true,
                masonry: {
                    columnWidth: colW
                }
            });

            $(window).smartresize(function () {
                // check if columns has changed
                var currentColumns = Math.floor(($body.width() - 30) / colW);
                if (currentColumns !== columns) {
                    // set new column count
                    columns = currentColumns;
                    // apply width to container manually, then trigger relayout
                    $container.width(columns * colW)
                        .isotope('reLayout');
                }

            }).smartresize(); // trigger resize to set container width
            $('.portfolioFilter a').click(function () {
                $('.portfolioFilter .current').removeClass('current');
                $(this).addClass('current');

                var selector = $(this).attr('data-filter');
                $container.isotope({

                    filter: selector,
                });
                return false;
            });

        });

    </script>
<!--
    <script>
        $(window).scroll(function () {
            const head = $('#test');
            console.log($(this).scrollTop());
            if($(this).scrollTop() > 842){
                head.removeClass('hidden');
                head.css({
                'padding': '0px',
                'border-bottom': '2px solid #ddd',
                'box-shadow': '0 4px 5px -3px #ececec',
                'position': 'fixed',
                'background-color': '#fff!important',
                'text-align':'center'
                });
            }else {
                head.addClass('hidden')
            }
        });
    </script>-->

    <script>
        $(function() {

            //souscription users
            $('#singContact input').focus(function () {
                $('#idContact').fadeOut(800);
            });

            $('#singContact').on('submit', function (e) {
                /* On empêche le navigateur de soumettre le formulaire*/
                e.preventDefault();


                var statut1 = $('#idContact');
                var email = $('#email').val(),
                    country = $('#country').val();


                if (email === '' || country === '') {
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
                        var cat = $('#idContact');
                        if(data.resultat === 'success'){
                            $('.siteWebUploads').hide();
                            cat.removeClass('alert-danger');
                            cat.addClass('alert-success');
                            $('.currentSend').attr('value', 'Submit');
                            cat.html("Email enregistré avec succès").show();
                            setTimeout(function () {
                                cat.html("Email enregistré avec succès").slideDown().hide();
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