<?php

  if (isset($_GET['pseudo'], $_GET['key']) AND !empty($_GET['pseudo']) AND !empty($_GET['key'])) {
    $pseudo = htmlspecialchars(urldecode($_GET['pseudo']));
    $key = htmlspecialchars($_GET['key']);

    $requser = $bdd->prepare("SELECT * FROM user WHERE pseudo = ? AND confirmekey = ?");
    $requser ->execute(array($pseudo, $key));
    $userexist = $requser->rowCount();
    if ($userexist == 1) {
      $user = $requser->fetch();
      if($user['confirme'] == 0){
        $updateuser = $bdd->prepare("UPDATE user SET confirme = 1 WHERE pseudo = ? AND confirmekey= ?");
        $updateuser->execute(array($pseudo,$key));
        $msg_conf= '<h2 class="mx-auto"> Merci d\'avoir confirmez votre compte !<br> <a href="sign_in.php" class="loginhere-link link">Connectez-vous !</a></h2>';
      }
      else {
        $msg_conf='<h2 class="mx-auto"> Votre compte à déjà été confirmé ! <br> <a href="sign_in.php" class="loginhere-link link">Connectez-vous !</a></h2>';
      }
    }
    else {
      $msg_conf='<h2 class="mx-auto"> L\'utilisateur n\'éxiste pas ! <br> <a href="sign_up.php" class="loginhere-link link">Inscrivez-vous !</a></h2>';
    }
  }
  else {
    $msg_conf='<h2 class="mx-auto"> On n\'apprend pas à un vieux singe à faire la grimace ! <br> <a href="index.php" class="loginhere-link link">Retour à l\'accueil .</a></h2>';
  }
 ?>
