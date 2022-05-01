<?php
// Connexion à la base de données
require '../../config/Config_Server.php';
session_start();
$connexion = App::getDB();

$message='';
$success='';
$i=0;



function nettoieProtect(){

    foreach($_POST as $k => $v){
        $v=strip_tags(trim($v));
        $_POST[$k]=$v;
    }

    foreach($_GET as $k => $v){
        $v=strip_tags(trim($v));
        $_GET[$k]=$v;
    }

    foreach($_REQUEST as $k => $v){
        $v=strip_tags(trim($v));
        $_REQUEST[$k]=$v;
    }

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
/* ==========================================================================
Ajouter utilisateur
========================================================================== */

// souscription
if(isset($_GET['singUp'])) {
    $msg = "";

    if(is_numeric($_POST['last_name'][0])){
        $msg = 'Le Nom doit commencer par une lettre';
        //exit;
    }
    // Vérification de la validité des champs
    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['last_name'])) {
        $msg = "Le Nom est Invalid";
        //exit();
    }

    /*-------------------------------*/
    if(is_numeric($_POST['first_name'][0])){
        $msg = 'Le Prenom doit commencer par une lettre';
        //exit;
    }

    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['first_name'])) {
        $msg = "Le Prenom est Invalid";
        //exit();
    }


    if (!preg_match('/^[0-9-_ ]{9}$/', $_POST['phone'])) {
        $msg = "Le numéro est Invalid";
        //exit();
    }


    /*-------------------------------*/
    if(is_numeric($_POST['email'][0])){
        $msg = 'L\'email doit commencer par une lettre';
        //exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['email'])) {
        $msg = "Email Invalid";
        //exit();
    }

    /*---------------------------------------------------*/

    if (!preg_match('/^[A-Za-z0-9_ ]{4,50}$/', $_POST['password'])) {
        $msg = "password Invalid";
        //exit();
    }

    $_POST['last_name'] = strtolower(stripslashes(htmlspecialchars($_POST['last_name'])));
    $_POST['first_name'] = strtolower(stripslashes(htmlspecialchars($_POST['first_name'])));
    $_POST['phone'] = strtolower(stripslashes(htmlspecialchars($_POST['phone'])));
    $_POST['email'] = strtolower(stripslashes(htmlspecialchars($_POST['email'])));
    $_POST['password'] = stripslashes(htmlspecialchars($_POST['password']));
    $_POST['password'] = sha1($_POST['password']);



    // Connexion à la base de données

    $nbre = $connexion->rowCount('SELECT id FROM users WHERE phone="'.$_POST['phone'].'" 
     OR email="'.$_POST['email'].'"');

    if($nbre > 0){
        $msg = 'numéro ou email déjà utilisé';
        //exit;
    }

    else {

        nettoieProtect();
        extract($_POST);

        //$id_forum = $connexion->prepare_request('SELECT id_blog FROM blog', array());
        $connexion->insert('INSERT INTO users(last_name, first_name, youtube, instagram, phone, email, password, role_id, user_state, created_at, tiktok, facebook, twitter, spotify, amazone, youtube_music, apple_music) 
                                      VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [strtolower($_POST['last_name']), strtolower($_POST['first_name']), strtolower($_POST['youtube']), strtolower($_POST['instagram']), $_POST['phone'],
            strtolower($_POST['email']), $_POST['password'], $_POST['role'], '1',  time(), strtolower($_POST['tiktok']), strtolower($_POST['facebook']), strtolower($_POST['twitter']), strtolower($_POST['spotify']), strtolower($_POST['amazone']),
            strtolower($_POST['youtube_music']), strtolower($_POST['apple_music'])]);

        $max = $connexion->prepare_request('SELECT Max(id) AS max_id FROM users ORDER BY id DESC LIMIT 1 ', array());

        $_SESSION['ID_USER'] = $max['max_id'];
        $_SESSION['EMAIL_USER'] = $_POST['email'];


        $connexion->insert('INSERT INTO journal(users_id, name, ip, created_at)
                                               VALUES(?, ?, ?, ?)', array($max['max_id'], 'Enregistrement Utilisateur', get_ip(), time()));

        $msg = 'success';


    }

    $data = array(
        'resultat' => $msg
    );
    echo json_encode($data);

}


/* ==========================================================================
DELETE USER
========================================================================== */
if(isset($_GET['delUser'])){
    App::getDB()->delete('DELETE FROM users WHERE id=:id', ['id' =>$_GET['delUser']]);
    header('Location: ../index.php?id=1');
}

/* ==========================================================================
UPDATE USER
========================================================================== */
if(isset($_GET['updateUser'])) {

    if(!isset($_POST['last_name']) || empty($_POST['last_name'])){
        $message .= "Veuillez inserer un nom<br />\n";
    } if(!isset($_POST['phone']) || empty($_POST['phone'])){
        $message .= "Veuillez inserer un numéro de téléphone<br />\n";
    } else {

        extract($_POST);

        $connexion = App::getDB();

            $connexion->update('UPDATE users SET last_name=:last_name, first_name=:first_name, youtube=:youtube,
                   instagram=:instagram, phone=:phone, email=:email,
                   password=:password, role_id=:role_id,
                 tiktok=:tiktok, facebook=:facebook, twitter=:twitter,
                 spotify=:spotify, amazone=:amazone,
                 youtube_music=:youtube_music, apple_music=:apple_music WHERE id=:id',
                array('last_name'=>strtolower($_POST['last_name']), 'first_name'=>strtolower($_POST['first_name']),
                    'youtube'=>strtolower($_POST['youtube']), 'instagram'=>strtolower($_POST['instagram']),
                    'phone'=>$_POST['phone'],'email'=>strtolower($_POST['email']),
                    'password'=>strtolower($_POST['password']),'role_id'=>strtolower($_POST['role']),
                    'tiktok'=>strtolower($_POST['tiktok']),
                    'facebook'=>strtolower($_POST['facebook']), 'twitter'=>strtolower($_POST['twitter']),
                    'spotify'=>strtolower($_POST['spotify']), 'amazone'=>strtolower($_POST['amazone']),
                    'youtube_music'=>strtolower($_POST['youtube_music']), 'apple_music'=>strtolower($_POST['apple_music']),
                    'id' => $_POST['user_id']));

            $message .= 'success-update';

    }
    echo $message;
}


/* ==========================================================================
ADD TOUR DATE
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['event'])) {

    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer un libelle valid<br />\n";
    } else {

        extract($_POST);

        $connexion = App::getDB();

        $connexion->insert('INSERT INTO events(name, location, state_ticket, link_ticket, created_at, user_id, start_event, end_event)
                                               VALUES(?, ?, ?, ?, ?, ?, ?, ?)',
            array(strtolower($name), 'live at '.strtolower($location), strtolower($state_ticket), strtolower($link_ticket), time(), isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '1', $start_event, $end_event));


        $message .= 'success';
    }
    echo $message;
}



/* ==========================================================================
DELETE TOUR DATE
========================================================================== */
if(isset($_GET['delEvent'])){
    App::getDB()->delete('DELETE FROM events WHERE id=:id', ['id' =>$_GET['delEvent']]);
    header('Location: ../index.php?id=2');
}


/* ==========================================================================
UPDATE TOUR DATE
========================================================================== */
if(isset($_GET['updateEvent'])) {

    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer un libellé<br />\n";
    } else {

        extract($_POST);

        $connexion = App::getDB();

            $connexion->update('UPDATE events SET name=:name, location=:location, state_ticket=:state_ticket,
                 link_ticket=:link_ticket, start_event=:start_event, end_event=:end_event, updated_at=:updated_at WHERE id=:id',
                array('name'=>$_POST['name'], 'location'=>$_POST['location'], 'state_ticket'=>$_POST['state_ticket'],
                    'link_ticket'=>$_POST['link_ticket'], 'start_event'=>$_POST['start_event'], 'end_event'=>$_POST['end_event'],
                    'updated_at'=>time(), 'id' => $_POST['event_id']));

            $message .= 'success-update';

    }
    echo $message;
}




