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
            <link href="../Projet4b/css/ajoutDarticle.css" rel="stylesheet"/>
    <link href="../Projet4b/css/bootstrap.css" rel="stylesheet"/>
            <title>ajouter article</title>
        </head>
        <body>
            
    <header>
    <?php
        require_once "navbar.php"
    ?>
    </header>
            <div class="container-fluid">
                <span class="mt-4 d-flex justify-content-around"> 
                
                <h3 class="mt-4 text-danger">
                    welcome
                <?= $_SESSION['courriel'] ?>
                </h3>

                <form method="post">
                    <button id="btn-deconnexion" name="btn-deconnexion" class="btn btn-warning">deconnecter</button>
                </form>
                </span>

                <div class="container">
                    <form action="traitementAjoutDarticle.php" id="form-login" method="post" enctype="multipart/form-data">
                        <div class="text-center">
                            <img src="../Projet4b/img/logo.jpg" alt="logo surfbotte" title="surfbotte.fr">
                        </div>
                        <div class="mb-4">
                            <label for="nom_article" class="form-label">nom de l article</label>
                            <input type="text" class="form-control" id="nom_article" name="nom_article" required>
                        </div>
                        <div class="mt-4">
                            <label for="prix_article" class="form-label">description</label>
                            <textarea class="form-control" row="5" id="description_article" name="description_article" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="prix_article" class="form-label">prix du label</label>
                            <input type="number" step="0.01" class="form-control" id="prix_article" name="prix_article" required>
                        </div>
                        <div class="mb-4">
                            <label for="stock_article" class="form-label">disponibilité</label>
                            <select class="form-control" name="stock_article" id="stock_article" required>
                                <option value="0">oui</option>
                                <option value="1">non</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="date_article" class="form-label">date de depot d article</label>
                            <input type="date" class="form-control" name="date_article" id="date_article">
                        </div>

                        <div class="mb-4">
                            <label for="date_article" class="form-label">image de l article</label>
                            <input type="file" class="form-control" name="image_article" id="image_article" required>
                        </div>

                        <div class="d-flex justify-content-around">
                            <button type="submit" name="btn-connection" class="btn btn-primary">ajouter</button>
                            <a href="articles.php" class="btn btn-primary">annuler</a>
                        </div>
                    </form>
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
