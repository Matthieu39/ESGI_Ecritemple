<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php echo (!empty($titre))?'<title>'.$titre.'</title>':'<title> Ecritemple </title>'; ?>
    <link rel="stylesheet" type="text/css" href="CSS/plug/bootstrap.css">
    <link rel="stylesheet"  type="text/css" href="CSS/style.css">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <?php
    $connected = isset($_SESSION['id']) ? true : false;
    $redirect_rediger =  isset($_SESSION['id']) ? 'text_create.php' : 'sign_in.php';
    $redirect_textes =  isset($_SESSION['id']) ? 'text.php' : 'sign_in.php';
    $redirect_concours =  isset($_SESSION['id']) ? 'contest_list.php' : 'sign_in.php';
    $redirect_contact = isset($_SESSION['id'])  ?  'contactadmin.php' : 'sign_in.php';
    if ($connected) {
      include('fonctions.php');
      $avatar_nav = !empty($userinfo_header['avatar'])?'images/user/avatars/id_'.$userinfo_header['avatar']:'images/profil_default.png';
      $profil_nav= 'profil.php?id='.$_SESSION['id'];
      $admin = $userinfo_header['admin'] > 0 ?true:false;
    }

    ?>
  </head>
  <body class="header">
    <div class="d-flex flex-column justify-content-between mh-100 container-fluid px-0 ">
      <div class="mw-100" id="menu">


        <header>
          <div class="">
            <nav class="container navbar navbar-default navbar-expand-lg navbar-light bg-light sticky-top col-md-10 col-lg-12 col-xl-10">

              <a class="navbar-brand" href="index.php">
                <img src="images/Logo.png" alt="Logo" width="80px">
              </a>

              <button class="navbar-toggler" id="hamburger-button">
                 <span class="navbar-toggler-icon"></span>
                </button>

            <div id="hamburger-topbar">
              <div id="hamburger-topbar-header">
                <div class="container-fluid">
                  <a class="navbar-brand"href="index.php"><img src="images/Logo.png" alt="Logo" width="80px"><p>Ecritemple</p></a>
                </div>
              </div>
              <div id="hamburger-topbar-body"></div>
            </div>

            <div id="hamburger-overlay"></div>

             <div class="collapse navbar-collapse" id="hamburger-content" >

               <ul class="navbar-nav m-auto main_ul">

                 <li class="nav-item ">
                   <a href="<?php echo $redirect_rediger;?>" class="nav-link">Rédiger</a>
                 </li>
                 <li class="nav-item ">
                   <a href="<?php echo $redirect_textes;?>" class="nav-link">Textes</a>
                 </li>
                 <li class="nav-item ">
                   <a href="<?php echo $redirect_concours;?>" class="nav-link">Concours</a>
                 </li>

                 <li class="nav-item ">
                   <a href="<?php echo  $redirect_contact;?>" class="nav-link">Contact</a>
                 </li>



               </ul>


               <form class="form-inline" method="POST" action="send-data.php">
                 <div class="input-group container-fluid">
                   <input class="form-control mr-sm-2 inputsearch navbar-default text-light" type="text"  value="" placeholder="Rechercher" id="search_user" onkeyup="onKeyUp()">
                   <input type="hidden" id="search-user-list" name="search-user-list">
                   <span class="input-group-btn"><button class="btn inputsearch" type="submit"><img src="images/icons/search-solid.svg" width="20px"></button></span>
                   <div id="products-list"></div>
                  </div>
               </form>

               <!-- <form method="POST" action="send-data.php">
                  <input type="text" id="product" name="product" onkeyup="onKeyUp();">
                  <input type="hidden" id="productCode" name="productCode">
                  <div id="products-list"></div>
                </form> -->



               <?php if($connected){ ?>

                  <a href="sign_out.php" class="button button-sign-out nav-link ">Déconnexion</a>
                  <a href=" <?php echo $profil_nav; ?> " class="button button-sign-up nav-link"><span><img src=" <?php echo $avatar_nav ?> " alt="" width="40px" class="rounded-circle"> </span> </a>
            <?php }else { ?>


                    <a href="sign_in.php" class="button button-sign-in nav-link">Connexion</a>
                    <a href="sign_up.php" class="button button-sign-up nav-link">Inscription</a>


             <?php   } ?>
           </div>

            </nav>
          </div>
          <!-- if administrateur alors afficher -->
          <?php if($connected){
              if ($admin){ ?>
            <div class="container mt-5 ">
              <h4 class="text-center text-uppercase" >Menu admin</h4>
              <div class=" d-flex justify-content-center box align-items-baseline">

                  <a class="btn btn-dark mx-2 btn-lg" href="backoffice_user.php">Gérer les utilisateurs</a>
                  <a class="btn btn-dark mx-2 btn-lg" href="contest_create.php">Création de concours</a>
                  <a class="btn btn-dark mx-2 btn-lg" href="backoffice_contest.php">Gérer les concours</a>
                  <a class="btn btn-dark mx-2 btn-lg" href="backoffice_text.php">Gérer les textes</a>
                  <a class="btn btn-dark mx-2 btn-lg" href="reqlistad.php">Requêtes</a>


              </div>
            </div>
                <?php }?>
          <?php }?>

        <!-- Fin if administrateur -->
        </header>
      </div>
        <main class="container-fluid my-5">
