<?php
session_start();
include 'includes/config.php';
if(isset($_SESSION['id'])){

$concours = $bdd-> query('SELECT * FROM contest ORDER BY publish_date DESC');

$titre='Ecritemple - Concours';

include 'includes/header.php';
?>
<div class="container  d-flex flex-column">
  <h1 class="text-center"><img src="images/icons/medal-solid.svg" width="50px" class="pb-3"><br>Concours</h1>
  <div class="list-group mt-5">

<h3> <p>Pour participer à un concours, rédigez votre texte et inscrivez le nom du concours dans le nom de votre oeuvre. </p> </h3><br>
<h3> <p> Le texte avec le plus de likes remporte le concours !  </p> </h3>


    <?php while($c = $concours->fetch()) { ?>
    <a href="contest_desc.php?id=<?= $c['contest_id'] ?>" class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1"><?= $c['title'] ?></h5>
      </div>
      <p class="mb-1 text-truncate"><?= $c['description'] ?>
      </p>
      <small class="text-muted">Début du concours: <?= date("m.d.Y",strtotime($c['publish_date'])); ?> <br> Fin du concours : <?= date("m.d.Y",strtotime($c['finish_date'])); ?></small>
    </a>
    <?php } ?>
  </div>
</div>





<?php
include('includes/footer.php');
}else {
  header('location: index.php');
}
 ?>
