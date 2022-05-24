<?php
session_start();
include('includes/config.php');
$requser = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
$requser->execute(array($_SESSION['id']));
$userinfos = $requser->fetch();
if (isset($_SESSION['id']) AND $userinfos['user_id'] == $_SESSION['id'] AND $userinfos['admin'] >0) {

include('process/process_backoffice/gestion_user.php');




include('includes/header.php');
 ?>
 <div class="container">

     <table class="table table-hover table-dark">
       <thead class="">
         <tr>
           <th class="text-center">ID</th>
           <th class="text-center">Pseudo</th>
           <th class="text-center">Suppression de compte</th>
           <th class="text-center">Bannissement</th>
           <th class="text-center">Statut</th>
         </tr>
     <?php while($m = $users->fetch()) {
       $statut = $m['admin']== 0 ?'Utilisateur' :'Administrateur';
       ?>

           <tr>
             <th class="text-center"><?= $m['user_id'] ?></th>

             <th class="text-center"><?=$m['pseudo'] ?></th>

             <td class="text-center" ><span class="font-weight-bold text-uppercase">Attention! Action irreversible!</span> <br> <a class="btn btn-outline-danger" href="backoffice_user.php?supprime=<?= $m['user_id'] ?>">Supprimer</a> </td>
             <?php if($m['ban']== 0 ){ ?>
             <td class="text-center"><a class="btn btn-outline-warning" href="backoffice_user.php?ban=<?= $m['user_id'] ?>">Bannir</a> <?php } ?></td>
             <?php if($m['ban']== 1){ ?>
             <td class="text-center"><a class="btn btn-outline-success" href="backoffice_user.php?deban=<?= $m['user_id'] ?>">Débannir</a> <?php } ?></td>
             <?php if($m['admin']== 0){ ?>
             <td class="text-center"><span class="font-weight-bold text-uppercase"><?= $statut ?></span> <br> <a class="btn btn-outline-warning" href="backoffice_user.php?admin=<?= $m['user_id'] ?>">Rendre Admin</a> <?php } ?></td>
             <?php if($m['admin']!= 0){ ?>
             <td class="text-center"><span class="font-weight-bold text-uppercase"><?= $statut ?></span> <br><a class="btn btn-outline-warning" href="backoffice_user.php?removeadmin=<?= $m['user_id'] ?>">Révoquer</a> <?php } ?></td>
           </tr>

   <?php } ?>

    </table>
 </div>


<?php include('includes/footer.php');
}
else {
  header('location: index.php');
}?>
