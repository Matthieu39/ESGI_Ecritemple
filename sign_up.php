<?php
include('includes/config.php');

include('process/process_signup.php');
$titre='Inscription';
include('includes/header.php');
?>
<style media="screen">
      .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
      }
      .form-signin .checkbox {
      font-weight: 400;
      }
      .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
      }
      .form-signin .form-control:focus {
      z-index: 2;
      }
      .form-signin div input{
      color: #FFF;
      }
</style>
<div class="container box-form  rounded p-3 mt-5 mx-auto">
  <div class="signup-content align-middle my-5  d-flex flex-column mx-auto">
        <?php
        if (isset($message) ) {
          echo $message ; // rajouter a l'aide du bootstrap une erreur stylés

        }
        ?>
        <h2 class="mx-auto mt-3">S'inscrire</h2>
                      <form method="post" id="signup-form" class="signup-form mx-auto form-signin" >

                          <div class="form-group input-group my-4 container">
                            <span class="input-group-btn"><img src="images/icons/user-regular.svg" width="15px"></span>
                              <input type="text" class="form-input form-control mr-sm-2 inputform" name="pseudo" id="name" placeholder="Nom d'utilisateur"required/>
                          </div>
                          <div class="form-group input-group my-4 container">
                            <span class="input-group-btn"><img src="images/icons/envelope-regular.svg" width="15px"></span>
                              <input type="email" class="form-input form-control mr-sm-2 inputform" name="mail" id="email" placeholder="Email" required/>
                          </div>
                          <div class="form-group input-group my-4 container">
                            <span class="input-group-btn"><img src="images/icons/envelope-regular.svg" width="15px"></span>
                              <input type="email" class="form-input form-control mr-sm-2 inputform" name="mail2" id="email" placeholder="Confirmer l'email" required/>
                          </div>
                          <div class="form-group input-group my-4">
                            <span class="input-group-btn"><img src="images/icons/lock-solid.svg" width="15px"></span>
                              <input type="password" class="form-input form-control mr-sm-2 inputform" name="mdp" id="password" placeholder="Mot de passe" required/>
                          </div>
                          <div class="form-group input-group my-4 ">
                            <span class="input-group-btn"><img src="images/icons/lock-solid.svg" width="15px"></span>
                              <input type="password" class="form-input form-control mr-sm-2 inputform" name="mdp2" id="re_password" placeholder="Confirmer le mot de passe" required/>
                          </div>
                          <div class="form-group container">
                              <input type="submit" name="forminscription" id="submit" class="form-submit btn btn-lg btn-dark btn-block" value="S'inscrire"/>
                          </div>
                      </form>
                      <p class="loginhere mx-auto">
                          Vous avez déjà un compte ? <a href="sign_in.php" class="loginhere-link link">Connectez-vous ici</a>
                      </p>

                  </div>
</div>
<?php  include('includes/footer.php'); ?>
