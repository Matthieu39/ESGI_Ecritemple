<?php
session_start();

include('includes/config.php');
if(isset($_SESSION['id'])){
include('process/process_text/process_text_list.php');
include('includes/header.php');
?>

  <div class="container d-flex flex-column">
    <h1 class="text-center"><img src="images/icons/readme-brands.svg" width="50px" class="pb-3"><br>Textes</h1>
    <div class="list-group mt-5">
      <?php while($t = $textes->fetch()) {

         $writer = $bdd->prepare('SELECT pseudo FROM user WHERE user_id = ?');
         $writer->execute(array($t['user_fk']));
         $writer = $writer->fetch();
         $writer_pseudo = $writer['pseudo'];

         ?>


      <a href="text_content.php?id=<?= $t['work_id'] ?> " class="list-group-item  list-group-item-action">
      <h4 class="list-group-item-heading text-truncate"><?= $t['work_name'] ?> </h4>
      <p class="list-group-item-text text-truncate"><?= $t['texte'] ?>
      </p>
      <small class="text-muted">Ecrit par: <?= $writer_pseudo ?> <br>Le: <?= date("m.d.Y",strtotime($t['publish_date'])); ?></small>




      </a>
      <?php } ?>
    </div>

    <nav class="mx-auto mt-2">
        <ul class="pagination pagination-lg">
    <?php
      for ($i=1; $i <$pagetotal ; $i++) {

        echo
        '
        <li class="page-item ">
          <a class="page-link text-dark" href="text.php?page='.$i.'"> '. $i .'</a>
        </li>';
      }
     ?>
      </ul>
    </nav>
  </div>


<?php



include('includes/footer.php');
}else {
  header('location: sign_in.php');
}
 ?>
