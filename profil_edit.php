<?php
session_start();


include('includes/config.php');
if(isset($_SESSION['id'])){

include('process/process_profil/process_profil_edit.php');
include('includes/header.php');







?>
<div class="container box-form  rounded p-3 mt-5 mx-auto">
  <div class="signup-content align-middle my-5  d-flex flex-column mx-auto">
        <?php
        if (isset($message) ) {
          echo $message ; // rajouter a l'aide du bootstrap une erreur stylés

        }
        ?>
        <h2 class="mx-auto mt-3 text-center"><img src="images/icons/Description.svg" class="pb-3" width="50px"><br>Edition profil</h2>
                      <form method="post" id="signup-form" action="profil_edit.php" class="signup-form mx-auto form-signin" enctype="multipart/form-data" >


                          <div class="form-group input-group my-4 container">
                            <span class="input-group-btn"><img src="images/icons/user-regular.svg" title="Pseudo" width="15px"></span>
                              <input type="text" readonly class=" form-input form-control mr-sm-2 inputform_readonly" title="Pseudo" value=" <?php echo $pseudo; ?> ">
                          </div>
                          <div class="form-group input-group my-4 container">
                            <span class="input-group-btn"><img src="images/icons/user-regular.svg" title="Changer votre pseudo" width="15px"></span>
                              <input type="text" class="form-input form-control mr-sm-2 inputform" name="newpseudo" id="name" title="Changer votre pseudo" placeholder="Changer mon pseudo"/>
                          </div>
                          <div class="form-group input-group my-4 container">
                            <span class="input-group-btn"><img src="images/icons/envelope-regular.svg" title="Email" width="15px"></span>
                              <input type="text" readonly class=" form-input form-control mr-sm-2 inputform_readonly" title="Email" value="<?php echo $mail; ?>">
                          </div>
                          <div class="form-group input-group my-4 container">
                            <span class="input-group-btn"><img src="images/icons/envelope-regular.svg" title="Changer votre email" width="15px"></span>
                              <input type="email" class="form-input form-control mr-sm-2 inputform" name="newmail" id="mail" title="Changer votre email" placeholder="Changer mon email" />
                          </div>
                          <!-- Description -->
                          <div class="form-group ">
                            <label for="exampleFormControlTextarea1">Description: <p class="small text-secondary"> <span id="caracteres">1000</span> caractères restants</p></label>
                            <textarea maxlength="1000" class="form-control inputarea"  id="AreaEcrit"  name="description" onkeydown="reste(this.value);" rows="6" spellcheck="false" placeholder=" <?php echo $description; ?> "></textarea>
                          </div>

                          <div class="form-group input-group my-4 ">
                            <label for="avatar"><img src="images/icons/user-circle-regular.svg" title="Avatar" width="20px"></label>
                            <input type="file" class="form-input form-control-file mr-sm-2 inputform"  title="Avatar" name="avatar" id="avatar" placeholder="Choisissez votre avatar :"/>
                          </div>
                          <div class="form-group input-group my-4 ">
                            <label for="Baniere"><img src="images/icons/image-regular.svg" title="Banière" width="20px"></label>
                            <input type="file" class="form-input form-control-file mr-sm-2 inputform" title="Banière" name="banner" id="banniere" placeholder="Choisissez votre banière :"/>
                          </div>
                          <div class="form-group container">
                              <input type="submit" name="editprofil" id="submit" class="form-submit btn btn-lg btn-dark btn-block" value="Modifier mon profil"/>
                          </div>
                      </form>
                      <p class="loginhere mx-auto">
                      <a href="<?php echo 'profil.php?id='.$_SESSION['id'];?>" class="loginhere-link link">Mon profil</a>
                      </p>

                  </div>


              </div>
<script src="JS/main.js" charset="utf-8"></script>
<?php  include('includes/footer.php');
}
else {
  header('location: sign_in.php');
}?>