/* ==========================================================================
ADD COVERS
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['cover'])) {

    if(!isset($_POST['cover_name']) || empty($_POST['cover_name'])){
        $message .= "Veuillez inserer un libelle valid<br />\n";
    } else {

        if (isset($_FILES['cover']['name']) and !empty($_FILES['cover']['name'])) {
            //on verifi la taille de l'image
            if ($_FILES['cover']['size'] >= 1000) {
                $extensions_valides = array('jpg', 'jpeg', 'png');
                //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                //la fonction strtolower($chaine) renvoit la chaine en minuscule
                $extension_upload = strtolower(substr(strrchr($_FILES['cover']['name'], '.'), 1));
                //on verifi si l'extension_uplod est valide

                if (in_array($extension_upload, $extensions_valides)) {
                    $id_membre = md5(uniqid(rand(), true));
                    $chemin = "../img/upload/{$id_membre}.{$extension_upload}";
                    //on deplace du serveur au disque dur

                    if (move_uploaded_file($_FILES['cover']['tmp_name'], $chemin)) {
                        // La photo est la source
                        if ($extension_upload == 'jpg' or $extension_upload == 'jpeg') {
                            $source = imagecreatefromjpeg($chemin);
                        } else {
                            $source = imagecreatefrompng($chemin);
                        }
                        $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                        // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                        $largeur_source = imagesx($source);
                        $hauteur_source = imagesy($source);
                        $largeur_destination = imagesx($destination);
                        $hauteur_destination = imagesy($destination);
                        $chemin0 = "../img/upload/miniature/{$id_membre}.{$extension_upload}";
                        // On crée la miniature
                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                        // On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

                        imagejpeg($destination, $chemin0);
                        //echo $chemin0;
                    } else {
                        $message .= "Aucune image déplacé<br/>";
                    }
                } else {
                    $message .= "extension de votre image invalide<br/>";
                }
            } else {
                $message .= "taille de votre image invalide<br/>";
            }
        } else {
            $message .= "image indéfinie<br/>";
        }


        extract($_POST);
        $connexion = App::getDB();

        $connexion->insert('INSERT INTO covers(name, cover, out_date, created_at, user_id)
                                               VALUES(?, ?, ?, ?, ?)',
            array(strtolower($cover_name), $chemin, $out_date, time(), isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '1'));


        $message .= 'success';
    }
    echo $message;
}


/* ==========================================================================
DELETE COVER
========================================================================== */
if(isset($_GET['delCover'])){
    App::getDB()->delete('DELETE FROM covers WHERE id=:id', ['id' =>$_GET['delCover']]);
    header('Location: ../index.php?id=3');
}


