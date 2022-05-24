<?php
$requser = $bdd -> prepare('SELECT * FROM user WHERE user_id = ?');
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();
$pseudo = $user['pseudo'];
$mail = $user['email'];
$description = !empty($user['description'])?$user['description']:'Presentez vous ... ';

/* Modification pseudo*/
if  (isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $pseudo){
  $newpseudo =htmlspecialchars(trim($_POST['newpseudo']));
  $newpseudolength= strlen($newpseudo);

  if (preg_match('/^[a-zA-Z0-9_]+$/',$newpseudo) && $newpseudolength > 7 && $newpseudolength < 20) {
    $reqpseudo = $bdd->prepare("SELECT * FROM user WHERE pseudo = ?");
    $reqpseudo->execute(array($newpseudo));
    $pseudoexist = $reqpseudo->rowCount();

    if ($pseudoexist == 0) {
      /*Mis a jour du pseudo*/
      $insertpseudo = $bdd -> prepare('UPDATE user set pseudo = ? WHERE user_id = ?');
      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
      /*FIN MAJ*/
    } else {
      $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Pseudo déjà utilisé !</div>';
    }




  }else {
    $message = '<div class="alert alert-danger mx-auto text-center" role="alert"> Votre pseudo doit contenir entre 8 - 20 caractères alphanumérique ! </div>';
  }



}
/* Fin pseudo*/

/* Modification mail*/
if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $mail){
  $newmail =htmlspecialchars(strtolower(trim($_POST['newmail'])));

  if (filter_var($newmail, FILTER_VALIDATE_EMAIL)) {
    $reqmail = $bdd->prepare("SELECT * FROM user WHERE email = ?");
    $reqmail->execute(array($newmail));
    $mailexist = $reqmail->rowCount();

    if ($mailexist == 0) {
      /*Mis a jour du mail*/
      $insertmail = $bdd -> prepare('UPDATE user set email = ? WHERE user_id = ?');
      $insertmail->execute(array($newmail, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
      /*FIN MAJ*/
    }else {
      $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Adresse mail déjà utilisée !</div>';
    }

  }

}
/* Fin mail*/

/*description*/
if (isset($_POST['description']) AND !empty($_POST['description']) AND $_POST['description'] != $description) {
  $newdesc = htmlspecialchars($_POST['description']);
  /*Mis a jour de la description*/
  $insertdesc = $bdd -> prepare('UPDATE user set description = ? WHERE user_id = ?');
  $insertdesc->execute(array($newdesc, $_SESSION['id']));
  header('Location: profil.php?id='.$_SESSION['id']);
  /*FIN MAJ*/
}
/*Fin description*/


/*Avatar*/
if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
  $maxsize = 2097152; //poids de l'image 2Mo
  $extensions_valides = array('jpg', 'jpeg', 'gif', 'png' ); // Liste des extensions

  if ($_FILES['avatar']['size'] <= $maxsize) {

    $extensions_upload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'),1));  //strrchr(renvoi l'extensions du fichier avec le point) // substr(va premettre d'ignorer un caractère de la chaine)
    if (in_array($extensions_upload, $extensions_valides)) {
      $chemin = "images/user/avatars/id_" . $_SESSION['id'] . '.' . $extensions_upload; /*Emplacement ou sera stocker le fichier*/
      $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin); /* déplacement du fichier*/
      if ($resultat) {
        $updateavatar = $bdd->prepare('UPDATE user SET avatar = :avatar WHERE user_id = :id');
        $updateavatar->execute(array(
          'avatar' => $_SESSION['id']. '.' . $extensions_upload,
          'id' => $_SESSION['id']
        ));
        header('Location: profil.php?id='.$_SESSION['id']);
      }else {
        $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Erreur durant l\'importation de votre avatar ! </div>';
      }


    }else {
      $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Votre avatar doit être au format jpg, jpeg, gif ou png !  </div>';
    }


  }else {
    $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Votre avatar ne doit pas dépasser 2Mo !</div>';
  }

}
/*Fin avatar*/
/*Baniere*/
if(isset($_FILES['banner']) AND !empty($_FILES['banner']['name'])){
  $maxsize = 2097152; //poids de l'image 2Mo
  $extensions_valides = array('jpg', 'jpeg', 'gif', 'png' ); // Liste des extensions

  if ($_FILES['banner']['size'] <= $maxsize) {

    $extensions_upload = strtolower(substr(strrchr($_FILES['banner']['name'], '.'),1));  //strrchr(renvoi l'extensions du fichier avec le point) // substr(va premettre d'ignorer un caractère de la chaine)
    if (in_array($extensions_upload, $extensions_valides)) {
      $chemin = "images/user/banners/id_" . $_SESSION['id'] . '.' . $extensions_upload; /*Emplacement ou sera stocker le fichier*/
      $resultat = move_uploaded_file($_FILES['banner']['tmp_name'], $chemin); /* déplacement du fichier*/
      if ($resultat) {
        $updateavatar = $bdd->prepare('UPDATE user SET banner = :banner WHERE user_id = :id');
        $updateavatar->execute(array(
          'banner' => $_SESSION['id']. '.' . $extensions_upload,
          'id' => $_SESSION['id']
        ));
        header('Location: profil.php?id='.$_SESSION['id']);
      }else {
        $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Erreur durant l\'importation de votre banière ! </div>';
      }


    }else {
      $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Votre banière doit être au format jpg, jpeg, gif ou png !  </div>';
    }


  }else {
    $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Votre banière ne doit pas dépasser 2Mo !</div>';
  }

}
/*Fin Banière*/

/* A effacer car redirection vers la page profil*/
$requser = $bdd -> prepare('SELECT * FROM user WHERE user_id = ?');
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();
$pseudo = $user['pseudo'];
$mail = $user['email'];
$description = !empty($user['description'])?$user['description']:'Presentez vous ... ';
/*Fin de la parti à effacer */

$titre='Edition de mon profil';
 ?>
