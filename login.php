<?php
session_start();

// Connexion à la base de données
require_once 'pdo.php';

// On récupère les données du formulaire de la view
require_once 'login-view.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Vérifier si l'utilisateur existe dans la base de données
  // on utilise une requete préparé pour eviter les injections sql et gagner en efficacité
  $sql = "SELECT * FROM users WHERE email = ?";
  $stmt = $bdd->prepare($sql);
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  if ($user) {
    // Vérifier si le mot de passe correspond
    if (password_verify($password, $user['password'])) {
      // Mot de passe correct, démarrer la session utilisateur
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['email'] = $user['email'];

      // Redirection vers la page d'accueil protégée
      header('Location: index.php');
      exit;
    } else {
      $error = 'Mot de passe incorrect.';
    }
  } else {
    $error = 'Utilisateur non trouvé.';
  }
}
