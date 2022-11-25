const anecdotesList = {

  init: function(pathName) {

    console.log("anecdotesList.init() appelé");

    if(pathName === "/anecdote"){

      //If pathName of the url is '/anecdote'
      anecdotesList.bindAllAnecdotes(pathName);
    }

    if(pathName === "/anecdote/best"){

      //If pathName of the url is '/anecdote'
      anecdotesList.bindBestAnecdotes();
    }
  },

  // ---------------------------------------------------------
  // Binders
  // ---------------------------------------------------------

  bindAllAnecdotes: function() {

    //Loaded All anecdotes in the view
    anecdotesList.handleLoadAnecdotes();
  },

  bindBestAnecdotes: function() {

    //Loaded All anecdotes in the view
    anecdotesList.handleLoadBestAnecdotes();
  },

  // ---------------------------------------------------------
  // Handlers
  // ---------------------------------------------------------

  handleLoadAnecdotes: function(){
    
    //Set request option to get all anecdote
    let requestOption = '/anecdote';

    //Get all anecdotes from API
    anecdotesList.loadAnecdotesFromAPI(requestOption);
  },

  handleLoadBestAnecdotes: function(){
    
    //Set request option to get best anecdote
    let requestOption = '/anecdote/best';
    
    //Get all anecdotes from API
    anecdotesList.loadAnecdotesFromAPI(requestOption);
  },

  // ---------------------------------------------------------
  // DOM
  // ---------------------------------------------------------

  createDivAnecdote: function(requestOption, id, title, description, categoryId1, categoryName1, categoryColor1, categoryId2, categoryName2, categoryColor2, categoryId3, categoryName3, categoryColor3, pseudo, createdAt) {

    //If request option === /anecdote/best
    if(requestOption ==="/anecdote/best"){
      //Select h1 in section element
      const header1 = document.querySelector("#anecdote-browse h1");
      //Set header for best anecdotes
      header1.textContent = "Top 5 des anecdotes";
    }

    //Create div element <article class="anecdote-browse-item">
    const divAnecdote = document.createElement("article");
    divAnecdote.setAttribute("id", id);
    divAnecdote.classList.add("anecdote-browse-item");

    //Create div element <div id="label-categories" class="container-fluid">
    const divCategories = document.createElement("div");
    divCategories.setAttribute("id", "label-categories");
    divCategories.classList.add("container-fluid");

    //Add element divCategories in element divAnecdote
    divAnecdote.append(divCategories);

    const categoriesArray = [
      {'categoryId': categoryId1, 'categoryName' : categoryName1, 'categoryColor' : categoryColor1 },
      {'categoryId': categoryId2, 'categoryName' : categoryName2, 'categoryColor' : categoryColor2 },
      {'categoryId': categoryId3, 'categoryName' : categoryName3, 'categoryColor' : categoryColor3 },
    ]

    for (category of categoriesArray) {
      
      if(category.categoryName !== null){
        //Create span element <span class="label-category" style ="border: medium solid yellow">Catégorie</span>
        const categorySpan = document.createElement("span");
        categorySpan.classList.add("label-category");
        categorySpan.setAttribute("style", "border: medium solid " + category.categoryColor);
        
        //Create a element <a href="/category/id">
        const categoryLink = document.createElement("a");
        categoryLink.setAttribute("href", "/category/" + category.categoryId + "/anecdote");
        categoryLink.textContent = category.categoryName;
      
        //Add element <a> in element <span>
        categorySpan.append(categoryLink);
      
        //Add element <span> in element <div id="label-categories" class="container-fluid">
        divCategories.append(categorySpan);
      }
    }

    //Create h2 element <h2>Titre de l'anecdote 1</h2>
    const anecdoteTitle = document.createElement("h2");
    anecdoteTitle.textContent = title;

    //Add element divCategories in element divAnecdote
    divAnecdote.append(anecdoteTitle);

    //Create <p> element with description of anecdote
    const anecdoteDescription = document.createElement("p");
    anecdoteDescription.textContent = description;

    //Add element anecdoteDescription in element divAnecdote
    divAnecdote.append(anecdoteDescription);

    //Create <a> element with link to read anecdote
    const anecdoteLink = document.createElement("a");
    anecdoteLink.setAttribute("href", "/anecdote/" + id);
    anecdoteLink.setAttribute("id", "anecdote-browse-link-read")
    anecdoteLink.textContent = "Lire la suite";

    //Add element divAnecdote in element anecdoteDescription
    divAnecdote.append(anecdoteLink);

    //Create <p> element with description of anecdote
    const anecdotePublishing = document.createElement("p");
    anecdotePublishing.setAttribute("id", "author");
    //Represent Date
    const date = new Date(createdAt);
    //Set author and date format
    anecdotePublishing.textContent = "Publié par " + pseudo + " le " + date.toLocaleDateString("fr");

    //Add element anecdotePublishing in element divAnecdote
    divAnecdote.append(anecdotePublishing);

    return divAnecdote;
  },

  insertDivAnecdoteIntoParent: function(divAnecdote) {

    //Select element <div id="anecdote-browse-inner"> in DOM
    const parentElement = document.querySelector("#anecdote-browse-inner");

    //Add divAnecdote in parentElement
    parentElement.append(divAnecdote);
  },

  // ---------------------------------------------------------
  // AJAX
  // ---------------------------------------------------------

  loadAnecdotesFromAPI: function(requestOption) {

    const config = {
      method: "GET",
      mode: "cors",
      cache: "no-cache"
    };

    fetch(app.apiRootUrl + requestOption, config)
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
            requestOption,
            anecdote.id,
            anecdote.title, 
            anecdote.description, 
            anecdote.category_1, anecdote.categoryName1, anecdote.categoryColor1, 
            anecdote.category_2, anecdote.categoryName2, anecdote.categoryColor2,
            anecdote.category_3, anecdote.categoryName3, anecdote.categoryColor3,
            anecdote.pseudo, 
            anecdote.created_at);

          //Insert into DOM
          anecdotesList.insertDivAnecdoteIntoParent(anecdoteItem);
        }
      }
    )
    .catch(
      function(error) {

        console.log(error);

        //Select section element <section>
        const sectionElement = document.querySelector("#anecdote-browse");

        //Select h1 in section element
        const header1 = document.querySelector("#anecdote-browse h1");
        //delete h1 element
        header1.remove();

        //Select h1 in section element
        const arrowNavigation = document.querySelector("#arrow-navigation");
        //delete h1 element
        arrowNavigation.remove();

        //Post error 404 view in section element
        app.createPageError404(sectionElement);
      }
    );
  },
}