/* ==========================================================================
UPDATE COVER
========================================================================== */
if(isset($_GET['updateCover'])) {

    if(!isset($_POST['cover_name']) || empty($_POST['cover_name'])){
        $message .= "Veuillez inserer un titre<br />\n";
    } else {

        if (isset($_FILES['cover']['name']) and !empty($_FILES['cover']['name'])) {
            //on verifi la taille de l'image
            if ($_FILES['cover']['size'] >= 1000) {
                $extensions_valides = array('jpg', 'jpeg', 'png');
                //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                //la fonction strtolower($chaine) renvoit la chaine en minuscule
                $extension_upload = strtolower(substr(strrchr($_FILES['cover']['name'], '.'), 1));
                //on verifi si l'extension_uplod est valide

                if (in_array($extension_upload, $extensions_valides)) {
                    $id_membre = md5(uniqid(rand(), true));
                    $chemin = "../img/upload/{$id_membre}.{$extension_upload}";
                    //on deplace du serveur au disque dur

                    if (move_uploaded_file($_FILES['cover']['tmp_name'], $chemin)) {
                        // La photo est la source
                        if ($extension_upload == 'jpg' or $extension_upload == 'jpeg') {
                            $source = imagecreatefromjpeg($chemin);
                        } else {
                            $source = imagecreatefrompng($chemin);
                        }
                        $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                        // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                        $largeur_source = imagesx($source);
                        $hauteur_source = imagesy($source);
                        $largeur_destination = imagesx($destination);
                        $hauteur_destination = imagesy($destination);
                        $chemin0 = "../img/upload/miniature/{$id_membre}.{$extension_upload}";
                        // On crée la miniature
                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                        // On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

                        imagejpeg($destination, $chemin0);
                        //echo $chemin0;
                    } else {
                        $message .= "Aucune image déplacé<br/>";
                    }
                } else {
                    $message .= "extension de votre image invalide<br/>";
                }
            } else {
                $message .= "taille de votre image invalide<br/>";
            }
        } else {
            $message .= "image indéfinie<br/>";
        }

        extract($_POST);

        $connexion = App::getDB();

        $connexion->update('UPDATE covers SET name=:name, out_date=:out_date, cover=:cover,
                  updated_at=:updated_at WHERE id=:id',
            array('name'=>$_POST['cover_name'], 'out_date'=>$_POST['out_date'], 'cover'=>$chemin,
                'updated_at'=>time(), 'id' => $_POST['cover_id']));

        $message .= 'success-update';

    }
    echo $message;
}




