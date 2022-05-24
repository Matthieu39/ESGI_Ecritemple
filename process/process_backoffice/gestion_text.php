<?php
if(isset($_GET['supprime'])){
$supprime = (int) $_GET['supprime'];

$req = $bdd -> prepare('DELETE FROM work WHERE work_id= ?');
$req-> execute(array($supprime));
header('location: backoffice_text.php');

}

$work = $bdd -> query('SELECT * FROM work');
$titre='Ecritemple - Admin';

 ?>
