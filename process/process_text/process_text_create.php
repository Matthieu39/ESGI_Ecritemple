<?php
if(isset($_POST['titre'], $_POST['texte'])) {
  if(!empty($_POST['titre']) AND !empty($_POST['texte'])) {

    $titre= htmlspecialchars($_POST['titre']);
    $texte= htmlspecialchars($_POST['texte']);
    $user= $_SESSION['id'];

    $ins= $bdd-> prepare('INSERT INTO work (work_name, texte, publish_date, user_fk) VALUES (?, ?, NOW(),? )');
    $ins-> execute(array($titre,  $texte, $user));

    // NOTIF ABONNES
    $listabo= $bdd-> prepare('SELECT * FROM follow WHERE followed = ? ');
    $listabo->execute(array($user));
    $listabo = $listabo->fetch();
    $listabo = $listabo['follower'];


                    $trigger_publi = $bdd->prepare('SELECT pseudo FROM user WHERE user_id = ?');
                   $trigger_publi->execute(array($_SESSION['id']));
                   $trigger_publi = $trigger_publi->fetch();
                   $trigger_publi = $trigger_publi['pseudo'];


    $notifabo= $bdd-> prepare('INSERT INTO notif (trigger_id, target_id,pseudo,message, datenotif) VALUES (?,?,?,"a publié un texte", NOW())');
    $notifabo->execute(array($user,$listabo,$trigger_publi));


    // NOTIF ABONNES
    $err= '<div class="alert alert-success mx-auto text-center" role="alert"> Texte publié !</div>';

}  else {

$err= '<div class="alert alert-warning mx-auto text-center" role="alert">Remplissez tout les champs !</div>';
  }
}
$titre='Ecritemple - Rédiger';
 ?>
