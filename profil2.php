<?php
session_start();
// include('process/process_profil.php');


include('includes/config.php');
if(isset($_GET['id']) AND $_GET['id'] > 0){
  $getid = intval($_GET['id']); // convertie en nombre
  $requser = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
  $requser->execute(array($getid));
  $userinfo = $requser->fetch();
  $date_mysql= $userinfo['date_sign_up'];
  $date_sign_up = date("F j, Y",strtotime($date_mysql));
$titre='Profil de '. $userinfo['pseudo'];
include('includes/header.php');


//liste des Textes
$author_txt= $bdd-> prepare('SELECT * FROM work WHERE user_fk = ?');
$author_txt-> execute(array($userinfo['user_id']));




?>
<div class="mr-5 container-fluid">
  <div class="container-fluid  ">
    <div class="container-fluid d-flex align-items-baseline justify-content-between col-12">
        <ul class="nav flex-column d-block">
          <li class="nav-item">
            <a class="nav-link link" href="#">Abonné: <span class="badge badge-primary badge-pill">12</span></a>
          </li>
          <li class="nav-item">

            <a class="nav-link link" href="#">Like: <span class="badge badge-primary badge-pill">12</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link link" href="#">Œuvres</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link" href="#">Playlist</a>
          </li>



          <?php
            if (isset($_SESSION['id']) AND $userinfo['user_id'] == $_SESSION['id']) {
           ?>

           <!-- NOTIFICATIONS -->


                     <li class="nav-item">
                       <a class="nav-link link" href="#">Notifications <span class="badge badge-primary badge-pill">12</span></a>
                     </li>

                     <!-- NOTIFICATIONS -->


                <li class="nav-item">
                <a href="edit_profil.php" class="btn btn-light" role="button">Modifier mon profil</a>
                </li>
          <?php

          // debut rajout pour follow
          }elseif (isset($_SESSION['id']) AND $userinfo['user_id'] != $_SESSION['id'] ) {

              $alrfld= $bdd->prepare('SELECT * FROM follow WHERE followed = ? AND follower= ? ');
              $alrfld->execute(array($userinfo['user_id'] ,$_SESSION['id'] ));
              $alrfld= $alrfld->rowCount();

              if($alrfld == 0){

                ?>
                <a href="follow.php?followedid=<?= $userinfo['user_id'] ?>" class="btn btn-light" role="button">S'abonner</a>
                <?php
                }elseif ($alrfld == 1) {
                  ?>
                  <a href="follow.php?followedid=<?= $userinfo['user_id'] ?>" class="btn btn-light" role="button">Se désabonner</a>

          <?php  }} ?>
<!-- fin rajout pour follow  -->


        </ul>


      <div class="container  d-flex flex-column  text-justify mx-4 p-2 w-100 bd-highlight">
        <div class="card mt-5">
          <img src="images/bghome.jpg" alt="" height="300px" widht ="1122px" class="img-rounded">
          <div class="card-img-overlay ">  <!-- banière -->

            <img src="images/logo12.png" alt="" width="150px" class="mx-auto d-block rounded-circle ">
            <h2 class="py-3 text-center"> <?php echo $userinfo['pseudo']; ?> </h2>
            <p class="text-center pb-3">Membre depuis le : <?php echo $date_sign_up; ?> </p>
          </div>
        </div>
        <div class="container rounded bg-dark my-3 p-3" height="300px">
          <h3>Déscription:</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>

        <div class="rounded bg-dark">



        <table class="table table-striped">
          <tbody>

            <?php while($a = $author_txt->fetch()) { ?>
              <tr>
              <td><li>  <a href="contenutext.php?id=<?= $a['work_id'] ?> "><?= $a['work_name'] ?> </a> </li></td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
                </div>
      </div>
    </div>
  </div>
</div>


<?php  include('includes/footer.php');
};?>
