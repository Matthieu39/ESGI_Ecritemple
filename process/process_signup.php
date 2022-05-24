<?php
if (isset($_POST['forminscription']))
{



  if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
  {
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $mail = htmlspecialchars(strtolower(trim($_POST['mail'])));
    $mail2 = htmlspecialchars(strtolower(trim($_POST['mail2'])));
    $mdp = htmlspecialchars(trim($_POST['mdp']));
    $mdp2 = htmlspecialchars(trim($_POST['mdp2']));

    $pseudolength = strlen($pseudo);
    if (preg_match('/^[a-zA-Z0-9_]+$/',$_POST['pseudo']) && $pseudolength > 7 && $pseudolength < 20) {

      $reqpseudo = $bdd->prepare("SELECT * FROM user WHERE pseudo = ?");
      $reqpseudo->execute(array($pseudo));
      $pseudoexist = $reqpseudo->rowCount();
      if($pseudoexist == 0){
        if ($mail == $mail2) {
          if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $reqmail = $bdd->prepare("SELECT * FROM user WHERE email = ?");
            $reqmail->execute(array($mail));
            $mailexist = $reqmail->rowCount();
            if($mailexist == 0){
                $mdplength = strlen($mdp);
              if (  $mdplength > 7 && $mdplength < 20 ) { // verifie la présence de caractère /*preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $_POST['mdp'] )*/
                if ($mdp == $mdp2) {
                  $mdp= sha1($mdp);
                   $longueurkey = 15;
                   $key ="";

                  for ($i=1; $i <$longueurkey ; $i++) {
                    $key.= mt_rand(0,9);
                  }
                  $date_sign_up = date('Y-m-d H:i:s');

                  $insertmbr =$bdd->prepare("INSERT INTO user(pseudo, email, password, confirmekey, date_sign_up ) VALUES (?, ?, ?, ?, ?)");
                  $insertmbr->execute(array($pseudo, $mail, $mdp, $key, $date_sign_up));

                  $header="MIME-Version: 1.0\r\n";
                  $header.='From:"Ecritemple.com"<support@ecritemple.com>'."\n";
                  $header.='Content-Type:text/html; charset="utf-8"'."\n";
                  $header.='Content-Transfer-Encoding: 8bit';

                  $messagemail='
                  <html>
                  	<body>
                  		<div align="center">
                      <h2>Bienvenue sur Ecritemple</h2>
                  			<br />
                  			<p>Pour activer votre compte, veuillez cliquer sur le lien ci-dessous.</p>
                  			<br />
                        <a href="http://localhost/ECRITEMPLE/confirmation.php?pseudo='.urlencode($pseudo).'&key='.$key.'">Confirmez votre compte !</a>
                  		</div>
                  	</body>
                  </html>
                  '; //<a href="http://51.178.80.4/PROJETFINAL/confirmation.php?pseudo='.urlencode($pseudo).'&key='.$key.'">Confirmez votre compte !</a>

                  mail($mail, "Confirmation de compte", $messagemail, $header);
                  $msg = 0;
                  $message = '<div class="alert alert-success mx-auto text-center" role="alert"> Votre compte a bien été créé ! Un mail de confirmation vous a été envoyé <a href="http://localhost/ECRITEMPLE/confirmation.php?pseudo='.urlencode($pseudo).'&key='.$key.'">Confirmez votre compte !</a></div>';// changer avec un header qui va rediriger l'utilisateur sur une autre page

                }else {
                  $message = '<div class="alert alert-danger mx-auto text-center" role="alert"> Vos mots de passe ne correspondent pas !</div>';
                }
                              }
              else {
                $message = '<div class="alert alert-danger mx-auto text-center" role="alert"> Votre pseudo doit contenir entre 8 - 20 caractères alphanumérique ! </div>'; //Votre mot de passe doit contenir au moins un caractère spécial, une majuscule et une minuscule et contenir 8 caractères min et 20 max !
              }
            }
            else {
              $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Adresse mail déjà utilisée !</div>';
            }
          }
        }
        else {
          $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Vos adresse mail ne correspondent pas !</div>';
        }
      }
      else {
        $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Pseudo déjà utilisé !</div>';
      }
    }

    else {
      $message =  '<div class="alert alert-danger mx-auto text-center" role="alert"> Votre pseudo doit contenir entre 8 - 20 caractères alphanumérique !</div>';
    }
  }
  else {
    $message ='<div class="alert alert-danger mx-auto text-center" role="alert"> Tous les champs doivent être complétés !</div>';
  }
}
?>
