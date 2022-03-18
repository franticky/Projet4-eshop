<?php
session_start();

    if(isset($SESSION["courriel"])){

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
                                                                /*    NE PAS OUBLIER: <form enctype="multipart/form-data>"      */
                    //Upload de fichier
                //Existance de la superglobale $_FILES
            //<input de type file + attribut name="">
    
    if(isset($_FILES['image_article'])){
/*repertoire de destiantion */        $repertoireDestination = "../Projet4b/img/";

                                                                /* Photo Uploader */            
/* basename - Retourne len nom de la composante finale d un chemin 
dans un tableau multi dimmension 1 = image, 2 = son nom */  $photo_article = $repertoireDestination . basename($_FILES['image_article']['name']);

    /* Recuperation de l image uploader */
/*on assigne l image uploader au repertoire de destination + la photo + son nom */ $_POST['image_article'] = $photo_article;

                                                                /*Les conditions de reussite*/
//move_uploaded_file - Déplace un fichier telechargé
//on assigne a la foto un nom temp random au cas d echec d upload
        if(move_uploaded_file($_FILES['imge_article']['tmp_name'], $photo_produit)){
            echo "<p 'container aleert alert-warning'>fichier valide & dl</p>";
        }else{
            echo "<p class='container alert alert-warning'>erreur du dl</p>";
        }
    }else{
        echo"<p class='container alert alert-warning'>fichier invalide sseuls formats: png, jpg, bmp, svg, webp</p>";
    }

                                                                /*connexion a la base de donnee surfbotte via PDO*/
//les variables de phpmyadmin
                    $user = "root";
                    $pass = "";
/*test d erreurs*/
    try{ 
/*PHP Data Objects est une extension definissantl interface pour acceder a une base de donnees avec PHP.
La classe sappele PDO & est orientee objet*/    $dbh = new PDO('mysql:host=localhost;dbname=surfbotte', $user, $pass); 
/*instance de la classe PDO*/   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//debug de PDO /*L operateur de resolution de portee ou double deux points fourni un moyen d acceder aux membres static ou constant ainsi qu aux proprietes ou methodes surchargees d une classe*/
        echo "<p class='container alert alert-warning text-center'>systemes PDO Mysql connecté </p>";
    }catch(PDOException $e){
        print "error" . $e->getMessage()."<br/>";
        die();
    }
            
        if($dbh){
                                /*Requete sql de selection des articles*/
                    $sql = "SELECT * FROM article WHERE id_article = ?";
                                /*Requete preparee = connecxion + methode prepare + requete sql */
//les requetes preparees luttent contre les injections de sql
/*PDO::prepare - prepare une requete a l'execution et retourne un objet*/
                    $update = $dbh->prepare($sql);
                                /*Executer la requete preparee*/
//PDO Statement::execute - Execute une requete preparee 
//elle execute la requete passee dans un tableau de valeur table
                    $update->execute(array(
                        $_POST['nom_article'],
                        $_POST['description_article'],
                        $_POST['prix_article'],
                        $_POST['stock_article'],
                        $_POST['date_article'],
                        $_POST['image_article'],
                        $_GET['id_article']
                    ));

                    if($update){
                        echo "<p class='container alert alert-secondary'>mis a jour complete</p>";
                        echo "<div class='text-center'><a href='articles.php?page=1' class='container btn btn-warning'></a></div>";
                    }else{
                        echo "<p class='alert alert-warning'>error d'ajout</p>";
                    }
        }
    }else{
        echo "<a href='' class='btn btn-danger'>inscription</a>";
    }
?>
</body>
</html>
