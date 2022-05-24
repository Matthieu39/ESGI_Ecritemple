<?php
if(isset($_POST['concours_titre'], $_POST['concours_desc'], $_POST['datefin'])) {
  if(!empty($_POST['concours_titre']) AND !empty($_POST['concours_desc']) AND !empty($_POST['datefin'])) {
    $concours_titre= htmlspecialchars($_POST['concours_titre']);
    $concours_desc= htmlspecialchars($_POST['concours_desc']);
    $concours_fin= htmlspecialchars($_POST['datefin']);

    $reqtitle = $bdd->prepare("SELECT title FROM contest WHERE title = ?");
    $reqtitle->execute(array($concours_titre));
    $titleexist=$reqtitle->rowCount();
    if ($titleexist == 0) {
      $ins= $bdd-> prepare('INSERT INTO contest (title, description, publish_date, finish_date) VALUES (?, ?, NOW(), ? )');
      $ins-> execute(array($concours_titre,  $concours_desc, $concours_fin));


      /*concours_img*/
      if(isset($_FILES['concours_img']) AND !empty($_FILES['concours_img']['name'])){
        $maxsize = 2097152; //poids de l'image 2Mo
        $extensions_valides = array('jpg', 'jpeg', 'gif', 'png' ); // Liste des extensions

        if ($_FILES['concours_img']['size'] <= $maxsize) {

          $extensions_upload = strtolower(substr(strrchr($_FILES['concours_img']['name'], '.'),1));  //strrchr(renvoi l'extensions du fichier avec le point) // substr(va premettre d'ignorer un caractère de la chaine)
          if (in_array($extensions_upload, $extensions_valides)) {
            $chemin = "images/contest/contesttitle_" . $concours_titre . '.' . $extensions_upload; /*Emplacement ou sera stocker le fichier*/
            $resultat = move_uploaded_file($_FILES['concours_img']['tmp_name'], $chemin); /* déplacement du fichier*/
            if ($resultat) {
              $ins_contest_img = $bdd->prepare('UPDATE contest SET contest_img = :banner WHERE title = :title');
              $ins_contest_img->execute(array(
                'banner' => $concours_titre. '.' . $extensions_upload,
                'title' => $concours_titre
              ));

            }else {
              $err ='<div class="alert alert-danger mx-auto text-center" role="alert"> Erreur durant l\'importation de votre banière ! </div>';
            }


          }else {
            $err ='<div class="alert alert-danger mx-auto text-center" role="alert"> Votre banière doit être au format jpg, jpeg, gif ou png !  </div>';
          }


        }else {
          $err ='<div class="alert alert-danger mx-auto text-center" role="alert"> Votre banière ne doit pas dépasser 2Mo !</div>';
        }

      }
      /*Fin concours_img*/

      $err='<div class="alert alert-success mx-auto text-center" role="alert"> Concours publié ! </div>';


    }else {
      $err='<div class="alert alert-warning mx-auto text-center" role="alert"> Un concours à déja le même titre !</div>';

    }
}  else {

$err= '<div class="alert alert-warning mx-auto text-center" role="alert"> Remplissez tout les champs ! </div>';
  }
}
$titre='Ecritemple - Admin - Création concours';
 ?>
