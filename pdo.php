<?php
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$dsn = $_ENV['dsn'];
$username = $_ENV['username'];
$password = $_ENV['password'];

try {
  $bdd = new PDO($dsn, $username, $password);
  // echo "Connexion réussie !";
} catch (PDOException $error) {
  echo "Erreur : $error";
}
?>
