<?php

ob_start();

require_once 'signup-view.php';
require_once 'pdo.php';

if (isset($_POST["submit"])) {
  $pseudo = $_POST['pseudo'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm = $_POST['confirm'];

  $pseudo = htmlspecialchars($pseudo);

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "L'email n'est pas au bon format";
    exit;
  }

  if (($password !== $confirm)) {
    $error = "Les mots de passes doivent correspondre";
    exit;
  }

  $hash = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO users(pseudo, email, password) VALUES(?, ?, ?)";
  $stmt = $bdd->prepare($sql);
  $stmt->execute([$pseudo, $email, $hash]);

  header('Location: index.php');
  ob_end_flush();
}
?>
