<?php
session_start();
 include('includes/config.php');


if(isset($_SESSION['id'])){
 include('process/process_text/process_text_content.php');

include('includes/header.php');


?>

    <h1 class="text-center text-break"> <?=$title ?></h1>
    <p class="small text-center text-light bg-secondary"> écrit par <a class="small text-center text-light bg-secondary" href="<?= $writer_profil ?>"><?= $writer_peudo ?></a> </p>
    <div class="container-fluid rounded bg-dark d-flex flex-column mt-5">
    <div class="container">
      <p class=" mt-3 text-center">Plubié le <?= date("m.d.Y",strtotime($textes['publish_date'])); ?></p>
        <p class=" tesxtsize mt-3 mb-5 text-wrap text-break"> <?=$contenu ?></p>
        <a class="like float-right " href="process/like/action.php?t=1&id=<?= $get_id ?>"></a> <p class="text-right px-5 "> <?= $likes ?></p>

        <a class="dislike float-right " href="process/like/action.php?t=2&id=<?= $get_id ?>"></a> <p class="text-right px-5"> <?= $dislikes ?></p>
    </div>

    </div>
    <!--Commentaire-->
    <div class="container  d-flex flex-column mt-5">

      <form action="process/process_comment.php?id=<?php echo $get_id ; ?>" method="POST" class="mx-auto form-signin">
        <h2 class="text-center">Commentaires</h2>
        <div class="form-group">
            <textarea class=" form-control" spellcheck="false" name="commentaire" placeholder="Ajouter un commentaire" rows="7" cols="100"></textarea>
        </div>
        <div class="form-group">
          <input class="btn btn-lg btn-dark btn-block" type="submit" name="submit_com" value="Poster">
        </div>
      </form>

    </div>


    <div class="container rounded text-dark bg-light my-3 p-3">
      <h5 class="text-center"><?php if ($commentnbr == 0){ ?>Aucun commentaire ! <?php }?></h5>
        <?php while($c = $comments->fetch()) {
          $req_info_com = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
           $req_info_com->execute(array($c['post_id']));
           $req_info_com = $req_info_com->fetch();
           $pseudo_sender = $req_info_com['pseudo'];
          ?>

            <h6> <b> <a href="profil.php?id=<?=$c['post_id']?>" class="text-dark"> <?= $pseudo_sender ?></a></b></h6>

            <p class="py-2 text-break"> <?= nl2br($c['comment_content']) ?> </p>
            <em class="small text-secondary float-right">Posté le <?= date("m.d.Y à H:i:s",strtotime($c['publish_date'])); ?></em> <br>
            <?php if ($req_info['admin'] > 0 || $c['post_id'] == $_SESSION['id'] ): ?> <!--SUPPRESSION DE COMMENTAIRE SEULEMENT SI PROPRIO OU ADMIN-->
              <a class="btn btn-outline-warning btn-sm" href="process/process_comment/comment_rem.php?removecom=<?= $c['comment_id']?>">Supprimer le commentaire</a>
            <?php endif; ?><!--FIN SUPPRESSION DE COMMENTAIRE-->

            <hr class="bg-dark" width="120px" align="center">

      <?php } ?>
    </div>





<?php
include('includes/footer.php');
}else {
  header('location: sign_in.php');
}
 ?>
