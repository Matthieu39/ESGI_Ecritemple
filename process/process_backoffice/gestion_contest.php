<?php
if(isset($_GET['supprime'])){
$supprime = (int) $_GET['supprime'];

$req = $bdd -> prepare('DELETE FROM contest WHERE contest_id= ?');
$req-> execute(array($supprime));
header('location: backoffice_contest.php');

}

$contest = $bdd -> query('SELECT * FROM contest');
$titre='Ecritemple - Admin';
 ?>
