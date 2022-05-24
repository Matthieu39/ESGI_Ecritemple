<?php
session_start();
include('includes/config.php');
$requser = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
$requser->execute(array($_SESSION['id']));
$userinfos = $requser->fetch();
if (isset($_SESSION['id']) AND $userinfos['user_id'] == $_SESSION['id'] AND $userinfos['admin'] >0) {

  include('process/process_backoffice/gestion_contest.php');





include('includes/header.php');
 ?>
 <div class="container">

     <table class="table table-hover table-dark">
       <thead class="">
         <tr>
           <th class="text-center">ID</th>
           <th class="text-center">Nom du texte</th>
           <th class="text-center">Suppresion du texte</th>
         </tr>
     <?php while($c = $contest->fetch()) {?>

           <tr>
             <th class="text-center"><?= $c['contest_id'] ?></th>

             <th class="text-center"> <a class="text-light" href="contest_desc.php?id=<?= $c['contest_id']?>"><?=$c['title'] ?></a> </th>

             <td class="text-center"><a class="btn btn-outline-danger" href="backoffice_contest.php?supprime=<?= $c['contest_id'] ?>">Supprimer</a> </td>



   <?php } ?>

    </table>
 </div>


<?php include('includes/footer.php');
}
else {
  header('location: index.php');
}?>
