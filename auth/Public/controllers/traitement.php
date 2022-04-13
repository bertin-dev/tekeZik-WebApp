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
    $_POST['town'] = strtolower(stripslashes(htmlspecialchars($_POST['town'])));
    $_POST['quartier'] = strtolower(stripslashes(htmlspecialchars($_POST['quartier'])));
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
        $connexion->insert('INSERT INTO users(last_name, first_name, town, quartier, phone, email, password, role_id, user_state, created_at) 
                                      VALUES(?,?,?,?,?,?,?,?,?,?)', [strtolower($_POST['last_name']), strtolower($_POST['first_name']), strtolower($_POST['town']), strtolower($_POST['quartier']), $_POST['phone'],
            strtolower($_POST['email']), $_POST['password'], $_POST['role'], '1',  time()]);

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

            $connexion->update('UPDATE users SET last_name=:last_name, first_name=:first_name, town=:town,
                   quartier=:quartier, phone=:phone, email=:email,
                   password=:password, role_id=:role_id WHERE id=:id',
                array('last_name'=>strtolower($_POST['last_name']), 'first_name'=>strtolower($_POST['first_name']),
                    'town'=>strtolower($_POST['town']), 'quartier'=>strtolower($_POST['quartier']),
                    'phone'=>$_POST['phone'],'email'=>strtolower($_POST['email']),
                    'password'=>strtolower($_POST['password']),'role_id'=>strtolower($_POST['role']), 'id' => $_POST['user_id']));

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
DELETE INGREDIENTS
========================================================================== */
if(isset($_GET['delEvent'])){
    App::getDB()->delete('DELETE FROM events WHERE id=:id', ['id' =>$_GET['delEvent']]);
    header('Location: ../index.php?id=2');
}


/* ==========================================================================
UPDATE EVENT
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
ADD COMPOSITION
========================================================================== */
// Une fois le formulaire envoyé
if(isset($_GET['composition'])) {

        $connexion = App::getDB();
        extract($_POST);


    //$ingredient = implode(',', $_POST['ingredient']);
    $ingredient = explode(',', implode(',', $ingredient));

    foreach ($ingredient as $ing){
        $connexion->insert('INSERT INTO ingredient_recette(recette_id, ingredient_id)
                                               VALUES(?, ?)',
            array($recette, $ing));
    }

        $message .= 'success';

    echo $message;
}
