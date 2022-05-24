<?php

$requser = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
$requser->execute(array($_SESSION['id']));
$userinfo_header = $requser->fetch();


 ?>
