<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SurfBotte</title>
</head>
<body>
    <div class="container-fluid">
        <form id="loginDuFormulaire" method="post">
            <div class="text-center">
                <img src="img/logo.jpg" alt="logo surfbotte" id="surfbotte.sf" required>

            </div>
            <div class="mb-5">
                <label for="email" class="form-label">Courriel</label>
                <input type="email" class="form-control" id="email" name="courriel" required>
            </div>
            <div class="mb-5">
                <label for="password" class="form-label">Passe</label>
                <input type="password" class="form-control" id="password" name="passe" required>
            </div>
                <a href="">mot de passe oublié ?</a>
                <button type="submit" name="btn-acceder" class="mt-3 btn btn-secondary">Acceder</button>
        </form>    
    </div>
    <?php
        function acceder(){
            $courrielVisiteur = trim(htmlspecialchars($_POST['courriel']));
            $passeVisiteur = trim(htmlspecialchars($_POST['passe']));
                if(isset($courrielVisiteur) && !empty($courrielVisiteur) && isset($passeVisiteur) && !empty($passeVisiteur)){
                    $courriel = "38@000.fr";
                    $passe = "38000";
                        if($courrielVisiteur == $courriel && $passeVisiteur == $passe){
                            $_SESSION['courriel'] = $courrielVisiteur;
                              header('Location: articles.php') ;                    
                         }else{
                            echo "<div class='mt-5 contenaire'>
                                <p class='alert alert-warning p-5'>Probleme de passe ou de courriel</p>
                                  </div>";
                         }
                }else{
                    echo "<div class ='mt-3 container'>
                            <p class ='alert alert-secondary p-5'>remplir tous les champs</p>
                         </div>";
                };
                var_dump($courrielVisiteur);
                var_dump($passeVisiteur);
        };

        if(isset($_POST['btn-acceder'])){
            acceder();
        };
    ?>
</body>
</html>