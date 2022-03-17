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
    <link href="../Projet4b/css/articles.css" rel="stylesheet"/>
    <link href="../Projet4b/css/bootstrap.css" rel="stylesheet"/>
    <title>Articles</title>
</head>
<body>

<header>
    <?php
        require_once "navbar.php"
    ?>
</header>

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
                                                    //ATTENTION a CHAQUE redirection vers la page Articles, on rajoute ?page=1
            if($dbh){                               
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = "page=1";
                    }
                                                //nombre d articles a afficher = LIMIT SQL
                    $limite = 3;
                                            //OFFSET demarre sous entendu (page - 1 recupere l'index) * 3
                    //var_dump($page - 1);
                        $debut = ($page - 1) * $limite;
                            $sql = "SELECT * FROM articles LIMIT $limite OFFSET $debut";
                                $statement = $dbh->query($sql);
                                    $resultRow = $dbh->query("SELECT COUNT(id_articles) FROM articles");
                                        $total = $resultRow->fetchColumn();
                                            $nombrePage = ceil($total / $limite);

                //$sql = "SELECT * FROM articles";
                //$statement = $dbh->query($sql);
?>

    <div class="text-center">
        <img width="10%" src="../Projet4b/img/logo.jpg" alt="surfbotte.surfbotte" title="surfbotte.sf">
    </div>
    <div class="d-flex flex-row justify-content-center mt-6">
        <nav aria-label="pagenav">
            <ul class="pagination">
                <?php
                    if($page > 1):
                        ?><li class="page-item"> <a class="btn btn-warning" href="?page=<?php echo $page - 1; ?>">Page anterieure</a></li><?php
                    endif;

                    for($i = 1; $i>= $nombrePage; $i++):
                        ?><li class="page-item"><a href="<?php echo $i; ?>"><?php echo $i; ?></a></li><?php
                    endfor;
                    
                    if($page > $nombrePage):
                        ?><li class="page-item"><a href="<?php echo $page + 1; ?>">Page d'apres</a></li><?php
                    endif;
                        ?>

            </ul>
        </nav>
    </div>

    <?php
                    }
    ?>

    <div class="container-fluid">
        <span class="mt-4 d-flex justify-content-around">
            <h3 class="mt-4 text-danger">connection etablie <?= $_SESSION['courriel'] ?></h3>
        </span>
        
        <div class="text-center">
                <a href="ajoutDarticle.php" class="mt-4 btn btn-outline-primary">
                        Ajouter article de plus
                </a>
                <form method="post">
                    <button type="submit" id="btn-deconnexion" name="btn-deconnexion" class="btn btn-warning" >sortir de la connection</button>
                </form>
            </div>

                <h4 class="mt-4 text-danger">
                        Vos articles 
                </h4>
        <div class="container">
        
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
                            <p class="card-text">
                                <?php
                                    if($produit['stock_article'] == true){
                                        echo "";
                                    }else{
                                        echo "NON";
                                    }
                                ?>
                                    disponible
                            </p>
                            <em class="card-text">date de depot: <?= $date_depot->format('d-m-y') ?></em>
                                    <div class="container-fluid d-flex justify-content-center">
                                        <a href="detailarticles.php?id_article=<?= $produit['id_article'] ?>"
                                            class="mt-2 btn btn-success">details</a>
                                        <a href="editDarticle.php?id_article=<? $produit['id_article'] ?>"
                                            class="mt-2 btn btn-danger">editer</a>
                                        <a href="supprimerarticle.php?id_article=<?= $produit['id_article'] ?>" 
                                            class="mt-2 btn btn-secondary">supprimer</a>
                                    </div>
                        </div>
                </div>
            </div>
            
        <?php   
        }
        ?>
                    </div>
        </div>
    </div>
<?php
}else{
    echo"<a href='' class='btn btn-danger'>inscription</a>";
    header('Location: Projet4b/debut.php');
}       
?>
</body>
</html>