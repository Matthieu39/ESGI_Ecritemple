<?php
include('includes/config.php');
include('process/process_confirmation.php');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="CSS/plug/bootstrap.css">
    <link rel="stylesheet"  type="text/css" href="CSS/style.css">
    <title>Ecritemple</title>
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

</style>
  </head>

  <body class="text-center header">
    <div class="container">
    <main >

    <img class="mb-4" src="images/Logo.png" alt="Ecritemple" width="100">
    <?php        if (isset($msg_conf) ) {
              echo $msg_conf ; // rajouter a l'aide du bootstrap une erreur stylés

            }
            ?>

<?php  include('includes/footer.php'); ?>
