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
    <title>Detail des articles</title>
</head>
<body>
<div class="container-fluid">
    
    <span class="mt-5 d-flex justify-content-around">
        <h3 class="mt-4 text-secondary">start><?= $_SESSION['courriel']?></h3>
        
        <form method="post">
            <button id="btn-deconnexion" name="btn-deconnexion" class="btn btn-warning"></button>
        </form>
    </span>
    
    <?php
    $user = "root";
    $pass = "";
        
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=surfbotte', $user, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "<p class='container alert alert-primary text-center'> Demarrage PDO MySQL </p>";
        
            }catch (PDOException $e){
                print "An error occurred" .$e->getMessage() ."<br/>";
                die();
            }

                if($dbh){
                    $sql = "SELECT* FROM articles WHERE id_article = ?";
                    $id_article = $_GET['id_article'];
                    $request = $dbh->prepare($sql);
                    $request->bindParam(1, $id_article);
                    $request->execute();
                    $details = $request->fetch(PDO::FETCH_ASSOC);
                }
    ?>

    <div class="container">
        <h4 class="text-secondary">details d'articles<b class="text-info"><?= $details['nom_article']?></b></h4>
        <div class="row">
            <div class="col-sm-12 col-md-12 mt-2">
                <div class="card">
                   
                    <div class="text-center">
                        <h4 class="card-title text-info"><?= $details['nom_articles']?></h4>
                        <img src="<?= $details['image_article']?>" class="card-img-top img-fluid img-details" alt="<?= $details['nom_article']?>" title="<?= $details['nom_article'] ?>">
                    </div>
                    
                    <div class="card-body">
                        <p class="card-text"><?= $details['description_article'] ?></p>
                        <p class="card-text text-secondary fw-bold">prix: <?= $details['prix_articles'] ?>€</p>
                        <p class="card-text">disponibilite:
                    
                    <?php
                        $date_article = new DateTime($details['date_article']);
                            var_dump($produit['stock_article']);
                        
                                if($details['stock_article'] == true){
                                    echo "OUI";
                                }else{
                                    echo "NON";
                                }
                    ?>
                        </p>

                        <em class="card-text">date de depot: <?= $date_article->format('d-m-y')?></em>

                        <div class="container-fluid d-flex justify-content-center">
                                <a href="articles.php" class="mt-2 btn btn-primary">retour</a>
                                <a href="#" class="mt-3btn btn-success">panier</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>

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