<?php
session_start();
 include('../includes/config.php');


 if(isset($_POST['submit_com'])){
   if(isset($_POST['commentaire']) && !empty($_POST['commentaire'])){
        $commentaire= htmlspecialchars($_POST['commentaire']);
        $user_id= $_SESSION['id'];
        $get_id= htmlspecialchars($_GET['id']);

// echo $commentaire;
// echo $user_id;
// echo $get_id;



        $ins = $bdd->prepare('INSERT INTO comment (comment_content, work_id, post_id, publish_date) VALUES (?, ?, ?, NOW())');
        $ins->execute(array($commentaire,$get_id, $user_id));

        // NOTIFICATIONS

        $checkid = $bdd->prepare('SELECT * FROM work WHERE work_id = ?');
        $checkid->execute(array($get_id));


        $recupforcom=$checkid->fetch();
        $recupidforcom=$recupforcom['user_fk'];
        $recuptxtnameforcom=$recupforcom['work_name'];


                $trigger_com = $bdd->prepare('SELECT pseudo FROM user WHERE user_id = ?');
                $trigger_com->execute(array($_SESSION['id']));
                $trigger_com = $trigger_com->fetch();
                $trigger_com = $trigger_com['pseudo'];

                $notif_com= $bdd->prepare('INSERT INTO notif(trigger_id, target_id,pseudo,message, datenotif) VALUES (?,?,?,"a commenté " "'.$recuptxtnameforcom.'", NOW())');
                $notif_com->execute(array( $_SESSION['id'], $recupidforcom, $trigger_com));


                               // NOTIFICATIONS

         header('Location: ../text_content.php?id=' .$get_id );
       }else{
         header('Location: ../text_content.php?id=' .$get_id );

}

}else{
    header('Location: ../text_content.php?id=' .$get_id );
  }
 ?>
