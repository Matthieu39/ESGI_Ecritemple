<?php
session_start();
if(isset($_POST['formconnexion'])){

  $mailconnect = htmlspecialchars($_POST['mailconnect']);
  $mdpconnect = sha1($_POST['mdpconnect']);
  if(!empty($mailconnect) AND !empty($mdpconnect)){
    $requser = $bdd->prepare("SELECT * FROM user WHERE email = ? OR pseudo= ? AND password = ?");
    $requser->execute(array($mailconnect, $mailconnect, $mdpconnect));
    $userexist = $requser->rowCount();
    if ($userexist == 1) {
      $userinfo= $requser->fetch();
      if ($userinfo['confirme'] == 1) {
        if ($userinfo['ban'] == 0) {
          $_SESSION['id'] = $userinfo['user_id'];
          $_SESSION['email'] = $userinfo['email'];
          header('Location: profil.php?id='.$_SESSION['id']);
        }else {
          $message ='<div class="alert alert-info mx-auto text-center" role="alert"> Votre compte est banni ! </div>';
        }


      }
      else {
        $message ='<div class="alert alert-warning mx-auto text-center" role="alert"> Votre compte n\'est pas confirmé ! Consultez vos mail ! ( verifiez vos spams ^^)</div>';
      }

    }
    else {
      $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Mauvais mail ou mot de passe !</div>';
    }





  }
  else {
    $message = '<div class="alert alert-danger mx-auto text-center" role="alert">Tous les champs doivent être complétés !</div>';
  }
}
?>
