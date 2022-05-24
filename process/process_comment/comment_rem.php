<?php
session_start();
 include('../../includes/config.php');
$requser = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
$requser->execute(array($_SESSION['id']));
$userinfos = $requser->fetch();

$reqcominfo =$bdd->query('SELECT * FROM comment');
$reqcominfo=$reqcominfo->fetch();

if (isset($_SESSION['id']) AND $userinfos['user_id'] == $_SESSION['id'] AND $userinfos['admin'] >0 || $reqcominfo['post_id'] == $_SESSION['id'] ) {

if(isset($_GET['removecom']) AND !empty($_GET['removecom'])){
$commentid = (int) $_GET['removecom'];
$req = $bdd -> prepare('SELECT * FROM comment WHERE comment_id= ?');
$req-> execute(array($commentid));
$reqall= $req->fetch();
$req_id=$reqall['work_id'];
$rem = $bdd -> prepare('DELETE FROM comment WHERE comment_id= ?');
$rem-> execute(array($commentid));

header('location: ../../text_content.php?id='.$req_id);
exit;
}
}

 ?>