/* ==========================================================================
ADD PLAYLIST
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['playlist'])) {

    if(!isset($_POST['playlist_name']) || empty($_POST['playlist_name'])){
        $message .= "Veuillez inserer un titre valid<br />\n";
    }else{

        $connexion = App::getDB();
        extract($_POST);

        $connexion->insert('INSERT INTO playlists(name, created_at)
                                               VALUES(?, ?)',
            array(strtolower($playlist_name), time()));

        $message .= 'success';

    }

    echo $message;
}

/* ==========================================================================
DELETE PLAYLIST
========================================================================== */
if(isset($_GET['delPlaylist'])){
    App::getDB()->delete('DELETE FROM playlists WHERE id=:id', ['id' =>$_GET['delPlaylist']]);
    header('Location: ../index.php?id=4');
}

/* ==========================================================================
UPDATE PLAYLIST
========================================================================== */
if(isset($_GET['updatePlaylist'])) {

    if(!isset($_POST['playlist_name']) || empty($_POST['playlist_name'])){
        $message .= "Veuillez inserer une playlist<br />\n";
    } else {


        extract($_POST);

        $connexion = App::getDB();

        $connexion->update('UPDATE playlists SET name=:name,
                  updated_at=:updated_at WHERE id=:id',
            array('name'=>$_POST['playlist_name'],
                'updated_at'=>time(), 'id' => $_POST['playlist_id']));

        $message .= 'success-update';

    }
    echo $message;
}


/* ==========================================================================
ADD ATTRIBUER COVER IN PLAYLIST
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['attr'])) {

    $connexion = App::getDB();
    extract($_POST);


    //$ingredient = implode(',', $_POST['ingredient']);
    $attr_cover = explode(',', implode(',', $attr_cover));

    foreach ($attr_cover as $ing){
        $connexion->insert('INSERT INTO cover_playlist(cover_id, playlist_id)
                                               VALUES(?, ?)',
            array($ing, $attr_ply));
    }

    $message .= 'success';

    echo $message;
}



/* ==========================================================================
DELETE PLAYLIST ATTRIBUTED
========================================================================== */
if(isset($_GET['delCoverPlayList'])){
    App::getDB()->delete('DELETE FROM cover_playlist WHERE id=:id', ['id' =>$_GET['delCoverPlayList']]);
    header('Location: ../index.php?id=4');
}




/* ==========================================================================
ADD SOCIAL MEDIA
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['rs'])) {

    if(!isset($_POST['rs_name']) || empty($_POST['rs_name'])){
        $message .= "Veuillez inserer un nom valid<br />\n";
    } else {

        if (isset($_FILES['logo']['name']) and !empty($_FILES['logo']['name'])) {
            //on verifi la taille de l'image
            if ($_FILES['logo']['size'] >= 1000) {
                $extensions_valides = array('jpg', 'jpeg', 'png');
                //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                //la fonction strtolower($chaine) renvoit la chaine en minuscule
                $extension_upload = strtolower(substr(strrchr($_FILES['logo']['name'], '.'), 1));
                //on verifi si l'extension_uplod est valide

                if (in_array($extension_upload, $extensions_valides)) {
                    $id_membre = md5(uniqid(rand(), true));
                    $chemin = "../img/upload/{$id_membre}.{$extension_upload}";
                    //on deplace du serveur au disque dur

                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $chemin)) {
                        // La photo est la source
                        if ($extension_upload == 'jpg' or $extension_upload == 'jpeg') {
                            $source = imagecreatefromjpeg($chemin);
                        } else {
                            $source = imagecreatefrompng($chemin);
                        }
                        $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                        // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                        $largeur_source = imagesx($source);
                        $hauteur_source = imagesy($source);
                        $largeur_destination = imagesx($destination);
                        $hauteur_destination = imagesy($destination);
                        $chemin0 = "../img/upload/miniature/{$id_membre}.{$extension_upload}";
                        // On crée la miniature
                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                        // On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

                        imagejpeg($destination, $chemin0);
                        //echo $chemin0;
                    } else {
                        $message .= "Aucune image déplacé<br/>";
                    }
                } else {
                    $message .= "extension de votre image invalide<br/>";
                }
            } else {
                $message .= "taille de votre image invalide<br/>";
            }
        } else {
            $message .= "image indéfinie<br/>";
        }


        extract($_POST);
        $connexion = App::getDB();

        $connexion->insert('INSERT INTO release_platforms (name, link_sm, logo, created_at, user_id)
                                               VALUES(?, ?, ?, ?, ?)',
            array(strtolower($rs_name), $link_rs, $chemin, time(), isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '1'));


        $message .= 'success';
    }
    echo $message;
}


/* ==========================================================================
DELETE SOCIAL MEDIA
========================================================================== */
if(isset($_GET['del_rs'])){
    App::getDB()->delete('DELETE FROM release_platforms WHERE id=:id', ['id' =>$_GET['del_rs']]);
    header('Location: ../index.php?id=5');
}

