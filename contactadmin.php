<?php
session_start();
 include('includes/config.php');
$titre='Ecritemple';
include('includes/header.php');


if(isset($_POST['objet_contact'], $_POST['demande'])) {
  if(!empty($_POST['objet_contact']) AND !empty($_POST['demande'])) {

    $objet_contact= htmlspecialchars($_POST['objet_contact']);
    $demande= htmlspecialchars($_POST['demande']);

    $asker= $_SESSION['id'];


    $in= $bdd-> prepare('INSERT INTO request (object, txt, asker_id, req_date) VALUES (?, ?,?, NOW())');
    $in-> execute(array($objet_contact,$demande,$asker ));

    $err_msg= ' requête envoyée';

}  else {

$err_msg= 'Remplissez les deux champs';
  }
}

 ?>


     <h2>Page de contact avec les admins</h2><br><br>
     <p><h3>Sur cette page vous pouvez formulez une requête qui sera traitée par les admins. </h3></p><br><br>

     <form method="post">
       <input type="text" placeholder="objet" name="objet_contact"><br>
       <textarea placeholder="demande" name="demande"></textarea><br>
       <input type="submit" value="envoyer">
     </form>
     <br>
     <?php if(isset($err_msg)){echo $err_msg; } ?>

  <?php   include('includes/footer.php'); ?>
