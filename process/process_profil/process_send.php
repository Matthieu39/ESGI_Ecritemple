<?php


  if(isset($_POST['send'])) {
    if ( isset($_POST['object']) AND isset($_POST['receiver1']) AND  isset($_POST['message']) AND !empty($_POST['object']) AND !empty($_POST['receiver1']) AND !empty($_POST['message']) ) {

      $receiver = htmlspecialchars($_POST['receiver1']);
      $message = htmlspecialchars($_POST['message']);
      $object = htmlspecialchars($_POST['object']);

      /*Récupère l'id du destinataire*/
      $receiver_id= $bdd->prepare('SELECT user_id FROM user WHERE pseudo = ?');
      $receiver_id ->execute(array($receiver));
      $receiver_exist = $receiver_id->rowCount();

      if ($receiver_exist == 1) {
        $receiver_id = $receiver_id->fetch();
        $receiver_id = $receiver_id['user_id'];


        $insert = $bdd->prepare('INSERT INTO messages (sender_id, receiver_id, message, object, created) VALUES (?, ?, ?, ?, NOW())');
        $insert->execute(array($_SESSION['id'], $receiver_id, $message, $object));

        $error ='<div class="alert alert-success mx-auto text-center" role="alert"> Votre message à bien été envoyé ! </div>';
      } else {
        $error ='<div class="alert alert-danger mx-auto text-center" role="alert">Cet utilisateur n\éxiste pas ... </div>';
      }


    }else {
      $error ='<div class="alert alert-danger mx-auto text-center" role="alert"> Veuillez remplir tout les champs necessaires !</div>';
    }
  }

  $receivers = $bdd->query('SELECT pseudo FROM user WHERE confirme = 1 ORDER BY pseudo');

  if(isset($_GET['r']) AND !empty($_GET['r']) ){
    $r = htmlspecialchars($_GET['r']);
  }
  if(isset($_GET['o']) AND !empty($_GET['o']) ) {
    $o = urldecode($_GET['o']);
    $o = htmlspecialchars($_GET['o']);

    if(substr($o,0,4) != 'RE: '){
    $o = 'RE: '. $o;
    }
}
$lu_count = $bdd->prepare('SELECT * FROM messages WHERE receiver_id = ? AND lu = 0');
$lu_count->execute(array( $_SESSION['id']));
$lu_nbr = $lu_count->rowCount();

$requser = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
$requser->execute(array($_SESSION['id']));
$userinfo = $requser->fetch();
$date_mysql= $userinfo['date_sign_up'];
$date_sign_up = date("F j, Y",strtotime($date_mysql));
$avatar = !empty($userinfo['avatar'])?'images/user/avatars/id_'.$userinfo['avatar']:'images/profil_default.png';
$banner = !empty($userinfo['banner'])?'images/user/banners/id_'.$userinfo['banner']:'images/bghome.jpg';
$titre='Profil de '. $userinfo['pseudo'];
 ?>
