<?php
session_start();
include('../../includes/config.php');



if (isset($_SESSION['id']) AND !empty($_SESSION['id'])) {
  $getid = intval($_GET['id']);
  if(isset($_GET['id']) AND !empty($_GET['id']) ){
    $id_message = intval($_GET['id']);

    $msg = $bdd->prepare('DELETE FROM messages WHERE message_id = ? AND receiver_id = ? ');
    $msg->execute(array($_GET['id'], $_SESSION['id']) );


    header('location:../../profil_recep_msg.php');
  }
}
?>
