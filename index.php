<?php
session_start();


// On check que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
  // Si ce n'est pas le cas, on le redirige vers la page de login
  header('Location: login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="script.js" defer></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


  <link rel="stylesheet" href="style.css">
  <title>Jokes Generator</title>
</head>
<body>

  <!-- Navbar avec le bouton de déconnexion -->
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Jokes Generator</a>
      <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="displayJokes text-center border p-4 bg-light rounded shadow-sm">
      <h1 class="mb-4">Jokes Generator</h1>

      <!-- Les cases à cocher pour sélectionner les types de blagues -->
      <div class="checkbox-group mb-3">
        <input type="checkbox" id="any" name="any" class="form-check-input checkbox" checked />
        <label for="any" class="form-check-label">Any</label>
      </div>

      <div class="checkbox-group mb-3">
        <input type="checkbox" id="programming" name="programming" class="form-check-input checkbox" />
        <label for="programming" class="form-check-label">Programming</label>
      </div>

      <div class="checkbox-group mb-3">
        <input type="checkbox" id="misc" name="misc" class="form-check-input checkbox" />
        <label for="misc" class="form-check-label">Misc</label>
      </div>

      <div class="checkbox-group mb-3">
        <input type="checkbox" id="dark" name="dark" class="form-check-input checkbox" />
        <label for="dark" class="form-check-label">Dark</label>
      </div>

      <div class="checkbox-group mb-3">
        <input type="checkbox" id="pun" name="pun" class="form-check-input checkbox" />
        <label for="pun" class="form-check-label">Pun</label>
      </div>

      <div class="checkbox-group mb-3">
        <input type="checkbox" id="spooky" name="spooky" class="form-check-input checkbox" />
        <label for="spooky" class="form-check-label">Spooky</label>
      </div>

      <div class="checkbox-group mb-3">
        <input type="checkbox" id="christmas" name="christmas" class="form-check-input checkbox" />
        <label for="christmas" class="form-check-label">Christmas</label>
      </div>

      <button class="btn btn-primary jokesBtn mb-2">Generate a joke</button>
      <br>
      <button class="btn btn-secondary favJokesBtn">See your favorites jokes</button>

      <div class="joke mt-4"></div>
    </div>

    <div id="jokeSection" class="saved-jokes mt-5"> </div>
  </div>

</body>
</html>
