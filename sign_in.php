<?php

include('includes/config.php');
include('process/process_signin.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="CSS/plug/bootstrap.css">
    <link rel="stylesheet"  type="text/css" href="CSS/style.css">
    <title>Connexion</title>
<style media="screen">
      html,
      body {
      height: 100%;
      }

      body {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-align: center;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
      }

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
      .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
      color: #FFF;
      }
      .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      color: #FFF;
      }
</style>
  </head>

  <body class="text-center header">
    <div class="container">
      <main>

    <?php
    if (isset($message)) {
      echo $message; // rajouter a l'aide du bootstrap une erreur stylés

    }
    ?>
    <form class="form-signin" method="post">

      <a class="navbar-brand" href="index.php">
        <img class="mb-4 mt-4" src="images/Logo.png" alt="Ecritemple" hr width="100">
      </a>

      <h1 class="h3 mb-3 font-weight-normal">Connectez-vous</h1>
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="text" name="mailconnect"id="inputEmail" class="form-control inputform" placeholder="Email ou Pseudo" required autofocus>
      <label for="inputPassword" class="sr-only">Mot de passe</label>
      <input type="password" id="inputPassword"  name="mdpconnect"class="form-control inputform" placeholder="Mot de passe" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me">
        </label>
      </div>

      <button class="btn btn-lg btn-dark btn-block" type="submit" name="formconnexion">Connectez-vous</button>
      <p class="loginhere mx-auto mt-4">
          Vous n'avez pas de compte? <a href="sign_up.php" class="loginhere-link link">Inscrivez-vous ici</a>
      </p>

<?php  include('includes/footer.php'); ?>
