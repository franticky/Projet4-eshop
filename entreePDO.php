<?php
    $user = "root"; //les variables de phpmyadmin
    $pass = "";
try{ //test d erreurs
    $dbh = new PDO('mysql:host=localhost;dbname=surfbotte', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo"<p class='container alert alert-success text-center'>connecion a el pdo mysql</p>";
    return $dbh;   
}catch(PDOException $e){
    print "error!: ".$e->getMessage() ."<br/>";
    die();
}
?>
<!-- PHP Data Object est une extension definissant l interface pour acceder a une base de donnees avec PHP.
elle est orientée objet, la classe s'appele PDO.
Instance de la classe PDO 
Debug de PDO
Operateur de resolution de portee ou double deux-points, 
fournit un moyen d acceder aux members static ou constant ainsi qu aux proprietes ou methodes suerchargees d une classe.
*/