/* ==========================================================================
UPDATE SOCIAL MEDIA
========================================================================== */
if(isset($_GET['update_rs'])) {

    if(!isset($_POST['rs_name']) || empty($_POST['rs_name'])){
        $message .= "Veuillez inserer le nom du réseau social<br />\n";
    } else {

        if (isset($_FILES['logo']['name']) and !empty($_FILES['logo']['name'])) {
            //on verifi la taille de l'image
            if ($_FILES['logo']['size'] >= 1000) {
                $extensions_valides = array('jpg', 'jpeg', 'png');
                //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                //la fonction strtolower($chaine) renvoit la chaine en minuscule
                $extension_upload = strtolower(substr(strrchr($_FILES['logo']['name'], '.'), 1));
                //on verifi si l'extension_uplod est valide

                if (in_array($extension_upload, $extensions_valides)) {
                    $id_membre = md5(uniqid(rand(), true));
                    $chemin = "../img/upload/{$id_membre}.{$extension_upload}";
                    //on deplace du serveur au disque dur

                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $chemin)) {
                        // La photo est la source
                        if ($extension_upload == 'jpg' or $extension_upload == 'jpeg') {
                            $source = imagecreatefromjpeg($chemin);
                        } else {
                            $source = imagecreatefrompng($chemin);
                        }
                        $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                        // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                        $largeur_source = imagesx($source);
                        $hauteur_source = imagesy($source);
                        $largeur_destination = imagesx($destination);
                        $hauteur_destination = imagesy($destination);
                        $chemin0 = "../img/upload/miniature/{$id_membre}.{$extension_upload}";
                        // On crée la miniature
                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                        // On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

                        imagejpeg($destination, $chemin0);
                        //echo $chemin0;
                    } else {
                        $message .= "Aucune image déplacé<br/>";
                    }
                } else {
                    $message .= "extension de votre image invalide<br/>";
                }
            } else {
                $message .= "taille de votre image invalide<br/>";
            }
        } else {
            $message .= "image indéfinie<br/>";
        }

        extract($_POST);

        $connexion = App::getDB();

        $connexion->update('UPDATE release_platforms SET name=:name, link_sm=:link_sm, logo=:logo,
                  updated_at=:updated_at WHERE id=:id',
            array('name'=>$_POST['rs_name'], 'link_sm'=>$_POST['link_rs'], 'logo'=>$chemin,
                'updated_at'=>time(), 'id' => $_POST['rs_id']));

        $message .= 'success-update';

    }
    echo $message;
}

/* ==========================================================================
ADD ATTRIBUER COVER IN SOCIAL MEDIA
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['attr_sm'])) {

    $connexion = App::getDB();
    extract($_POST);


    //$ingredient = implode(',', $_POST['ingredient']);
    $attr_cov_sm = explode(',', implode(',', $attr_cov_sm));

    foreach ($attr_cov_sm as $ing){
        $connexion->insert('INSERT INTO cover_release_platform(cover_id, release_platform_id)
                                               VALUES(?, ?)',
            array($attr_cov, $ing));
    }

    $message .= 'success';

    echo $message;
}


/* ==========================================================================
DELETE SOCIAL MEDIA
========================================================================== */
if(isset($_GET['del_rp'])){
    App::getDB()->delete('DELETE FROM cover_release_platform WHERE id=:id', ['id' =>$_GET['del_rp']]);
    header('Location: ../index.php?id=5');
}





