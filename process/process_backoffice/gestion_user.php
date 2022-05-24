<?php

if(isset($_GET['supprime'])){
$supprime = (int) $_GET['supprime'];

$req = $bdd -> prepare('DELETE FROM user WHERE user_id= ?');
$req-> execute(array($supprime));
header('location: backoffice_user.php');

}

if(isset($_GET['ban']) AND !empty($_GET['ban'])){
$ban = (int) $_GET['ban'];

$req = $bdd -> prepare('UPDATE user SET ban = 1 WHERE user_id= ?');
$req-> execute(array($ban));
header('location: backoffice_user.php');
}

if(isset($_GET['deban']) AND !empty($_GET['deban'])){
$deban = (int) $_GET['deban'];

$req = $bdd -> prepare('UPDATE user SET ban = 0 WHERE user_id= ?');
$req-> execute(array($deban));
header('location: backoffice_user.php');
}

if(isset($_GET['admin']) AND !empty($_GET['admin'])){
$admin = (int) $_GET['admin'];

$req = $bdd -> prepare('UPDATE user SET admin = 1 WHERE user_id= ?');
$req-> execute(array($admin));
header('location: backoffice_user.php');
}
if(isset($_GET['removeadmin']) AND !empty($_GET['removeadmin'])){
$admin = (int) $_GET['removeadmin'];

$req = $bdd -> prepare('UPDATE user SET admin = 0 WHERE user_id= ?');
$req-> execute(array($admin));
header('location: backoffice_user.php');
}

$users = $bdd -> query('SELECT * FROM user');
$titre='Ecritemple - Admin';

 ?>
