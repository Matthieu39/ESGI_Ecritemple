<?php
session_start();

include('includes/config.php');
if(isset($_SESSION['id'])){
include('process/process_text/process_text_create.php');
include('includes/header.php');
?>


    <h1 class="text-center"><img src="images/icons/feather-alt-solid.svg" width="50px" class="pb-3"><br>Ecris ton texte</h1>
    <div class="container  d-flex flex-column mt-5">
      <?php if(isset($err)){echo $err; } ?>
      <form method="post" class="mx-auto form-signin">

        <div class="contianer mx-auto form-group">
          <input type="text" class="form-control" placeholder="Titre" name="titre" maxlength="80">
        </div>
        <div class="form-group">
            <textarea class=" form-control" spellcheck="false" placeholder="Ecrivez ce qui vous passe par la tête !" name="texte" rows="12" cols="100"></textarea>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-lg btn-dark btn-block" value="Publier">
        </div>
      </form>



      </div>


<?php include('includes/footer.php');
}else {
  header('location: sign_in.php');
}
 ?>
