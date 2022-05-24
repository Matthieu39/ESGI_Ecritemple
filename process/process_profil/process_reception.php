<?php
$msg = $bdd->prepare('SELECT * FROM messages WHERE receiver_id = ? ORDER BY created DESC');
$msg->execute(array($_SESSION['id']));
$msg_nbr = $msg->rowCount();

$lu_count = $bdd->prepare('SELECT * FROM messages WHERE receiver_id = ? AND lu = 0');
$lu_count->execute(array( $_SESSION['id']));
$lu_nbr = $lu_count->rowCount();

$requser = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
$requser->execute(array($_SESSION['id']));
$userinfo = $requser->fetch();
$date_mysql= $userinfo['date_sign_up'];
$date_sign_up = date("F j, Y",strtotime($date_mysql));
//////////////////////////////////////////////////////////////

$description = !empty($userinfo['description'])?'<p>'. nl2br($userinfo['description']).'</p>':'<p style="color:#D6D6D6;"> Presentez vous ... </p>';
$avatar = !empty($userinfo['avatar'])?'images/user/avatars/id_'.$userinfo['avatar']:'images/profil_default.png';
$banner = !empty($userinfo['banner'])?'images/user/banners/id_'.$userinfo['banner']:'images/bghome.jpg';
$titre='Profil de '. $userinfo['pseudo'];
 ?>
