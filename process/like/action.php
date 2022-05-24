<?php
session_start();
include('../../includes/config.php');
if(isset($_GET['t'],$_GET['id']) && isset($_SESSION['id']) && !empty($_GET['t']) && !empty($_GET['id'])) {
    $getid = (int) $_GET['id'];
    // conversion en int, notamment pour éviter les injections SQL
    $gett = (int) $_GET['t'];

    $sessionid = $_SESSION['id'];

    $check = $bdd->prepare('SELECT * FROM work WHERE work_id = ?');
    $check->execute(array($getid));

    $recup=$check->fetch();
    $recupid=$recup['user_fk'];
    $recuptxtname=$recup['work_name'];


    if($check->rowCount() == 1) {

        if($gett == 1)
        {
          $check_like = $bdd->prepare('SELECT like_id FROM likes WHERE work_id = ? AND user_id = ?');
          $check_like->execute(array($getid,$sessionid));
          //
          $del = $bdd->prepare('DELETE FROM dislikes WHERE work_id = ? AND user_id = ?');
          $del->execute(array($getid,$sessionid));
          // //
          if($check_like->rowCount() == 1)
              {
                $del = $bdd->prepare('DELETE FROM likes WHERE work_id = ? AND user_id = ?');
                $del->execute(array($getid,$sessionid));
              } else
                {
                  $ins = $bdd->prepare('INSERT INTO likes (work_id, user_id) VALUES (?, ?)');
                  $ins->execute(array($getid, $sessionid));


// NOTIFICATIONS

              // $trigger_lik = $bdd->prepare('SELECT pseudo FROM user WHERE user_id = ?');
              //  $trigger_lik->execute(array($_SESSION['id']));
              //  $trigger_lik = $trigger_lik->fetch();
              //  $trigger_lik = $trigger_lik['pseudo'];
              //
              //  $notif_lik= $bdd->prepare('INSERT INTO notif(trigger_id, target_id,pseudo,message) VALUES (?,?,?,"a liké votre texte " "'.$recuptxtname.'" )');
              //  $notif_lik->execute(array( $_SESSION['id'], $recupid, $trigger_lik));
              //
               // NOTIFICATIONS

                }
        //
        } elseif($gett == 2)
        {
          $check_like = $bdd->prepare('SELECT dislike_id FROM dislikes WHERE work_id = ? AND user_id = ?');
          $check_like->execute(array($getid,$sessionid));

          $del = $bdd->prepare('DELETE FROM likes WHERE work_id = ? AND user_id = ?');
          $del->execute(array($getid,$sessionid));

          if($check_like->rowCount() == 1)
            {
              $del = $bdd->prepare('DELETE FROM dislikes WHERE work_id = ? AND user_id = ?');
              $del->execute(array($getid,$sessionid));
            } else
                {
              $ins = $bdd->prepare('INSERT INTO dislikes (work_id, user_id) VALUES (?, ?)');
              $ins->execute(array($getid, $sessionid));
                }
        }



        header('Location: ../../text_content.php?id=' .$getid );
    } else {
      echo 'Erreur fatale';
    }
} else {
    exit('Erreur fatale');
}
?>
