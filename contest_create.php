<?php
session_start();
include('includes/config.php');
$requser = $bdd->prepare('SELECT * FROM user WHERE user_id = ?');
$requser->execute(array($_SESSION['id']));
$userinfos = $requser->fetch();
if (isset($_SESSION['id']) AND $userinfos['user_id'] == $_SESSION['id'] AND $userinfos['admin'] >0) {
include('process/process_contest/contest_create.php');

include('includes/header.php');

?>
  <div class="container box-form  rounded p-3 mt-5 mx-auto">
    <div class="signup-content align-middle my-5  d-flex flex-column mx-auto">
          <?php
          if (isset($err) ) {
            echo $err ;

          }
          ?>
          <h2 class="mx-auto mt-3 text-center"><img src="images/icons/cup.svg" class="pb-3" width="50px"><br>Création de concours</h2>
                        <form method="post" id="signup-form" class="signup-form mx-auto form-signin" enctype="multipart/form-data" >


                            <div class="form-group input-group my-4 container">

                              <input type="text"  class="text-center form-input form-control mr-sm-2 inputform" title="Titre du concours" placeholder="Titre du concours" name="concours_titre">

                            </div>
                            <div class="form-group input-group my-4 container-fluid d-flex ">

                              <input type="date" class="text-center form-input form-control mr-sm-2 inputform d-block" title="Fin du concours" name="datefin" placeholder="Date de fin">
                            </div>
                            <!-- Description -->
                            <div class="form-group ">
                              <textarea class=" form-control inputarea"  placeholder="Description du concours" name="concours_desc"  rows="6" spellcheck="false" ></textarea>
                            </div>
                            <div class="form-group input-group my-4 ">
                              <label for="concours_img">Image (facultatif)</label>
                              <input type="file" class="form-input form-control-file mr-sm-2 inputform" title="Image" name="concours_img" id="concours_img" placeholder="Choisissez votre image :"/>
                            </div>

                            <div class="form-group container">
                                <input type="submit"  id="submit" class="form-submit btn btn-lg btn-dark btn-block" value="Créer"/>
                            </div>
                        </form>


                    </div>


                </div>


    <?php
    include('includes/footer.php');
    }
    else {
      header('location: index.php');
    }
    ?>
