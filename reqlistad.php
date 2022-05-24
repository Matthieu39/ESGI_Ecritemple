<?php
session_start();
 include('includes/config.php');
$titre='Ecritemple';
include('includes/header.php');


$requests = $bdd-> query('SELECT * FROM request ORDER BY req_date DESC');


 ?>



 <ul>
   <?php while($r = $requests->fetch()) { ?>

     <?php
     $pseudo_asker = $bdd->prepare('SELECT pseudo FROM user WHERE user_id = ?');
                    $pseudo_asker->execute(array($r['asker_id']));
                    $pseudo_asker = $pseudo_asker->fetch();
                    $pseudo_asker = $pseudo_asker['pseudo'];
      ?>
     <li>  <a href="###########" > <?= $pseudo_asker ?> : <?= $r['object'] ?> </a> </li>
   <?php } ?>
 </ul>
<?php
 include('includes/footer.php');
     ?>
