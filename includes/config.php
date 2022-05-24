<?php

//connexion a la bdd
			try{
				$bdd=new PDO('mysql:host=localhost;dbname=ecritemple_test;port=3308', 'root', '');
			}
		catch(Exception $e){
				die('Erreur de  connexion:'.$e->getMessage());
		}

    // SI ERREUR DE BDD
    // try{
    //   $bdd = new PDO('mysql:host=localhost;dbname=ecritemple_test;port=3308', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    //  }
    // catch( PDOException $e ) {
    //     echo "Erreur Connexion :", $e->getMessage();
    //  }
    //   echo "<h2>OK</h2>";
	?>
