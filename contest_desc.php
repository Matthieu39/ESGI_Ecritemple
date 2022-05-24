<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['id'])){


include('process/process_contest/contest_content.php');

include('includes/header.php');
?>

  <div class="container  d-flex flex-column">
    <h1 class="text-center text-break"> <?=$concours_titre ?> </h1>

      <?= $concours_img ?>
      <div class="container rounded bg-dark my-5 p-3" height="300px">
        <h3 class="text-center ">Détails</h3>
          <p class="text-break"> <?= $description ?></p>
      </div>

    </div>





<?php
include('includes/footer.php');
}else {
  header('location: index.php');
}
 ?>
