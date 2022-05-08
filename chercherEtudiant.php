<?php
require_once("connexion.php");
session_start();
if ($_SESSION["autoriser"] != "oui") {
  header("location:login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SCO-ENICAR Chercher Etudiant</title>
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
          <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>
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
        <h1 class="display-4">Chercher des étudiants</h1>
        <p>Cliquer sur le bouton afin d'actualiser la liste!</p>
        <form class="page-header-signup mb-2 mb-md-0" action="chercherEtudiant.php" method="POST">
          <div class="form-row justify-content-center">
            <div class="col-lg-6 col-md-8">
              <div class="form-group mr-0 mr-lg-2">
                <input name="recherche-mdp" class="form-control form-control-solid rounded-pill" type="text" placeholder="donner le nom de l'etudiant ..." />
              </div>
            </div>
            <div class="col-lg-3 col-md-4">
              <button class="btn btn-outline-success my-2 my-sm-0" name="recherche" type="submit" onload="refresh()">rechercher</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="table-responsive">
          <table class="table table-striped table-hover">

            <tr>
              <th>
                CIN
              </th>
              <th>
                Email
              </th>
              <th>
                Nom
              </th>
              <th>
                Prénom
              </th>
              <th>
                adresse
              </th>
              <th>
                Classe
              </th>
            </tr>
            <!--traitement de la premiere Etudiant-->
            <?php

            if (isset($_POST['recherche'])) {
              $mdp = trim($_POST['recherche-mdp']);
              $sql = "SELECT * from etudiant where nom = :nom ";
              $stmt = $pdo->prepare($sql);
              $stmt->execute([
                ':nom' => '%' . $mdp . '%'
              ]);
              while ($var = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $cin = $var['cin'];
                $email = $var['email'];
                $nom = $var['nom'];
                $prenom = $var['prenom'];
                $adresse = $var['adresse'];
                $classe = $var['Classe'];
            ?>
                <tr>
                  <td>
                    <?php echo $cin ?>
                  </td>
                  <td>
                    <?php echo $email ?>
                  </td>
                  <td>
                    <?php echo $nom ?>
                  </td>
                  <td>
                    <?php echo $prenom ?>
                  </td>
                  <td>
                    <?php echo $adresse ?>
                  </td>
                  <td>
                    <?php echo $classe ?>
                  </td>
                </tr>

            <?php
              }
            }
            ?>
          </table>
          <br>
        </div>
      </div>
    </div>

  </main>


  <footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>

</html>