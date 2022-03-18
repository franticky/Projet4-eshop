<?php
session_start();
    if(isset($_SESSION["courriel"])){
        $user = "root";
        $pass = "";

            try{ // test d erreur
                $dbh = new PDO('mysql:host=localhost;dbname=surfbotte', $user, $pass); /*Instance de la classe PDO: php data objects, extension qui definit l interface
                pour acceder a une base de donnees avec php. la classe sappele PDO & est orientee objet*/
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                    echo "<p class='container alert alert-warning text-center'>PDO MySQL</p>";
            }catch(PDOException $e){
                print"error" .$e->getMessage() ."<br/>";
                die();
            }

                if($dbh){
                    $sql = "SELECT * FROM articles WHERE id_article = ?"; //requete sql de selection des produits

                    $id_article = $_GET['id_article']; //grace a PDO on accede a la methode query
                    $request = $dbh->prepare($sql); //requete preparee
                    $request->bindParam(1, $id_article); //lier les parametres
                    $request->execute(); //execution de la requete
                    $details = $request->fetch(PDO::FETCH_ASSOC); //retour d un objet de resultats
                }
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="../Projet4b/css/editDarticle.css" rel="stylesheet"/>
                <title>Document</title>
            </head>
            <body>
            <header> 
                <?php
                    require_once "navbar.php"
                ?>
            </header>
                <div class="container-fluid">
                    <span class="mt-6 d-flex justify-content-around">
                        <h3 class="mt-4 text-danger" >
                                    welcome 
                            <?= $_SESSION['courriel'] ?>
                        </h3>
                            <form method="post">
                                <button id="btn-deconnexion" name="btn-deconnexion" class="btn btn-warning">
                                    Deconnexion
                                </button>
                            </form>
                    </span>
                <div class="container">
                    <form action="traitementEditionDarticle.php?id_article=<?= $details['id_article'] ?>" id="form-update" method="post" enctype="multipart/form-data" role="form">
                        <h3 class="text-info">
                            Editer l'article
                        </h3>
                            <div class="text-center img-logo">
                                <img src="../Projet4b/img/logo.jpg" alt="logo surfbotte" title="surfbotte.fr">
                            </div>
                        <div class="forms1">
                            <div class="mb-4">
                                <label for="nom_article" class="form-label">Nom de l'article</label>
                                <input type="text" class="form-control" name="nom_article" placeholder="<?= $details['nom_article'] ?>" required>
                            </div>
                            <div class="mb-4">
                                <label for="nom_article" class="form-label">Description</label>
                                    <textarea class="form-control" name="description_article" id="description_article" rows="5"  placeholder="<?= $details['description_article']?>" required>
                                    </textarea>
                            </div>
                            <div class="mb-4">
                                <label for="prix_article" class="form-label">Prix de l'article</label>
                                <input type="number" step="0.01" class="form-control" id="prix_article" name="prix_article" placeholder="<?= $details['prix_article'] ?>" required>
                            </div>
                            </div>

                            <div class="forms2">
                            <div class="mb-4">
                                <label for="stock_article" class="form-label">Disponibilité</label>
                                <select class="form-control" id="stock_article" name="stock_article" required>
                                    <option value="0">oui</option>
                                    <option value="1">non</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="date_article" class="form-label">Date de depot de l'article</label>
                                <input type="date" class="form-control" id="date_article" name="date_article" required>
                            </div>
                            <div class="mb-4">
                                <label for="image_article" class="form-label">Image de l article</label>
                                <input type="file" class="form-control" id="image_article" name="image_article" required placeholder="<?= $details['image_article'] ?>">
                            </div>

                            <div class="d-flex justify-content-around">
                                <button type="submit" name="btn-connexion" class="btn btn-primary">Mettre a jour</button>
                                <a href="articles.php?page=1" class="btn btn-primary"></a>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </body>
            </html>
            <?php
            function deconnexion() {
                var_dump("yes");
                echo"moar yeas";
                session_unset();
                session_destroy();
                header('Location: debut.php');
            }
                if(isset($_POST['btn-deconnexion'])){
                    deconnexion();
                }
            
    }else{
        echo "<a href='' class='btn btn-danger'>inscription</a>";
    }