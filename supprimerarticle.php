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
    <title>Suppression d articles</title>
</head>
<body>
<div class="container-fluid">
   <?php
    $user = "root";
    $pass = "";
        
        try{
            $dbh = new PDO('mysql:host=localhost;dbname=surfbotte', $user, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
                echo "<p class='container alert alert-primary text-center'>conneté a PDO Mysql</p>";
        }catch(PDOException $e){
            print "error" . $e->getMessage() . "<br/>";
            die();
        }

            
   ?>
    
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