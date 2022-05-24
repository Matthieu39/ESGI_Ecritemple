<?php
if(isset($_GET['id']) AND !empty($_GET['id'])) {

$get_id= htmlspecialchars($_GET['id']);

$concours= $bdd-> prepare('SELECT * FROM contest WHERE contest_id= ?');
$concours->execute(array($get_id));

$concours= $concours->fetch();
$concours_titre= $concours['title'];
$description= nl2br($concours['description']);
$concours_img = !empty($concours['contest_img'])?'<div class="card mt-5"> <img src="images/contest/contesttitle_'.$concours['contest_img'].'" alt="" height="500px" widht ="1000px" class="img-rounded"> </div>':' ';

}
$titre='Ecritemple - Concours - '. $concours_titre;
 ?>
