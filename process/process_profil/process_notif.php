<?php
$notifs= $bdd->prepare('SELECT * FROM notif WHERE target_id= ?  ORDER BY date_notif DESC ');
$notifs->execute(array($_SESSION['id']));

$seen = $bdd->prepare('UPDATE notif SET seen = 1 WHERE target_id= ?');
$seen->execute(array($_SESSION['id']));
$requser = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
$requser->execute(array($_SESSION['id']));
$userinfo = $requser->fetch();
$date_mysql= $userinfo['date_sign_up'];
$date_sign_up = date("F j, Y",strtotime($date_mysql));
$lu_count = $bdd->prepare('SELECT * FROM messages WHERE receiver_id = ? AND lu = 0');
$lu_count->execute(array( $_SESSION['id']));
$lu_nbr = $lu_count->rowCount();

//liste des Textes
$author_txt= $bdd-> prepare('SELECT * FROM work WHERE user_fk = ?');
$author_txt-> execute(array($userinfo['user_id']));

//NOMBRE DE FOLLOW ETC

$followernb= $bdd->prepare('SELECT * FROM follow WHERE followed= ?');
$followernb->execute(array($getid));
$followernb= $followernb->rowCount();

$followingnb= $bdd->prepare('SELECT * FROM follow WHERE follower= ?');
$followingnb->execute(array($getid));
$followingnb= $followingnb->rowCount();

$totallike= $bdd->prepare('SELECT like_id FROM likes,work  WHERE   work.work_id = likes.work_id AND work.user_fk  = ?');
$totallike->execute(array($getid));
$totallike= $totallike->rowCount();

//  NOMBRE DE FOLLOW ETC



$description = !empty($userinfo['description'])?'<p>'. nl2br($userinfo['description']).'</p>':'<p style="color:#D6D6D6;"> Presentez vous ... </p>';
$avatar = !empty($userinfo['avatar'])?'images/user/avatars/id_'.$userinfo['avatar']:'images/profil_default.png';
$banner = !empty($userinfo['banner'])?'images/user/banners/id_'.$userinfo['banner']:'images/bghome.jpg';
$titre='Profil de '. $userinfo['pseudo'];

 ?>
