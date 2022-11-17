const anecdotesList = {

  init: function() {

    console.log("anecdotesList.init() appelé");
    anecdotesList.bindAllAnecdotesEvents();
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
    
    anecdotesList.loadAnecdotesFromAPI();
  },

  // ---------------------------------------------------------
  // DOM
  // ---------------------------------------------------------

  createDivAnecdote: function(id, title, description, categoryName1, categoryColor1, categoryName2, categoryColor2, categoryName3, categoryColor3, pseudo, createdAt) {

    //Create div element <article class="anecdote-browse-item">
    const divAnecdote = document.createElement('article');
    divAnecdote.setAttribute('id', id);
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

    //Create <a> element with link to read anecdote
    const anecdoteLink = document.createElement('a');
    anecdoteLink.setAttribute('href', '/anecdote/' + id);
    anecdoteLink.textContent = 'Lire la suite';

    //Add element divAnecdote in element anecdoteDescription
    divAnecdote.append(anecdoteLink);

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

    if(parentElement !== null){

      //Add divAnecdote in parentElement
      parentElement.append(divAnecdote);
    }
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
              anecdote.id,
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