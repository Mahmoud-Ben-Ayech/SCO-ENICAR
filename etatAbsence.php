<?php
include('connexion.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SCO-ENICAR Etat Absence</title>
  <!-- Bootstrap core CSS -->
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap core JS-JQUERY -->
  <script src="./assets/dist/js/jquery.min.js"></script>
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Custom styles for this template -->
  <link href="./assets/jumbotron.css" rel="stylesheet">

</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="index.php">SCO-Enicar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="index.html" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
            <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
            <a class="dropdown-item" href="ajouterGroupe.php">Ajouter Groupe</a>
            <a class="dropdown-item" href="modifierGroupe.php">Modifier Groupe</a>
            <a class="dropdown-item" href="supprimerGroupe.php">Supprimer Groupe</a>

          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="ajouterEtudiant.php">Ajouter Etudiant</a>
            <a class="dropdown-item" href="chercherEtudiant.php">Chercher Etudiant</a>
            <a class="dropdown-item" href="modifierEtudiant.php">Modifier Etudiant</a>
            <a class="dropdown-item" href="supprimerEtudiant.php">Supprimer Etudiant</a>


          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
            <a class="dropdown-item" href="etatAbsence.php">État des absences pour un groupe</a>
          </div>
        </li>

        <li class="nav-item active">
          <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
        </li>

      </ul>

      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher Groupe</button>
      </form>
    </div>
  </nav>


  <main role="main">
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-4">État des absences pour un groupe</h1>
        <p>Pour afficher l'état des absences, choisissez d'abord le groupe et la periode concernée!</p>
      </div>
    </div>

    <div class="container">
      <form>
        <table>
          <tr>
            <td>Date de début (j/m/a) : </td>
            <td>
              <input type="date" name="debut" size="10" value="01/09/2021" class="datepicker" />
            </td>
          </tr>
          <tr>
            <td>Date de fin : </td>
            <td>
              <input type="date" name="fin" size="10" value="12/03/2022" class="datepicker" />
            </td>
          </tr>
        </table>

        <div class="form-group">

          <label for="select-classe"> choisiser un Classe:</label>
          <select name="classe" class="form-control" id="select-classe">
            <?php
            $sql0 = "SELECT * FROM groupe";
            $stmt0 = $pdo->prepare($sql0);
            $stmt0->execute();
            while ($cats = $stmt0->fetch(PDO::FETCH_ASSOC)) { ?>
              <option value="<?php echo $cats['nomgrp']; ?>">
                <?php echo $cats['nomgrp']; ?>
              </option>
            <?php }
            ?>
          </select>
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr class="gt_firstrow ">
                <th>Nom</th>
                <th>Justifiées</th>
                <th>Non justifiées</th>
                <th>Total</th>
              </tr>
            </thead>


            <?php



            $sql = "SELECT * from etudiant";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($etudiants = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $nom = $etudiants['nom'];
              $prenom = $etudiants['prenom'];
              $full_name = $nom . " " . $prenom;
            ?>
              <tr class="row_3">
                <td><b><?php echo $full_name ?></b></td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
              </tr>
              <tr>
                <td><b><?php echo $full_name ?></b></td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
              </tr>
            <?php
            }
            ?>
          </table>
        </div>

      </form>
    </div>
  </main>

  <footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>

</html>