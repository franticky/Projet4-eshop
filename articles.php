<?php
session_start();

    if(isset($_SESSION["courriel"])){
        function arreter(){
    
            echo "bonjour!";
            session_unset();
            session_destroy();
            header('Location: debut.php');
        }
        
        
                if(isset($_POST['btn-deconnexion'])){
                    arreter();
                }
                
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>


<?php
            $user = "root";
            $pass = "";
            try{
                $dbh = new PDO('mysql:host=localhost;dbname=surfbotte;charset=UTF8', $user, $pass);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "<p class='container alert alert-success text-center'>PDO MySQL connexion acheived</p>";
            }catch(PDOException $e){
                    print "Error !:".$e->getMEssage() ."<br/>";
                die();
            };
            if($dbh){
                $sql = "SELECT * FROM articles";
                $statement = $dbh->query($sql);
            }
        ?>

    <div class="container-fluid">
        <span class="mt-4 d-flex justify-content-around">
            <h3 class="mt-4 text-danger">ca yest <?= $_SESSION['courriel'] ?></h3>
                <form method="post">
                    <button type="submit" id="btn-deconnexion" name="btn-deconnexion" class="btn btn-warning" >arreter</button>
                </form>
        </span>
        
      
        <div class="container">
            <div class="text-center">
                <a href="ajouter_article.php" class="mt-4 btn btn-outline-primary">Un article de plus</a>
            </div>
                <h4 class="mt-4 text-danger">
                    vos articles 
                </h4>
            <div class="row">
        <?php
                    foreach($statement as $produit){
                        $date_depot = new DateTime($produit['date_article']);
        ?>            
            <div class="col-sm-12 col-lg-4 mt-5">

                <div class="card">
                    <div class="text-center">
                        <h4 class="card-title text-info">
                            <?= $produit['nom_article'] ?>
                        </h4>
                            <img src="<?= $produit['image_article'] ?>" 
                                    alt="<?= $produit['nom_article'] ?>"
                                        class="card-img-top img-fluid"
                                            title="<?= $produit['nom_article']?>">
                    </div>
                        <div class="card-body">
                            <p class="card-text"><?= $produit['description_article'] ?></p>
                            <p class="card-text text-success fw-bold">euros: <?= $produit['prix_article'] ?> € </p>
                            <p class="card-text">disponibilité:</p>
                                <?php
                                    if($produit['stock_article'] == true){
                                        echo "OUI";
                                    }else{
                                        echo "NON";
                                    }
                                ?>
                            </p>
                            <em class="card-text">date de depot: <?= $date_depot->format('d-m-y') ?></em>
                                    <div class="container-fluid d-flex justify-content-center">
                                        <a href="detailarticles.php?id_article=<?= $produit['id_article'] ?>"
                                            class="mt-2 btn btn-success">details</a>
                                        <a href="editer_article.php?id_article=<? $produit['id_article'] ?>"
                                            class="mt-2 btn btn-danger">editer</a>
                                        <a href="supprimer_article.php?id_article=<?= $produit['id_article'] ?>" 
                                            class_parents="mt-2 btn btn-secondary">supprimer</a>
                                    </div>
                        </div>
                    </div>
                </div>
            
                    }
                    </div>
        </div>
    </div>
    


<?php

}
}else{
    echo"<a href='' class='btn btn-danger'>inscription</a>";
    header('Location: Projet4b/debut.php');
}
        
    ?>
</body>
</html>