<?php
session_start();
include('includes/config.php');
$requser = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
$requser->execute(array($_SESSION['id']));
$userinfos = $requser->fetch();
if (isset($_SESSION['id']) AND $userinfos['user_id'] == $_SESSION['id'] AND $userinfos['admin'] >0) {

include('process/process_backoffice/gestion_text.php');




include('includes/header.php');
 ?>
 <div class="container">

     <table class="table table-hover table-dark">
       <thead class="">
         <tr>
           <th class="text-center">ID</th>
           <th class="text-center">Nom du texte</th>
           <th class="text-center">Auteur</th>
           <th class="text-center">Suppresion du texte</th>
         </tr>
     <?php while($w = $work->fetch()) {
       $writer = $bdd->prepare('SELECT pseudo FROM user WHERE user_id = ?');
       $writer->execute(array($w['user_fk']));
       $writer = $writer->fetch();
       $writer_pseudo = $writer['pseudo'];
       ?>

           <tr>
             <th class="text-center"><?= $w['work_id'] ?></th>

             <th class="text-center"> <a class="text-light" href="text_content.php?id=<?= $w['work_id'] ?>"><?=$w['work_name'] ?></a> </th>

             <th class="text-center" ><a class="text-light" href="profil.php?id=<?= $w['user_fk'] ?>"> <?=  $writer_pseudo ?></a> </th>
             <td class="text-center"><a class="btn btn-outline-danger" href="backoffice_text.php?supprime=<?= $w['work_id'] ?>">Supprimer</a> </td>



   <?php } ?>

    </table>
 </div>


<?php
include('includes/footer.php');
}
else {
  header('location: index.php');
}
?>
