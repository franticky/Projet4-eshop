<?php
session_start();
if(isset($_SESSION['courriel'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Projet4b/css/admins.css" rel="stylesheet"/>
    <link href="../Projet4b/css/bootstrap.css" rel="stylesheet"/>
    <title>admins</title>
</head>
<body>

    <header>
    <?php
        require_once "navbar.php"
    ?>
    </header>

    <?php
        try{
            $db = new PDO("mysql:host=localhost;dbname=articles;charset=UTF8", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "connection effectuee";
        }catch (PDOException $exception){
            echo "erreur" .$exception->getMessage();    
        }

                                //requete de selection de tous les users 
        $sql = "SELECT * FROM `users`";
                                //parcours de tous les users & stock une variable
        $utilisateurs = $db->query($sql);
?>

<div class="container">
    <table class="table table-striped">
        <thready>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">mél</th>
                <th scope="col">passe</th>
                <th scope="col">editer</th>
                <th scope="col">supprimer</th>
            </tr>
    </thready>
    <tbody>
        <?php
            foreach($utilisateurs as $utilisateur){
        ?>   
            <tr>
                <th scope="row"><?= $utilisateur['id_users'] ?></th>
                <td><?= $utilisateur['courriel'] ?></td>
                <td><?= $utilisateur['passe'] ?></td>
                <td>
                    <a href="" class="btn btn-success">edit</a>
                </td>
                <td>
                    <a href="supprimer_utilisateur.php?id_utilisateur=<?= $utilisateur['id_users'] ?>" class="btn btn-success">supprimer</a>
                </td>
            </tr>      
        <?php   
            }
        ?>
        </tbody>
    </table>
</div>
<?php   
}else{
    header("Location: ../debut.php");
}
?>
</body>
</html>