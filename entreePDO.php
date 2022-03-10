<?php
    $user = "root";
    $pass = "";
try{
    $dbh = new PDO('mysql:host=localhost;dname=ecommerce', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo"<p class='container alert alert-success text-center'>connecion a el pdo mysql</p>";
    return $dbh;   
}catch(PDOException $e){
    print "error!: ".$e->getMessage() ."<br/>";
    die();
}
?>