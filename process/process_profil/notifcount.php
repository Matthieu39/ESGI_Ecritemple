<?php
session_start();
 include('../../includes/config.php');

$push= $bdd->prepare('SELECT * FROM notif WHERE target_id= ? AND seen = 0');
$push->execute(array($_SESSION['id']));
$push= $push->rowCount();


echo $push;

?>
