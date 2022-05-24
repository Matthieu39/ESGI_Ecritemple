<?php

$texte_parpage = 4;
$textetotalreq = $bdd-> query('SELECT work_id FROM work');
$textetotal= $textetotalreq->rowCount();
$pagetotal= ceil($textetotal/$texte_parpage); //fonction pour arrondire au nombre supérieur
if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] > $pagetotal ){
  $_GET['page'] = intval($_GET['page']);
  $pageLive = $_GET['page'];
}else {
  $pageLive = 1;
}
 $Pagedebut = ($pageLive-1) * $texte_parpage;

$textes = $bdd-> query('SELECT * FROM work ORDER BY publish_date DESC LIMIT '.$Pagedebut.','.$texte_parpage);
$titre='Ecritemple - Textes';
 ?>
