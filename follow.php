<?php
session_start();
 include('includes/config.php');
$titre='Ecritemple';
include('includes/header.php');

$getfld= intval($_GET['followedid']);


if($getfld != $_SESSION['id']){

  $alrfld= $bdd->prepare('SELECT * FROM follow WHERE followed = ? AND follower= ? ');
  $alrfld->execute(array($getfld ,$_SESSION['id'] ));
  $alrfld= $alrfld->rowCount();

  if($alrfld == 0){
    $newfl= $bdd->prepare('INSERT INTO follow(followed, follower) VALUES(?,?)');
    $newfl->execute(array($getfld, $_SESSION['id']));

// NOTIFICATIONS


        $trigger_flw = $bdd->prepare('SELECT pseudo FROM user WHERE user_id = ?');
                       $trigger_flw->execute(array($_SESSION['id']));
                       $trigger_flw = $trigger_flw->fetch();
                       $trigger_flw = $trigger_flw['pseudo'];

                       $notif_flw= $bdd->prepare('INSERT INTO notif(trigger_id, target_id,pseudo,message) VALUES (?,?,?,"vous suit")');
                       $notif_flw->execute(array( $_SESSION['id'], $getfld, $trigger_flw));



     // NOTIFICATIONS


  }elseif ($alrfld == 1) {
    $delfl= $bdd->prepare('DELETE FROM follow WHERE followed = ? AND follower= ?');
    $delfl->execute(array($getfld, $_SESSION['id']));
  }
}
header('Location: profil.php?id=' .$getfld );

 ?>
