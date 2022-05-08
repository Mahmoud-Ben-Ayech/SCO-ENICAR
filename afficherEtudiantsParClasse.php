<?php include("connexion.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SCO-ENICAR liste des Etudiants Par CLasse</title>
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="./assets/dist/js/jquery.min.js"></script>
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

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
        <h1 class="display-4">liste d'étudiants par groupe</h1>
        <p>choisiser d'apres la liste de groupe !</p>
      </div>
    </div>

    <div class="container">
      <form action="" method="POST">
        <div class="form-group">
          <label for="classe">Choisir une classe:</label><br>


          <select id="classe" name="classe" class="custom-select custom-select-sm custom-select-lg">
            <?php
            $aa = "SELECT * FROM groupe";
            $bb = $pdo->prepare($aa);
            $bb->execute();
            while ($cc = $bb->fetch(PDO::FETCH_ASSOC)) { ?>
              <option value="<?php echo $cc['nomgrp']; ?>">
                <?php echo $cc['nomgrp']; ?>
              </option>
            <?php }
            ?>
          </select>
          </br>
          </br>
          <button name="affichageparclasse" type="submit" onclick="refresh()" class="btn btn-primary btn-block active">afficher</button>
        </div>
      </form>
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

            <!-- traitement d'une etudiant  -->


            <?php

            if ($_SESSION["autoriser"] != "oui") {
              header("location:login.php");
              exit();
            } else {
              if (isset($_POST['affichageparclasse'])) {
                $classe = $_POST['classe'];
                $sql = "SELECT * from etudiant where Classe = :classe";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                  ':classe' => $classe,
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

  <script>
    function refresh() {
      var xmlhttp = new XMLHttpRequest();
      var url = "http://localhost/projetweb/afficher.php";

      //Envoie de la requete
      xmlhttp.open("GET", url, true);
      xmlhttp.send();


      //Traiter la reponse
      xmlhttp.onreadystatechange = function() { // alert(this.readyState+" "+this.status);
        if (this.readyState == 4 && this.status == 200) {

          myFunction(this.responseText);
          //alert(this.responseText);
          console.log(this.responseText);
          //console.log(this.responseText);
        }
      }


      function myFunction(response) {
        var obj = JSON.parse(response);

        if (obj.success == 1) {
          var arr = obj.var;
          var i;
          var out = `<table  class='table table-striped table-hover' ><tr>
                            <th>
                                CIN
                            </th>
                            <th>
                                Nom
                            </th>
                            <th>
                                Prénom
                            </th>
                            <th>
                                Adresse
                            </th>
                            <th>
                                Email
                            </th>
                        </tr>`;
          for (i = 0; i < arr.length; i++) {
            out += "<tr><td>" +
              arr[i].cin +
              "</td><td>" +
              arr[i].nom +
              "</td><td>" +
              arr[i].prenom +
              "</td><td>" +
              arr[i].adresse +
              "</td><td>" +
              arr[i].email +
              "</td></tr>";
          }
          out += "</table>";
          document.getElementById("demo-class").innerHTML = out;
        } else document.getElementById("demo-class").innerHTML = "Aucun étudiant!";

      }
    }
  </script>

</body>

</html>