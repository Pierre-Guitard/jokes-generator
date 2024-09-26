<?php

// session_start pour permettre d'avoir acces aux superglobals de session par exemple
session_start();

// require le fichier le connexion à la base de donnée
require_once 'pdo.php';

// Spécifie par sécurité que les données renvoyées seront en JSON
header('Content-Type: application/json');


// Gestion des différentes méthodes HTTP

switch ($_SERVER['REQUEST_METHOD']) {
    //Si la method axios reçu est de type get, alors on effectue la requete sql, qui recupère les blagues dont le user_id correspond à la valeur trouvée dans la superglobal _$SESSION["user_id"]
    //On récupère les données sous forme de tableau associatif et les renvoies en JSON pour qu'elles soient manipulées facilement en JS
  case 'GET':
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT id, setup, delivery, user_id FROM jokes WHERE user_id = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$user_id]);
    $jokes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($jokes);
    break;

  case 'POST':
  // permet de récupéré les données envoyées avec axios
  $inputJSON = file_get_contents('php://input');

  // décode le json et converti en tableau associatif php
  $input = json_decode($inputJSON, true);

  // creation de mes variables avec la donnée récupérée dans axios
  $setup = $input['setup'];
  $delivery = $input['delivery'];
  $user_id = $_SESSION['user_id'];

  // creation de la requete préparée et envoie de cette derniere
  $sql = "INSERT INTO jokes (setup, delivery, user_id) VALUES (?, ?, ?)";
  $stmt = $bdd->prepare($sql);
  $stmt->execute([$setup, $delivery, $user_id]);
    break;

  case 'DELETE':
  // Je passe en params dans l'url l'id de la blague a delete, ensuite j'utilise ltrim pour retirer le /, et je passe le tout dans intval() pour récupérer un int et non une string
  // (je ne pense pas que c'est la method classique en php mais en voyant que je pouvais récupérer l'id via les la superglobal "PATH_INFO", je suis parti la dessus)
  $params = intval(ltrim($_SERVER["PATH_INFO"], '/'));
  $sql = "DELETE FROM jokes WHERE id=$params";
  $stmt = $bdd->prepare($sql);
  $stmt->execute();
    break;
}
?>
