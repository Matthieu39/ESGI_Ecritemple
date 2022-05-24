<?php
if(isset($_GET['id']) AND !empty($_GET['id'])) {

$get_id= htmlspecialchars($_GET['id']);



$textes= $bdd-> prepare('SELECT * FROM work WHERE work_id= ?');
$textes->execute(array($get_id));
$textes= $textes->fetch();


$writer = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
$writer->execute(array($textes['user_fk']));
$writer = $writer->fetch();
$writer_peudo = $writer['pseudo'];
$writer_profil= 'profil.php?id='. $textes['user_fk'];

$title= $textes['work_name'];
$contenu= nl2br($textes['texte']);
$id= $textes['work_id'];

$req_info = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
$req_info->execute(array($_SESSION['id']));
$req_info = $req_info->fetch();



$comments=$bdd->prepare('SELECT * FROM comment WHERE work_id = ?');
$comments->execute(array($get_id));
$commentnbr = $comments->rowCount();

$likes = $bdd->prepare('SELECT like_id FROM likes WHERE work_id = ?');
$likes->execute(array($id));
$likes = $likes->rowCount();

$dislikes = $bdd->prepare('SELECT dislike_id FROM dislikes WHERE work_id = ?');
$dislikes->execute(array($id));
$dislikes = $dislikes->rowCount();


}
 ?>
