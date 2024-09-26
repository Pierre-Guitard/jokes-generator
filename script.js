// on stock les elements html que l'on va utiliser dans des variables js

const btnJokes = document.querySelector('.jokesBtn')
const jokeSection = document.querySelector('.joke')
const btnFavJokes = document.querySelector('.favJokesBtn')
const checkBox = document.querySelectorAll('.checkbox')
let categories = ['any']

btnJokes.addEventListener('click', () => {
  getAJoke()
})


btnFavJokes.addEventListener('click', () => {
  getSavedJokes()
})

  // On choisit la catégorie via la checkbox, la value est ensuite intégrée à la requete API
  checkBox.forEach(checkbox => {
    checkbox.addEventListener('click', () => {
      if (checkbox.checked) {
        // La catégorie ne peut etre présente qu'une seule fois dans le tableau
        if (!categories.includes(checkbox.name)) {
          categories.push(checkbox.name);
        }
      } else {
        // Si la checkbox n'est pas coché, on retire la categorie
        const index = categories.indexOf(checkbox.name);
          categories.splice(index, 1);
      }
    });
  });

// On récupère une blague via l'API
async function getAJoke() {

  try {
    const response = await axios.get(`https://v2.jokeapi.dev/joke/${categories.toString()}?&blacklistFlags=nsfw,religious,racist,sexist,explicit`)
    const joke = response.data
    displayJoke(joke)
  } catch(error) {
    console.error(error)
  }
}

async function getSavedJokes() {
  // On récupère les blagues sauvegardées, en faisant une requete GET à notre fichier php qui communique avec la base, puis on récupère les données en json
  try {
    const response = await fetch('jokes-controller.php')
    const jokes = await response.json()
    displayFavJokes(jokes)
  } catch (error) {
    console.error(error)
  }
}

function displayJoke(joke) {

  // On creer les éléments que l'on va ajouter dans le HTML, et set les valeurs avec les données récupérées de l'API
  // On vide le HTML au début de la fonction pour eviter de dupliquer cette section
  jokeSection.innerHTML = ''
  const divJoke = document.createElement('div')
  const setup = document.createElement('h2')
  const delivery = document.createElement('p')
  const saveBtn = document.createElement('button')


  // Si l'API ne trouve pas de blague par rapport aux catégories qu'on donne et que error == true , on adapte la vue et invite l'utilisateur à mettre des catégories supplémentaires
  if (joke.error == false) {
    setup.textContent = joke.setup
    delivery.textContent = joke.delivery
    saveBtn.textContent = "Add this joke to favorite"

    saveBtn.addEventListener('click', () => {
      saveJoke(joke, saveBtn)
    })
  }else {
    setup.textContent = "Oups..."
    delivery.textContent = "No jokes found with this category, try again with new categories!"
  }

  divJoke.append(setup, delivery, saveBtn)
  jokeSection.appendChild(divJoke)
}


function saveJoke(joke, btn) {

  // En fonction du succes/echec de la requête post, on va afficher le message qui correspond
  const succesMessage = document.createElement('p')
  const errorMessage = document.createElement('p')

  // on va préciser le body de notre requete post avec les champs et leurs valeurs
  // On pointe vers jokes-controller, la suite de la requete est traité en php
  axios.post('jokes-controller.php', {
    setup: joke.setup,
    delivery: joke.delivery
  })
  .then(function () {
    // On enlève le boutton de sauvegarde pour eviter les doublons et de faire une verif dans la base
    btn.remove()
    succesMessage.textContent = "Joke saved with success!"
    jokeSection.appendChild(succesMessage)
  })
  .catch(function (error) {
    console.log(error)
    errorMessage.textContent = "Error while saving the joke"
    jokeSection.appendChild(errorMessage)
  })
}

async function deleteJoke(joke) {

  // Pour supprimé la blague, je passe son id en param dans l'url (suite en php)
  try {
    response = await axios.delete(`jokes-controller.php/${joke.id}`)
  } catch (error) {
    console.error(error)
  }
}

function displayFavJokes(jokes) {
  jokeSection.innerHTML = ''
  const title = document.createElement('h1')
  title.textContent = "Favorites jokes : "
  jokeSection.appendChild(title)

  // On itère sur chaque objet joke, et pour chaque objet, on creer la structure html qui acceuillera l'énoncer et la chute de la blague
  jokes.forEach( joke => {

    const divJoke = document.createElement('div')
    divJoke.classList.add('joke-item', 'mb-4', 'border', 'p-3', 'rounded');
    const setup = document.createElement('h2')
    const delivery = document.createElement('p')
    const deleteBtn = document.createElement('button')
    deleteBtn.classList.add('btn', 'btn-danger')

    setup.textContent = joke.setup
    delivery.textContent = joke.delivery
    deleteBtn.textContent = "Delete this joke"

    deleteBtn.addEventListener('click', () => {
      if (deleteJoke(joke)) {
        // on supprime les éléments html si la blague est bien supprimée en base de donnée, pour ne pas avoir besoin de re actualisé la page pour faire disparaitre le HTML
        divJoke.remove()
      }
    })

    divJoke.append(setup, delivery,  deleteBtn)
    jokeSection.appendChild(divJoke)
  })
}
