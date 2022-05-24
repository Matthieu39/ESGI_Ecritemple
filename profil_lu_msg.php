<?php
session_start();
include('includes/config.php');



if (isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
  if(isset($_GET['id']) AND !empty($_GET['id']) ){
    include('process/process_profil/process_lu.php');


    include('includes/header.php');
    /*Fin des parties commune*/
?>
<div class="mr-5 container-fluid">
  <div class="container-fluid  ">
    <div class="container-fluid d-flex align-items-baseline justify-content-between col-12">
        <ul class="nav flex-column d-block">
          <li class="nav-item">

            <!-- //NOMBRE DE FOLLOW ETC -->


            <a class="nav-link link">Abonné <span class="badge badge-primary badge-pill">0</span></a>
          </li>
          <li class="nav-item">

            <a class="nav-link link">Abonnements <span class="badge badge-primary badge-pill">0</span></a>
          </li>
          <li class="nav-item">



            <a class="nav-link  link" >Like <span class="badge badge-primary badge-pill">0</span></a>
          </li>

          <?php
            if (isset($_SESSION['id']) AND $userinfo['user_id'] == $_SESSION['id']) {
           ?>
           <!-- NOTIFICATIONS -->


                     <!-- <li class="nav-item" >
                       <div class="d-flex flex-row align-items-baseline" >
                         <a class="nav-link link" href="notifs.php" >Notifications </a>
                         <a href="notifs.php" class="badge badge-primary badge-pill" role="button" id="notifnum"></a>

                       </div>

                     </li> -->

                     <!-- NOTIFICATIONS -->
           <li class="nav-item">
             <a class="nav-link link" href="profil_recep_msg.php">Mes messages <span class="badge badge-primary badge-pill"><?=  $lu_nbr ?></span></a>
           </li>
           <li class="nav-item">
             <a class="nav-link link" href="profil_send_msg.php">Envoyer un mesage</a>
           </li>


          <li class="nav-item">
            <a href="profil_edit.php" class="btn btn-light" role="button">Modifier mon profil</a>
          </li>

          <?php

          // debut rajout pour follow
          } elseif (isset($_SESSION['id']) AND $userinfo['user_id'] != $_SESSION['id'] ) {

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
          <img src="<?php echo $banner; ?>" alt="" height="300px" widht ="1122px" class="img-rounded">
          <div class="card-img-overlay ">  <!-- banière -->

            <img src=" <?php echo $avatar; ?> " alt="" width="150px" class="mx-auto d-block rounded-circle ">
            <h2 class="py-3 text-center"> <?php echo $userinfo['pseudo']; ?> </h2>
            <p class="text-center pb-3" style="color:">Membre depuis le : <?php echo $date_sign_up; ?> </p>
          </div>
        </div>

              <!--  Tronc a personnaliser selon la pâge-->
              <?php
                if ($msg_nbr == 0 ) { ?>
                  <div class="container rounded bg-dark my-3 p-3" height="300px">

                    <h4 class=" text-center "> Erreur</h4>

                  </div>
              <?php  }else {



                $pseudo = $bdd->prepare('SELECT pseudo FROM user WHERE user_id = ?');
                $pseudo->execute(array($m['sender_id']));
                $pseudo_sender = $pseudo->fetch();
                $pseudo_sender = $pseudo_sender['pseudo'];


                 ?>

                 <div class="container rounded bg-dark my-3 p-3 " height="300px">

                   <h4> <b> <?= $pseudo_sender ?></b> </h4>
                   <h6><b>Objet:</b> <?= $m['object'] ?> </h6>
                   <em class="small text-secondary">Vous à envoyé:</em> <br>
                   <?php if($m['lu'] == 1) { ?> <em class="small text-secondary float-right">Ce méssage a déjà été lu</em> <br>  <?php  }?>




                   <em class="small text-secondary"> Envoyé le: <?php echo date("d.m.y à H:i",strtotime($m['created'])); ?></em>




                   <p class="py-2">  <?= nl2br($m['message'])?>  </p>

                   <p class="text-right ">
                     <a href="profil_send_msg.php?r=<?= urlencode(strtolower($pseudo_sender))?>&o=<?=urlencode($m['object'])?>" class=" link">Répondre</a> <br>
                     <a href="process/process_profil/profil_delete_msg.php?id=<?= $m['message_id'] ?>" class="link">Supprimer le message</a>
                   </p>

                 </div>


               <!--Fin de la partie message envoyer discussion-->
               <?php } ?>
              <!-- Fin du Tronc a personnaliser selon la pâge-->
          </div>
        </div>
      </div>
    </div>

 <?php
 include('includes/footer.php');

  $lu=$bdd->prepare('UPDATE messages SET lu = 1 WHERE message_id = ?');
  $lu->execute(array($m['message_id']));

}else {
  header('Location: sign_in.php');}
 }else {
   header('Location: sign_in.php');
 }?>
