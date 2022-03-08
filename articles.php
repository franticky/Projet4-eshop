<?php
session_start();
    if(isset($_SESSION["courriel"])){
        }else{
            session_unset();
            session_destroy();
            header("Location: debut.php");
        };
        
        
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
    <div class="container-fluid">
        <span class="mt-4 d-flex justify-content-around">
            <h3 class="mt-4 text-danger">ca yest <?= $_SESSION['courriel'] ?></h3>
                <form method="post">
                    <button type="submit" id="btn-arreter" name="btn-arreter" class="btn btn-warning" >arreter</button>
                </form>
        </span>
        <?php
        $user = "root";
        $pass = "";
            try{
                $dbh = new PDO('mysql:host=localhost;dbname=ecommerce', $user, $pass);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "<p class='container alert alert-success text-center'>PDO MySQL connexion acheived</p>";
            }catch(PDOException $e){
                    print "Error !:".$e->getMEssage() ."<br/>";
                die();
            };

            if($dbh){
                $sql = "SELECT * FROM produits";
                $statement = $dbh->query($sql);
            }
        ?>
        <div class="container">
            <div class="text-center">
                <a href="ajouter_produit.php" class="mt-4 btn btn-outline-primary">Un article de plus</a>
            </div>
                <h4 class="mt-4 text-danger">
                    vos articles 
                </h4>
            <div class="row">
        <?php
                    foreach($statemement as $produit){
                        $date_depot = new DateTime($produit['date_depot']);
        ?>            
            <div class="col-sm-12 col-lg-4 mt-5">
                <div class="card">
                    <div class="text-center">
                        <h4 class="card-title text-info">
                            <?= $produit['nom_produit'] ?>
                        </h4>
                            <img src="<?= $produit['image_produit'] ?>" alt="<?= $produit['nom_produit'] ?>">
                    </div>

                </div>

            </div>
                    }
                
            </div>
        </div>
    </div>
    <?php
        function arreter(){
            var_dump("bonjour");
            echo "bonjour!";
            session_unset();
            session_destroy();
            header('Location: ../debut.php');
        }
        if(isset($_POST['btn-arreter'])){
            arreter();
        }else{
                echo"<a href='' class='btn btn-danger'>inscription</a>";
                header('Location: ../debut.php');
        }
        
    ?>

</body>
</html>