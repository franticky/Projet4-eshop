
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Projet4b/css/registre.css" rel="stylesheet"/>
    <link href="../Projet4b/css/bootstrap.css" rel="stylesheet"/>
    <title>registre</title>
</head>
<body>
<header>
    <?php
        require_once "navbar.php"
    ?>
</header>
    <?php
        try{
            $db = new PDO("mysql:host=localhost;dbname=surfbotte;charset=UTF8", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "connetction a PDO MySQL effectuée";
        }catch (PDOException $exception){
                echo "error" .$exception->getMessage();
        }
    ?>
    
        <div class="container">
                <form action="traitementAjoutDarticle.php" id="form-login" method="post" enctype="multipart/form-data">
                    <div class="text-center">
                            <img src="../Projet4b/img/logo.jpg" alt="logo surfbotte" title="surfbotte.fr">
                    </div>
                            <h4 class="text-center text-info">ajout d'admin</h4>
                        <div class="mb-5">
                            <label for="email" class="form-label">courriel</label>
                            <input type="email" class="form-control" id="email" name="courriel" required>
                        </div>
                            <div class="mb-5">
                                <label for="password" class="form-label">passe?</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-5">
                                <label for="password_repeat" class="form-label">repeter le passe</label>
                                <input type="password" class="form-control" id="password_repeat" name="password_repeat" required>
                            </div>
                        <input type="hidden" value="ADMIN" name="role" required>
                    <button thype="submit" name="btn-ajouter-admin" class="mt-3 btn btn-info">
                            ajout
                    </button>
                </form>
        </div>
    <?php
    
        $emailAdmin = trim(htmlspecialchars($_POST['courriel']));
        $passwordAdmin = trim(htmlspecialchars($_POST['password']));
        $password_repeat_admin = trim(htmlspecialchars($_POST['password_repeat']));

        if(isset($emailAdmin) && !empty($emailAdmin) && isset($passwordAdmin) && !empty($passwordAdmin)){
            if($passwordAdmin === $password_repeat_admin){
                $sql = "INSERT INTO `utilisateurs`(`courriel`, `password`) VALUES(?,?)";
                $insertUser = $db->prepare($sql);
                $insertUser->bindParam(1, $emailAdmin);
                    $insertUser->bindParam(2, $passwordAdmin);
                            $insertUser->execute(array(
                                $emailAdmin,
                                $passwordAdmin
                ));

                if($insertUser){
    ?>
                        <div class="container">
                            <?php
                                echo"<p class='alert alert-success p-3 mt-3'>inscription completée</p>";
                                echo"<a class='btn btn-success mt-3' href='../Projet4b/debut.php'>connecting</a>";
                            ?>
                        </div>
                    <style>
                        #form-register{
                            display:none;
                        }
                    </style>

    <?php
                }else{
                        echo "<div class='container'>
                            <p class='alert alert-danger'>remplir tous les champs</p></div>";
                }
            }else{
                echo "<div class='container'>
                    <p class='alert alert-danger'>les passes ne sont pas le meme</p></div>";
            }
        }
    ?>
</body>
</html>