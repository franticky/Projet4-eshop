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
    <link href="../Projet4b/css/supprimerarticle.css" rel="stylesheet"/>
    <link href="../Projet4b/css/bootstrap.css" rel="stylesheet"/>
    <title>Suppression d articles</title>
</head>
<body>
<header>
    <?php
        require_once "navbar.php"
    ?>
</header>
<div class="container-fluid">
   <?php
    $user = "root";
    $pass = "";
    $hote = "localhost";
    $nomBaseDonnees = "surfbotte";

        try{ /*Instance de la classe PDO. PHP Data Object est une EXTENSION qui définit l'interface pour accéder a une base de donnees avec PHP*/
            $dbh = new PDO('mysql:host=localhost;dbname=surfbotte', $user, $pass); 
            //La classe PDO est ORIENTEE OBJET.
/*l'OPERATEUR DE RESOLUTION DE PORTEE ou DOUBLE DEUX POINTS permet d acceder aux membres static ou constant & aux proprietes ou methodes surchargees d une classe.*/
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
                echo "<p class='container alert alert-primary text-center'>conneté a PDO Mysql</p>"; 
        }catch(PDOException $e){
            print "error" . $e->getMessage() . "<br/>";
            die();
        }

        if($dbh){
            $sql = "SELECT * FROM articles WHERE id_article = ?";
            $id_article = $_GET['id_article'];
            $request = $dbh->prepare($sql);
            $request->bindParam(1, $id_article);
            $request->execute();
            $details = $request->fetch(PDO::FETCH_ASSOC);
        }

     
        
        if(isset($_POST['btn-supprimer'])){
            $sql = "DELETE FROM articles WHERE id_article = ?"; /*requete sql de selection des articles, un autre critere est possible, pas juste l'id*/  
           //creer une requete preparee pour lutter contre les injections SQL
            $idProduit = $_GET['id_article'];
            var_dump($idProduit);
            $delete = $dbh->prepare($sql); 
           //recuperation de l'id de l'article
            $delete->bindParam(1, $idProduit);
            var_dump($delete);  //lier les parametres du bouton a la requete sql
            $delete->execute();

                if($delete){
                    echo "<p class='container alert alert-warning'>suppression effectuee</p>";
                    echo "<div class='container'> <a href='articles.php?page=1' class='mt-5 btn btn-warining'>retour</a></div>";
                    ?>
                        <style>
                            #form-delete{
                                display: none;
                            }
                            </style>
                    <?php
                }else{
                    echo "<p class='alert alert-warning'>erreur systeme suppression</p>";
                }
        }

   ?>
            <form method="post" id="form-delete">
                <p class="text-center text-warning">Supprimer article   </p>
                <p class="text-center text-warning"><?= $details['nom_article'] ?></p>
                <p class="text-center text-warning"><?= $details['description_article'] ?></p>
                <p class="text-center text-warning">
                    <img src="<?= $details['image_article'] ?>" class="img-thumbnail" alt="" title="" width="200" />
                </p>
                 <div class="d-flex justify-content-center">
                    <button type="submit" name="btn-supprimer" class="btn btn-warning">confirmer</button>
                    <a href="articles.php?page=1" class="btn btn-primary">annuler</a>
                 </div>   
            </form>

     

<?php
function deconnexion(){
    var_dump("gütten");
        echo "morgen";
            session_unset();
            session_destroy();
                header('Location: debut.php');
}

    if(isset($_POST['btn-deconnexion'])){
        deconnexion();
    }
}else{
    echo "<a href='' class='btn btn-secondary'>inscription</a>";
}