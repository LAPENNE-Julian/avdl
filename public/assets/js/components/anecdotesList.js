const anecdotesList = {

  init: function() {

    console.log("anecdotesList.init() appelé");
    this.bindAllAnecdotesEvents();
  },

  // ---------------------------------------------------------
  // Binders
  // ---------------------------------------------------------

  bindAllAnecdotesEvents: function() {
    //Select element <a id="nav-link-anecdote-browse">
    const anecdoteBrowseLink = document.querySelector("#nav-link-anecdote-browse");
    //Add event listener on click navigation
    anecdoteBrowseLink.addEventListener("click", anecdotesList.handleLoadAnecdotes());
  },

  // ---------------------------------------------------------
  // Handlers
  // ---------------------------------------------------------

  handleLoadAnecdotes: function(){
    
    this.loadAnecdotesFromAPI();
  },

  // ---------------------------------------------------------
  // DOM
  // ---------------------------------------------------------

  createDivAnecdote: function(title, description, categoryName1, categoryColor1, categoryName2, categoryColor2, categoryName3, categoryColor3, pseudo, createdAt) {

    //<div class="anecdote-browse-item">
      //<div id="label-categories" class="container-fluid">
      //<span class="label-category" style ="border: medium solid yellow">Catégorie</span>
      //<span class="label-category" style ="border: medium solid yellow">Catégorie</span>
      //</div>
    //<h2>Titre de l'anecdote 1</h2>
    //<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime voluptatibus similique odit ex, inventore molestias repudiandae. Expedita similique quod placeat iure voluptatibus consequuntur sequi ducimus esse quos aliquid, ratione ipsum!<a href="#" class="anecdote__link">afficher plus</a></p>
    //<p id="author">Publié par Auteur le 01.01.1999</p>
    //</div>

    //Create div element <div class="anecdote-browse-item">
    const divAnecdote = document.createElement('div');
    divAnecdote.classList.add('anecdote-browse-item');

    //Create div element <div id="label-categories" class="container-fluid">
    const divCategories = document.createElement('div');
    divCategories.setAttribute('id', 'label-categories');
    divCategories.classList.add('container-fluid');

    //Add element divCategories in element divAnecdote
    divAnecdote.append(divCategories);

    const categoriesArray = [
      {'categoryName' : categoryName1, 'categoryColor' : categoryColor1 },
      {'categoryName' : categoryName2, 'categoryColor' : categoryColor2 },
      {'categoryName' : categoryName3, 'categoryColor' : categoryColor3 },
    ]

    for (category of categoriesArray) {
      
      if(category.categoryName !== null){
        //Create span element <span class="label-category" style ="border: medium solid yellow">Catégorie</span>
        const categorySpan = document.createElement('span');
        categorySpan.classList.add('label-category');
        categorySpan.setAttribute('style', 'border: medium solid ' + category.categoryColor);
        categorySpan.textContent = category.categoryName;
      
        //Add element <span> in element <div id="label-categories" class="container-fluid">
        divCategories.append(categorySpan);
      }
    }

    //Create h2 element <h2>Titre de l'anecdote 1</h2>
    const anecdoteTitle = document.createElement('h2');
    anecdoteTitle.textContent = title;

    //Add element divCategories in element divAnecdote
    divAnecdote.append(anecdoteTitle);

    //Create <p> element with description of anecdote
    const anecdoteDescription = document.createElement('p');
    anecdoteDescription.textContent = description;

    //Add element anecdoteDescription in element divAnecdote
    divAnecdote.append(anecdoteDescription);

    //Create <p> element with description of anecdote
    const anecdotePublishing = document.createElement('p');
    anecdotePublishing.setAttribute('id', 'author');
    anecdotePublishing.textContent = 'Publié par ' + pseudo + ' le ' + createdAt;

    //Add element anecdotePublishing in element divAnecdote
    divAnecdote.append(anecdotePublishing);

    return divAnecdote;
  },

  insertDivAnecdoteIntoParent: function(divAnecdote) {

    //Select element <div id="anecdote-browse-inner"> in DOM
    const parentElement = document.querySelector('#anecdote-browse-inner');

    //Add divAnecdoter in parentElement
    parentElement.append(divAnecdote);
  },

  // ---------------------------------------------------------
  // AJAX
  // ---------------------------------------------------------

loadAnecdotesFromAPI: function() {

    const config = {
      method: "GET",
      mode: "cors",
      cache: "no-cache"
    };

    fetch(app.apiRootUrl + "/anecdote", config)
    .then(
      function(response) {
        //convert json response to object
        return response.json(); 
      }
    )
    .then(
      function(object) {

        for(const anecdote of object.anecdotes){

          //Create anecdote element browse
          const anecdoteItem = anecdotesList.createDivAnecdote(
            anecdote.title, 
            anecdote.description, 
            anecdote.categoryName1, anecdote.categoryColor1, 
            anecdote.categoryName2, anecdote.categoryColor2,
            anecdote.categoryName3, anecdote.categoryColor3,
            anecdote.pseudo, 
            anecdote.created_at);

          //Insert into DOM
          anecdotesList.insertDivAnecdoteIntoParent(anecdoteItem);
        }
      }
    );
  
  },
  
}