/* ==========================================================================
ADD ARTICLE
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['article'])) {

    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer un article valid<br />\n";
    } else {

        if (isset($_FILES['image']['name']) and !empty($_FILES['image']['name'])) {
            //on verifi la taille de l'image
            if ($_FILES['image']['size'] >= 1000) {
                $extensions_valides = array('jpg', 'jpeg', 'png');
                //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                //la fonction strtolower($chaine) renvoit la chaine en minuscule
                $extension_upload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
                //on verifi si l'extension_uplod est valide

                if (in_array($extension_upload, $extensions_valides)) {
                    $id_membre = md5(uniqid(rand(), true));
                    $chemin = "../img/upload/{$id_membre}.{$extension_upload}";
                    //on deplace du serveur au disque dur

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $chemin)) {
                        // La photo est la source
                        if ($extension_upload == 'jpg' or $extension_upload == 'jpeg') {
                            $source = imagecreatefromjpeg($chemin);
                        } else {
                            $source = imagecreatefrompng($chemin);
                        }
                        $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                        // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                        $largeur_source = imagesx($source);
                        $hauteur_source = imagesy($source);
                        $largeur_destination = imagesx($destination);
                        $hauteur_destination = imagesy($destination);
                        $chemin0 = "../img/upload/miniature/{$id_membre}.{$extension_upload}";
                        // On crée la miniature
                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                        // On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

                        imagejpeg($destination, $chemin0);
                        //echo $chemin0;
                    } else {
                        $message .= "Aucune image déplacé<br/>";
                    }
                } else {
                    $message .= "extension de votre image invalide<br/>";
                }
            } else {
                $message .= "taille de votre image invalide<br/>";
            }
        } else {
            $message .= "image indéfinie<br/>";
        }


        if (isset($_FILES['cover']['name']) and !empty($_FILES['cover']['name'])) {
            //on verifi la taille de l'image
            if ($_FILES['cover']['size'] >= 1000) {
                $extensions_valides = array('jpg', 'jpeg', 'png');
                //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                //la fonction strtolower($chaine) renvoit la chaine en minuscule
                $extension_upload = strtolower(substr(strrchr($_FILES['cover']['name'], '.'), 1));
                //on verifi si l'extension_uplod est valide

                if (in_array($extension_upload, $extensions_valides)) {
                    $id_membre = md5(uniqid(rand(), true));
                    $chemin11 = "../img/upload/{$id_membre}.{$extension_upload}";
                    //on deplace du serveur au disque dur

                    if (move_uploaded_file($_FILES['cover']['tmp_name'], $chemin11)) {
                        // La photo est la source
                        if ($extension_upload == 'jpg' or $extension_upload == 'jpeg') {
                            $source = imagecreatefromjpeg($chemin11);
                        } else {
                            $source = imagecreatefrompng($chemin11);
                        }
                        $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                        // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                        $largeur_source = imagesx($source);
                        $hauteur_source = imagesy($source);
                        $largeur_destination = imagesx($destination);
                        $hauteur_destination = imagesy($destination);
                        $chemin00 = "../img/upload/miniature/{$id_membre}.{$extension_upload}";
                        // On crée la miniature
                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                        // On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

                        imagejpeg($destination, $chemin00);
                        //echo $chemin0;
                    } else {
                        $message .= "Aucune image déplacé<br/>";
                    }
                } else {
                    $message .= "extension de votre image invalide<br/>";
                }
            } else {
                $message .= "taille de votre image invalide<br/>";
            }
        }

        extract($_POST);
        $connexion = App::getDB();

        $connexion->insert('INSERT INTO articles (name, price, new_price, image, cover, state, created_at, user_id)
                                               VALUES(?, ?, ?, ?, ?, ?, ?, ?)',
            array(strtolower($name), $prix, $new_prix, $chemin, isset($chemin11) ? $chemin11 : '', $state_article, time(), isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '1'));


        $message .= 'success';
    }
    echo $message;
}


/* ==========================================================================
DELETE ARTICLE
========================================================================== */
if(isset($_GET['del_article'])){
    App::getDB()->delete('DELETE FROM articles WHERE id=:id', ['id' =>$_GET['del_article']]);
    header('Location: ../index.php?id=6');
}


