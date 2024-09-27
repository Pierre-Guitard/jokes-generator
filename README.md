Joke Generator est un site permettant à l'utilisateur de choisir un thème et de recevoir une blague en lien ce dernier.
L'utilisateur a également la possibilité de sauvegarder la blague et de consulter ses blagues sauvegardées.
À partir de cette vue, il peut également supprimer les blagues qu'il ne souhaite plus conserver.

Pour la gestion des variables d'environnement, j'ai utiliser phpDotEnv qui permet de gérer tout seul la récupération de ces dernières, qui sont elles, stockées dans un .env non poussé sur GitHub.

Remarque : Les blagues sont en anglais, car le système de catégories n'est pas encore suffisamment fourni en français, et ne trouve pas de blague avec certaines catégories précises.

Pour lancer le serveur local:
php -S localhost:8080
