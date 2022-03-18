<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../Projet4b/css/navbar.css" rel="stylesheet"/>
    <link href="../Projet4b/css/bootstrap.css" rel="stylesheet"/>
    <title>Surfbotte</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Surfbotte</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="debut.php">Entree
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registre.php">Registre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admins.php">Administrateurs</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ArriereBoutique</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Supprimer</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="admins.php">Administrateurs</a>
          </div>
        </li>
      </ul>
      
      <form method="post" id="searchbar">
        <input class="form-control me-sm-2" type="search" name="trouver" placeholder="trouver">
        <button class="btn btn-secondary my-2 my-sm-0" name="btn-trouver" type="submit">Trouver</button>
      </form>
     
      <?php
        if(isset($_POST['btn-trouver'])){
          if(isset($POST['trouver'])){
            $chercher = $_POST['trouver'];
          }else{
            $chercher = "";
          }

          if(!empty($chercher)){
            $sql = "SELECT * FROM articles WHERE nom_article LIKE '%$chercher%' OR description_article LIKE '%$chercher%'";
            $statement = $dbh->query($sql);
          }else{
            $sql = "SELECT * FROM articles";
            $statement = $dbh->query($sql);
          }
        }
      ?>
    </div>
  </div>
</nav>
</body>
</html>