/* ==========================================================================
UPDATE ARTICLE
========================================================================== */
if(isset($_GET['update_article'])) {

    if(!isset($_POST['name']) || empty($_POST['name'])){
        $message .= "Veuillez inserer le nom de l\'article<br />\n";
    } else {

        if (isset($_FILES['image']['name']) and !empty($_FILES['image']['name'])) {
            //on verifi la taille de l'image
            if ($_FILES['image']['size'] >= 1000) {
                $extensions_valides = array('jpg', 'jpeg', 'png');
                //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                //la fonction strtolower($chaine) renvoit la chaine en minuscule
                $extension_upload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
                //on verifi si l'extension_uplod est valide

                if (in_array($extension_upload, $extensions_valides)) {
                    $id_membre = md5(uniqid(rand(), true));
                    $chemin = "../img/upload/{$id_membre}.{$extension_upload}";
                    //on deplace du serveur au disque dur

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $chemin)) {
                        // La photo est la source
                        if ($extension_upload == 'jpg' or $extension_upload == 'jpeg') {
                            $source = imagecreatefromjpeg($chemin);
                        } else {
                            $source = imagecreatefrompng($chemin);
                        }
                        $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                        // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                        $largeur_source = imagesx($source);
                        $hauteur_source = imagesy($source);
                        $largeur_destination = imagesx($destination);
                        $hauteur_destination = imagesy($destination);
                        $chemin0 = "../img/upload/miniature/{$id_membre}.{$extension_upload}";
                        // On crée la miniature
                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                        // On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

                        imagejpeg($destination, $chemin0);
                        //echo $chemin0;
                    } else {
                        $message .= "Aucune image déplacé<br/>";
                    }
                } else {
                    $message .= "extension de votre image invalide<br/>";
                }
            } else {
                $message .= "taille de votre image invalide<br/>";
            }
        } else {
            $message .= "image indéfinie<br/>";
        }


        if (isset($_FILES['cover']['name']) and !empty($_FILES['cover']['name'])) {
            //on verifi la taille de l'image
            if ($_FILES['cover']['size'] >= 1000) {
                $extensions_valides = array('jpg', 'jpeg', 'png');
                //la fonctions strrchr( $chaine,'.') renvoit l'extension avec le point
                //la fonction substtr($chaine,1) ingore la premiere caractere de la chaine
                //la fonction strtolower($chaine) renvoit la chaine en minuscule
                $extension_upload = strtolower(substr(strrchr($_FILES['cover']['name'], '.'), 1));
                //on verifi si l'extension_uplod est valide

                if (in_array($extension_upload, $extensions_valides)) {
                    $id_membre = md5(uniqid(rand(), true));
                    $chemin11 = "../img/upload/{$id_membre}.{$extension_upload}";
                    //on deplace du serveur au disque dur

                    if (move_uploaded_file($_FILES['cover']['tmp_name'], $chemin11)) {
                        // La photo est la source
                        if ($extension_upload == 'jpg' or $extension_upload == 'jpeg') {
                            $source = imagecreatefromjpeg($chemin11);
                        } else {
                            $source = imagecreatefrompng($chemin11);
                        }
                        $destination = imagecreatetruecolor(150, 150); // On crée la miniature vide

                        // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
                        $largeur_source = imagesx($source);
                        $hauteur_source = imagesy($source);
                        $largeur_destination = imagesx($destination);
                        $hauteur_destination = imagesy($destination);
                        $chemin00 = "../img/upload/miniature/{$id_membre}.{$extension_upload}";
                        // On crée la miniature
                        imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

                        // On enregistre la miniature sous le nom "mini_couchersoleil.jpg"

                        imagejpeg($destination, $chemin00);
                        //echo $chemin0;
                    } else {
                        $message .= "Aucune image déplacé<br/>";
                    }
                } else {
                    $message .= "extension de votre image invalide<br/>";
                }
            } else {
                $message .= "taille de votre image invalide<br/>";
            }
        } else {
            $message .= "image indéfinie<br/>";
        }

        extract($_POST);

        $connexion = App::getDB();

        $connexion->update('UPDATE articles SET name=:name, price=:price, new_price=:new_price, image=:image, cover=:cover, state=:state,
                  updated_at=:updated_at WHERE id=:id',
            array('name'=>$_POST['name'], 'price'=>$_POST['prix'], 'new_price'=>$_POST['new_prix'], 'image'=>$chemin, 'cover'=>$chemin11, 'state'=>$_POST['state_article'],
                'updated_at'=>time(), 'id' => $_POST['article_id']));

        $message .= 'success-update';

    }
    echo $message;
}



/* ==========================================================================
DELETE COMMANDE
========================================================================== */
if(isset($_GET['delCmd'])){

    foreach ($connexion->query('SELECT * FROM paniers p WHERE ip = "'.get_ip().'" AND article_id = "'.$_GET['delCmd'].'" ') as $del):


        $connexion->delete('DELETE FROM paniers WHERE article_id=:id', ['id' =>$del->article_id]);

    endforeach;

    header('Location: ../report.php');
}


