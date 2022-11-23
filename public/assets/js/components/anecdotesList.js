const anecdotesList = {

  init: function(pathName) {

    console.log("anecdotesList.init() appelé");

    if(pathName === "/anecdote"){

      anecdotesList.bindAllAnecdotes(pathName);
    }

    const homeElement = document.querySelector("#home");

    if(homeElement !== null || homeElement !== undefined){

      anecdotesList.bindCarouselAnecdotes();
    }
  },

  // ---------------------------------------------------------
  // Binders
  // ---------------------------------------------------------

  bindAllAnecdotes: function(pathName) {

    //If pathName of the url is '/anecdote' => loaded All anecdotes in the view
    anecdotesList.handleLoadAnecdotes(pathName);
  },

  bindCarouselAnecdotes: function() {

    //If pathName of the url is '/anecdote' => loaded All anecdotes in the view
    anecdotesList.handleLoadCarouselAnecdotes();
  },

  // ---------------------------------------------------------
  // Handlers
  // ---------------------------------------------------------

  handleLoadAnecdotes: function(request){
    
    anecdotesList.loadAnecdotesFromAPI(request);
  },

  handleLoadCarouselAnecdotes: function(){
    
    //anecdotesList.loadAnecdotesFromAPI("/best");

    let request = "/anecdote/latest";

    anecdotesList.loadCarouselAnecdotesFromAPI(request);
  },

  // ---------------------------------------------------------
  // DOM
  // ---------------------------------------------------------

  createDivAnecdote: function(id, title, description, categoryId1, categoryName1, categoryColor1, categoryId2, categoryName2, categoryColor2, categoryId3, categoryName3, categoryColor3, pseudo, createdAt) {

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
    anecdotePublishing.textContent = "Publié par " + pseudo + " le " + createdAt;

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

  createCarousel: function(id, title, description, categoryId1, categoryName1, categoryColor1, categoryId2, categoryName2, categoryColor2, categoryId3, categoryName3, categoryColor3, userId, pseudo, createdAt){

    //Select template element <template id="carousel-lates-item">
    const templateElement = document.querySelector("#carousel-latest-item");
    //clone element
    const templateCloneElement = templateElement.content.cloneNode(true);

    //Select template Clone to create carousel-item element :
    const carouselItem = templateCloneElement.querySelector("#carousel-item");

    if(categoryId1 !== null){
      //Select span element <span id="label-category-1">Catégorie</span>
      const categorySpan = carouselItem.querySelector("#label-category-1");
      categorySpan.setAttribute("style", "border: medium solid " + categoryColor1);

      //Select a element <a href="/category/id">
      const categoryLink = carouselItem.querySelector("#label-category-1 a");
      categoryLink.setAttribute("href", "/category/" + categoryId1 + "/anecdote");
      categoryLink.textContent = categoryName1;
    }

    if(categoryId2 !== null){
      //Select span element <span class="label-category-2">Catégorie</span>
      const categorySpan2 = carouselItem.querySelector("#label-category-2");
      categorySpan2.setAttribute("style", "border: medium solid " + categoryColor2);

      //Select a element <a href="/category/id">
      const categoryLink2 = carouselItem.querySelector("#label-category-2 a");
      categoryLink2.setAttribute("href", "/category/" + categoryId2 + "/anecdote");
      categoryLink2.textContent = categoryName2;
    }

    if(categoryId3 !== null){
      //Select span element <span class="label-category-3">Catégorie</span>
      const categorySpan3 = carouselItem.querySelector("#label-category-3");
      categorySpan3.setAttribute("style", "border: medium solid " + categoryColor3);

      //Select a element <a href="/category/id">
      const categoryLink3 = carouselItem.querySelector("#label-category-3 a");
      categoryLink3.setAttribute("href", "/category/" + categoryId3 + "/anecdote");
      categoryLink3.textContent = categoryName3;
    }
    
    //Select h1 element <h3>Titre de l'anecdote 1</h3>
    const anecdoteTitle = carouselItem.querySelector("h3");
    anecdoteTitle.textContent = title;

    //Select <p> element with description of anecdote
    const anecdoteDescription = carouselItem.querySelector("#carousel-latest-item-description");
    anecdoteDescription.textContent = description;

    //Select p element <p id="author">
    const anecdotePublishing = carouselItem.querySelector("#author");
    anecdotePublishing.textContent = "Publié par " + pseudo + " le " + createdAt;

    return carouselItem;
  },

  insertCarouselItemIntoParent: function(anecdoteItem) {

    //Select div element <div id="carousel-latest-anecdote">
    const carouselElement = document.querySelector("#carousel-latest-inner");
    //Insert anecdote item in section element
    carouselElement.append(anecdoteItem);
  },

  // ---------------------------------------------------------
  // AJAX
  // ---------------------------------------------------------

  loadAnecdotesFromAPI: function(request) {

    const config = {
      method: "GET",
      mode: "cors",
      cache: "no-cache"
    };

    fetch(app.apiRootUrl + request, config)
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
        app.error404(sectionElement);
      }
    );
  },

  loadCarouselAnecdotesFromAPI: function(request) {

    const config = {
      method: "GET",
      mode: "cors",
      cache: "no-cache"
    };

    fetch(app.apiRootUrl + request, config)
    .then(
      function(response) {
        //convert json response to object
        return response.json(); 
      }
    )
    .then(
      function(object) {

        console.log(object);

        for(const anecdoteData of object.anecdotes){

          //Create carousel anecdote element browse
          const anecdoteItem = anecdotesList.createCarousel(
            anecdoteData.id,
            anecdoteData.title, 
            anecdoteData.description, 
            anecdoteData.category_1, anecdoteData.categoryName1, anecdoteData.categoryColor1, 
            anecdoteData.category_2, anecdoteData.categoryName2, anecdoteData.categoryColor2,
            anecdoteData.category_3, anecdoteData.categoryName3, anecdoteData.categoryColor3,
            anecdoteData.userId,
            anecdoteData.pseudo, 
            anecdoteData.created_at);

          //Insert into DOM
          anecdotesList.insertCarouselItemIntoParent(anecdoteItem);
        }

        //Select first carouselItem
        const carouselItem = document.querySelector("#carousel-item");

        carouselItem.classList.add("active");
        
        
      }
    )
    .catch(
      function(error) {

        console.log(error);
      }
    );
  },
}