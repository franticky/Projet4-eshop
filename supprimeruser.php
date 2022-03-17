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
    <link href="../css/bootstrap.css" rel="stylesheet"/>
    <link href="../css/supprimeruser.css" rel="stylesheet"/>
    <title>Document</title>
</head>
<body>
<header>
    <?php
        require_once "navbar.php"
    ?>
</header>
<?php
    try{
        $db = new PDO("mysql:host-locaslhost;dnname=users;charset=UTF8", "root","");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            //echo "connection to PDO MySQL established";
    }catch (PDOException $exception){
            echo "erreur" .$exception->getMessage();
    }
        //Requete SQL 
        $sql = "DELETE FROM `users` WHERE id_users = ?";
        //stock et recuperation de l id dans l url avec la superglobale GET
        $id = $_GET['id_user']; 
            //requete preparee pour luttere contre les injections sql
        $delete = $db->prepare($sql);
            //on lie le parametre de la requete sql(le '?') a l'id recup dans l' url
        $delete->bindParam(1, $id);
        $delete->execute(); //on execute la requete et retourne un tableau associatif

                    //si ca marche
            if($delete == true){
                ?>
                    <div class="container">
                <?php
                    //message de success + bouton de retour
                        echo "<p class='alrt-success'>user a ete supprimé</p>";
                        echo "<a href='admins.php' class='btn btn-success'>retour</a>";	
                ?>
                    </div>
                <?php
                    //sinon, " erreur "
            }else{
                echo "<div class='container'><p class='alert alert-success'>error</p></div>";
                var_dump($delete);
            }
}else{
      header("Location: debut.php");  
}
?>
</body>
</html>