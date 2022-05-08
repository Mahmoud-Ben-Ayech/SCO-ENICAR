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
<!-- -->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SCO-ENICAR Modifier etudiants</title>
  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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
        <h1 class="display-4">Modifier les étudiants</h1>
        <p>Cliquer sur le bouton afin d'actualiser la liste!</p>
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
              <th>
                modifier
              </th>
            </tr>
            <!--traitement de premiere Etudiant-->
            <?php
            $sql = "SELECT * from etudiant";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
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
                <td>
                  <?php
                  if ($_SESSION["autoriser"] != "oui") {
                    header("location:login.php");
                    exit();
                  } else {
                    if (isset($_POST['ajoutepost'])) {
                      $c = trim($_POST['cin']);
                      $email = trim($_POST['email']);
                      $pwd = trim($_POST['password']);
                      $cpwd = trim($_POST['cpassword']);
                      $nom = trim($_POST['nom']);
                      $prenom = trim($_POST['prenom']);
                      $adresse = trim($_POST['adresse']);
                      $classe = trim($_POST['classe']);
                      $identif = $_POST['identif'];
                      $sql = "UPDATE etudiant SET cin = :cin, email = :email, password = :password, cpassword = :cpassword, nom = :nom, prenom = :prenom, adresse = :adresse, Classe = :classe WHERE cin = :identif";
                      $stmt = $pdo->prepare($sql);
                      $stmt->execute([
                        ':cin' => $c,
                        ':email' => $email,
                        ':password' => md5($pwd),
                        ':cpassword' => md5($cpwd),
                        ':nom' => $nom,
                        ':prenom' => $prenom,
                        ':adresse' => $adresse,
                        ':classe' => $classe,
                        ':identif' => $identif
                      ]);
                      $erreur = "modification  effectué avec succés ";
                    }
                  }

                  ?>
                  <form action="modifierEtudiant.php" method="POST">
                    <input type="hidden" name="identif" value="<?php echo $cin ?>" />
                    <button type="button" class="btn btn-outline-success my-2 my-sm-0" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                      Modifier
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">modifier Etudiant</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <!-- nom -->
                            <div class="form-group">
                              <input type="hidden" name="identif" value="<?php echo $cin ?>" />
                              <label for="nom">Nom:</label><br>
                              <input type="text" id="nom" name="nom" class="form-control" required autofocus>
                            </div>
                            <!--Prénom-->
                            <div class="form-group">
                              <label for="prenom">Prénom:</label><br>
                              <input type="text" id="prenom" name="prenom" class="form-control" required>
                            </div>
                            <!--Email-->
                            <div class="form-group">
                              <label for="email">Email:</label><br>
                              <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <!--CIN-->
                            <div class="form-group">
                              <label for="cin">CIN:</label><br>
                              <input type="text" id="cin" name="cin" class="form-control" required pattern="[0-9]{8}" title="8 chiffres" />
                            </div>
                            <!--Password-->
                            <div class="form-group">
                              <label for="pwd">Mot de passe:</label><br>
                              <input type="password" id="pwd" name="pwd" class="form-control" required pattern="[a-zA-Z0-9]{8,}" title="Au moins 8 lettres et nombres" />
                            </div>
                            <!--ConfirmPassword-->
                            <div class="form-group">
                              <label for="cpwd">Confirmer Mot de passe:</label><br>
                              <input type="password" id="cpwd" name="cpwd" class="form-control" required />
                            </div>
                            <!--Classe-->
                            <div class="form-group">
                              <label for="select-classe"> Classe:</label>
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
                            <!--Adresse-->
                            <div class="form-group">
                              <label for="adresse">Adresse:</label><br>
                              <textarea id="adresse" name="adresse" rows="10" cols="30" class="form-control" required>
                        </textarea>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="close" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
                            <button type="submit" name="ajoutepost" value="ajouter" class="btn btn-primary">modifier</button>
                          </div>

                        </div>
                      </div>
                    </div>
                  </form>

                </td>
              </tr>

            <?php
            }
            ?>
          </table>
          <br>
        </div>
        <a href="modifierEtudiant.php" class="btn btn-primary btn-block active">Actualiser </a>
      </div>
    </div>
  </main>
  <footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>


</html>