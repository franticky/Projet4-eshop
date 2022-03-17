<?php
session_start();
    if(isset($_SESSION["courriel"])){
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
                                    /* NE PAS OUBLIER: <form enctype="multipart/form-data"> */
//upload de fichier
//existance de la superglobale $_FILES
//<input de type file + attribut name="">

        if(isset($_FILES['image_article'])){                        //Repertoire de destination
                $repertoiredestination = "../Projet4b/img/";
                                                                    //Photo uploader
//basename - retourne le nom de la composante finale d un chemin dans un tableau multi dimension 1= image, 2= son nom de la composante
                    $photo_article = $repertoiredestination . basename($_FILES['image_article']['name']);
                                    //Recuperation de l image uploader
//on assigne l image uploader au repertoire de destination + la photo + son nom
                        $_POST['image_article'] = $photo_article;
                                    //Les conditions de reussite
//move_uploaded_file Deplace un fichier telechargé. On assigne a la foto un nom temp random en cas d echec d upload
                            if(move_uploaded_file($_FILES['image_article']['tmp_name'], $photo_article)){
                                echo "<p class='container alert alert-warning'>fichier valide & dl</p>";
                            }else{
                                    echo "<p class='container alert alert-danger'>error dl</p>";	
                            }
        }else{
                echo "<p class='container alert alert-secondary'>invalid file, must be png jp bmp svg or webp</p>";
        }
                                    //Conexion a la base de donnees surfbotte via PDO
//Les variables de phpmyadmin 
    $user = "root";
    $pass = "";
//test d error
        try{
                                    //PHP Data Objects est une EXTENSION qui definit l'interface pour acceder a une base de donnee avec PHP.
//La classe s appele PDO, & est orientee objet dans la base de donnees.
        $dbh = new PDO('mysql:host=localhost;dbname=surfbotte', $user, $pass);
                                    //Debug de PDO 
//L'operateur de resolution de portee ou double deux points, fourni un moyen d acceder aux membres static ou constant & aux proprietes ou methodes surchargees d une classe
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "<p class='container alert alert-primary text-center'>connection a PDO Mysql</p>";
        }catch(PDOException $e){
                print "error " .$e->getMessage() ."</br>";
                    die();
        }

    if($dbh){
                                    //Requete sql de selection des produit
        $sql = "INSERT INTO `articles`(`id_article`, `nom_article`, `description_article`, `prix_article`, `stock_article`, `date_article`, `image_article`) VALUES (?,?,?,?,?,?,?)";
                                    //Requete preparee = connexion + methode preparee + requete sql 
//Les requetes preparee lutte contre les injections sql. PDO::prepare - Prepare une requete a l'execution et retourne un objet
    $insert = $dbh->prepare($sql);
                                    //Lier les parametres du formulaire a la table phpmyadmin.
//PDOStatement::bindParam - lie un parametre a un nom de variable specifique
    $insert->bindParam(1, $_POST['id_article']);
    $insert->bindParam(2, $_POST['nom_article']);
    $insert->bindParam(3, $_POST['description_article']);
    $insert->bindParam(4, $_POST['prix_article']);
    $insert->bindParam(5, $_POST['stock_article']);
    $insert->bindParam(6, $_POST['date_article']);
    $insert->bindParam(7, $_POST['image_article']);
                                    //Executer la requete preparee
//PDOStatement::execute - execute une requete preparee. Elle execute la requete passee dans un tableau de valeurs
        $insert->execute(array(
            $_POST['id_article'],
            $_POST['nom_article'],
            $_POST['description_article'],
            $_POST['prix_article'],
            $_POST['stock_article'],
            $_POST['date_article'],
            $_POST['image_article'],
        ));
                if($insert){
                    echo "<p class='container alert alert-warning'>article ajouté</p>";
                    echo "<a href='articles.php' class='container btn btn-success'>voir article</a>";
                }
}
}else{
                    echo "<p class='alert alert-warning'>error ajout</p>";
                }

?>