//contact
if(isset($_GET['singContact'])) {
    $msg = "";

    if(is_numeric($_POST['country'][0])){
        $msg = 'Le pays doit commencer par une lettre';
        //exit;
    }

    /*-------------------------------*/
    if(is_numeric($_POST['email'][0])){
        $msg = 'L\'email doit commencer par une lettre';
        //exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['email'])) {
        $msg = "Email Invalid";
        //exit();
    }

    $_POST['country'] = strtolower(stripslashes(htmlspecialchars($_POST['country'])));
    $_POST['email'] = strtolower(stripslashes(htmlspecialchars($_POST['email'])));



    // Connexion à la base de données

    $nbre = $connexion->rowCount('SELECT id FROM users WHERE email="'.$_POST['email'].'"');

    if($nbre > 0){
        $msg = 'Email déjà utilisé';
        //exit;
    }

    else {

        nettoieProtect();
        extract($_POST);

        $connexion->insert('INSERT INTO users(country, email, ip, created_at) 
                                      VALUES(?,?,?,?)', [strtolower($_POST['country']), strtolower($_POST['email']), get_ip(), time()]);

        $max = $connexion->prepare_request('SELECT Max(id) AS max_id FROM users ORDER BY id DESC LIMIT 1 ', array());

        $_SESSION['ID_USER'] = $max['max_id'];
        $_SESSION['EMAIL_USER'] = $_POST['email'];


        $connexion->insert('INSERT INTO journal(users_id, name, ip, created_at)
                                               VALUES(?, ?, ?, ?)', array($max['max_id'], 'Enregistrement email utilisateur', get_ip(), time()));
        $msg = 'success';
    }

    $data = array(
        'resultat' => $msg
    );
    echo json_encode($data);

}

//contact-us
if(isset($_GET['singContact2'])) {
    $msg = "";

    if(is_numeric($_POST['last_name'][0])){
        $msg = 'Le Nom doit commencer par une lettre';
        //exit;
    }
    // Vérification de la validité des champs
    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['last_name'])) {
        $msg = "Le Nom est Invalid";
        //exit();
    }

    /*-------------------------------*/
    if(is_numeric($_POST['first_name'][0])){
        $msg = 'Le Prenom doit commencer par une lettre';
        //exit;
    }

    if (!preg_match('/^[A-Za-z0-9-_ ]{3,50}$/', $_POST['first_name'])) {
        $msg = "Le Prenom est Invalid";
        //exit();
    }


    /*-------------------------------*/
    if(is_numeric($_POST['email'][0])){
        $msg = 'L\'email doit commencer par une lettre';
        //exit;
    }
    if (!preg_match('/^[A-Z\d\._-]+@[A-Z\d\.-]{2,}\.[A-Z]{2,4}$/i', $_POST['email'])) {
        $msg = "Email Invalid";
        //exit();
    }

    $_POST['last_name'] = strtolower(stripslashes(htmlspecialchars($_POST['last_name'])));
    $_POST['first_name'] = strtolower(stripslashes(htmlspecialchars($_POST['first_name'])));
    $_POST['subject'] = strtolower(stripslashes(htmlspecialchars($_POST['subject'])));
    $_POST['email'] = strtolower(stripslashes(htmlspecialchars($_POST['email'])));
    $_POST['message'] = strtolower(stripslashes(htmlspecialchars($_POST['message'])));



    // Connexion à la base de données

    $nbre = $connexion->rowCount('SELECT id FROM users WHERE email="'.$_POST['email'].'"');

    if($nbre > 0){
        $msg = 'Email déjà utilisé';
        //exit;
    }

    else {

        nettoieProtect();
        extract($_POST);

        //$id_forum = $connexion->prepare_request('SELECT id_blog FROM blog', array());
        $connexion->insert('INSERT INTO users(last_name, first_name, email, subject, message, ip, created_at) 
                                      VALUES(?,?,?,?,?,?,?)', [strtolower($_POST['last_name']), strtolower($_POST['first_name']),
            strtolower($_POST['email']), $_POST['subject'], $_POST['message'], get_ip(),  time()]);

        $max = $connexion->prepare_request('SELECT Max(id) AS max_id FROM users ORDER BY id DESC LIMIT 1 ', array());

        $_SESSION['ID_USER'] = $max['max_id'];
        $_SESSION['EMAIL_USER'] = $_POST['email'];


        $connexion->insert('INSERT INTO journal(users_id, name, ip, created_at)
                                               VALUES(?, ?, ?, ?)', array($max['max_id'], 'contact utilisateur enregistré', get_ip(), time()));

        $msg = 'success';


    }

    $data = array(
        'resultat' => $msg
    );
    echo json_encode($data);

}