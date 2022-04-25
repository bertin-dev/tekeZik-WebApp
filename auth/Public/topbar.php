<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <!--<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Rechecher..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>-->

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <!--<li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Recherche..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>-->

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <?php
                /*$connexion = \App::getDB();
                $result = $connexion->rowCount('SELECT * FROM comments c
                                                      INNER JOIN comments_reply cr
                                                      ON c.id = cr.comments_id
                                                      ');
                if(intval($result)<100)
                    echo '<span class="badge badge-danger badge-counter">'.$result.'</span>';
                else
                    echo '<span class="badge badge-danger badge-counter">99+</span>';*/
                ?>
            </a>
            <!-- Dropdown - Alerts -->
            <div id="notif" class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Notifications
                </h6>
                    <?php
                    /*foreach($connexion->query('SELECT posts.id AS post_id, title, posts.content AS post_content, featured_image, post_type, likes, dislike, favourited, posts.created_at AS p_create, category_id,
                                                           c.id, c.content AS c_content,
                                                           cr.id, cr.content AS cr_content, comments_id,
                                                           i.id, url_miniature, url, vie_ass_id,
                                                           first_name, last_name
                                                      FROM posts
                                                      INNER JOIN comments c
                                                      ON posts.id = c.post_id
                                                      INNER JOIN comments_reply cr
                                                      ON c.id = cr.comments_id
                                                      INNER JOIN images i
                                                      ON posts.id = i.post_id
                                                      INNER JOIN users u
                                                      ON posts.user_id = u.id
                                                      ORDER BY posts.id DESC
                                                      LIMIT 4
                                                      ') as $retour):
                        $img = isset($retour->url) ? str_replace('../../public/', '../public/', $retour->url): 'assets/img/slide/slide-1.jpg';

                        echo '<a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle">
                        <img class="img-thumbnail" src="'.$img.'" alt="">
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500"><time class="timeago" datetime="'.$retour->p_create.'"></time></div>
                        <span class="font-weight-bold">'.$retour->title.'</span><br>
                        <span class="small text-gray-500">'.$retour->c_content.'</span>
                           <span class="small text-gray-500"><small>'.$retour->first_name.' '.$retour->last_name.'</small></span>
                    </div>
                </a>';
                    endforeach;*/
                    ?>
                <a id="allnotifs" class="dropdown-item text-center small text-gray-500" href="#">Afficher plus</a>
            </div>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <?php
                /*$result = $connexion->rowCount('SELECT * FROM newsletters');
                if(intval($result)<100)
                    echo '<span class="badge badge-danger badge-counter">'.$result.'</span>';
                else
                    echo '<span class="badge badge-danger badge-counter">99+</span>';*/

                ?>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Newsletter
                </h6>
                <?php
               /* foreach($connexion->query('SELECT * FROM newsletters
                                                      ORDER BY id DESC
                                                      LIMIT 4
                                                      ') as $retour):

                echo '<a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">'.$retour->email_newsletter.'</div>
                        <div class="small text-gray-500">'.date('d/m/Y H:i:s', $retour->created_at).'</div>
                    </div>
                </a>';
                endforeach;*/
                ?>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
          /*      foreach (App::getDB()->query('SELECT * FROM users WHERE id="'.$user_id.'" ORDER BY id DESC') AS $mod):
                echo ' <span class="mr-2 d-none d-lg-inline text-gray-600 small">'.$mod->first_name . ' '.$mod->last_name.'</span>
                <i class="fas fa-fw fa-user"></i>';
                endforeach;*/
                ?>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#register">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Ajouter un utilisateur</a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>