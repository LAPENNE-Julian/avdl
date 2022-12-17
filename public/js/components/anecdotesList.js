const anecdotesList = {

  init: function(pathName, pathNameFirst, pathNameSecond, pathNameThird) {

    console.log("anecdotesList.init() appelé");

    if(pathName === "/anecdote"){

      //If pathName of the url is "/anecdote"
      anecdotesList.bindAnecdotesFirstPage();

      //Get total anecdotes pages number
      anecdotesList.bindTotalPages();

      //Display arrow navigation in view
      anecdotesList.displayArrowNavigation();
    }

    if(pathName === "/anecdote/best"){

      //If pathName of the url is "/anecdote"
      anecdotesList.bindBestAnecdotes();

      //Select element in <div id="arrow-navigation">
      const arrowNavigation = document.querySelector("#arrow-navigation");
      //Remove navigation in the view
      arrowNavigation.remove();
    }

    if(pathNameFirst === "categorie" && pathNameThird === "anecdote"){

      //If pathName of the url is "/categorie/[i:id]/anecdote"
      let categoryId = pathNameSecond;

      //Select span element <span id="categoryId-browse-anecdotes">0</span>
      const spanElement = document.querySelector("#categoryId-browse-anecdotes");
      //Set span Element with categoryId in URL
      spanElement.textContent = categoryId;

      //categoriesList.bindAllAnecdotes(categoryId);
      categoriesList.bindAnecdotesCategoryFirstPage(categoryId);

      //Get total anecdotes pages number
      categoriesList.bindTotalPages(categoryId);

      //Display arrow navigation in view
      anecdotesList.displayArrowNavigation();
    }
  },

  // ---------------------------------------------------------
  // Binders
  // ---------------------------------------------------------
  
  bindAllAnecdotes: function() {

    //Set request option to get all anecdote
    let requestOption = "/anecdote";

    //Loaded All anecdotes in the view
    anecdotesList.handleLoadAnecdotes(requestOption);
  },

  bindAnecdotesFirstPage: function() {
    //Set request option to get first page anecdotes
    let requestOption = "/anecdote/page/0";

    //Loaded anecdotes first page in the view
    anecdotesList.handleLoadAnecdotes(requestOption);
  },

  bindBestAnecdotes: function() {

    //Loaded All anecdotes in the view
    anecdotesList.handleLoadBestAnecdotes();
  },

  bindTotalPages: function() {

    //Loaded total pages number
    anecdotesList.handleLoadTotalPagesNumber();
  },

  bindAnecdotesPrevious: function() {

    //Select arrow previous page in <div id="arrow-navigation">
    const arrowPrevious = document.querySelector("#anecdote-browse-previous");

    //Add event on click 
    arrowPrevious.addEventListener("click", anecdotesList.handleLoadAnecdotesPrevious);
  },

  bindAnecdotesNext: function() {

    //Select arrow next page in <div id="arrow-navigation">
    const arrowNext = document.querySelector("#anecdote-browse-next");

    //Add event on click 
    arrowNext.addEventListener("click", anecdotesList.handleLoadAnecdotesNext);
  },

  // ---------------------------------------------------------
  // Handlers
  // ---------------------------------------------------------

  handleLoadAnecdotes: function(requestOption){

    //Get all anecdotes from API
    anecdotesList.loadAnecdotesFromAPI(requestOption);
  },

  handleLoadBestAnecdotes: function(){
    
    //Set request option to get best anecdote
    let requestOption = "/anecdote/best";
    
    //Get all anecdotes from API
    anecdotesList.loadAnecdotesFromAPI(requestOption);
  },

  handleLoadTotalPagesNumber: function(){
    //Set request option ti get first page anecdotes
    let requestOption = "/anecdote/page";

    //Get page number
    anecdotesList.loadAnecdotesPageNumberFromAPI(requestOption);
  },

  handleLoadAnecdotesPrevious: function() {

    //Remove preceding anecdotes in page
    anecdotesList.removePrecedingAnecdotesItem();

    //Select span element  
    const spanElementCurrentPage = document.querySelector("#current-page");
    //Get page number in span element - current page = 0 (first page)
    let currentPage = spanElementCurrentPage.textContent;
    //Parse integer
    let currentPageNumber = parseInt(currentPage);
    
    //Decrement current page
    let pageNumber = currentPageNumber - 1;

    //Select span element <span id="categoryId-browse-anecdotes">0</span>
    const spanElementCategoryId = document.querySelector("#categoryId-browse-anecdotes");
    //Parse integer span element content
    let categoryId = parseInt(spanElementCategoryId.textContent);
    
    if(categoryId == 0){

      //Set request option to get next page
      let requestOption = "/anecdote/page/" + pageNumber;

      //Get all previous anecdotes from API
      anecdotesList.loadAnecdotesFromAPI(requestOption);

    } else {

      //Set request option to get next page
      let requestOption = "/category/" + categoryId + "/anecdote/page/" + pageNumber;

      //Get all previous anecdotes from API
      anecdotesList.loadAnecdotesFromAPI(requestOption);
    }
    
    //Set span element with new number page
    spanElement.textContent = pageNumber;

    //Check currentpage to display arrow navigation
    anecdotesList.displayArrowNavigation();
  },

  handleLoadAnecdotesNext: function() {

    //Remove preceding anecdotes in page
    anecdotesList.removePrecedingAnecdotesItem();

    //Select span element  
    const spanElement= document.querySelector("#current-page");
    //Get page number in span element - current page = 0 (first page)
    let currentPage = spanElement.textContent;
    //Parse integer
    let currentPageNumber = parseInt(currentPage);

    //Increment current page number
    let pageNumber = currentPageNumber + 1;

    //Select span element <span id="categoryId-browse-anecdotes">0</span>
    const spanElementCategoryId = document.querySelector("#categoryId-browse-anecdotes");
    //Parse integer span element content
    let categoryId = parseInt(spanElementCategoryId.textContent);

    if(categoryId == 0){

      //Set request option to get next page
      let requestOption = "/anecdote/page/" + pageNumber;

      //Get all previous anecdotes from API
      anecdotesList.loadAnecdotesFromAPI(requestOption);

    } else {

      //Set request option to get next page
      let requestOption = "/category/" + categoryId + "/anecdote/page/" + pageNumber;

      //Get all previous anecdotes from API
      anecdotesList.loadAnecdotesFromAPI(requestOption);
    }

    //Set span element with new number page
    spanElement.textContent = pageNumber;

    //Check currentpage to display arrow navigation
    anecdotesList.displayArrowNavigation();
  },

  // ---------------------------------------------------------
  // DOM
  // ---------------------------------------------------------

  createDivAnecdote: function(requestOption, id, title, description, categoryId1, categoryName1, categoryColor1, categoryId2, categoryName2, categoryColor2, categoryId3, categoryName3, categoryColor3, pseudo, createdAt) {

    //If request option === /anecdote/best
    if(requestOption === "/anecdote/best"){
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
      {"categoryId": categoryId1, "categoryName" : categoryName1, "categoryColor" : categoryColor1 },
      {"categoryId": categoryId2, "categoryName" : categoryName2, "categoryColor" : categoryColor2 },
      {"categoryId": categoryId3, "categoryName" : categoryName3, "categoryColor" : categoryColor3 },
    ]

    for (category of categoriesArray) {
      
      if(category.categoryName !== null){
        //Create span element <span class="label-category" style ="border: medium solid yellow">Catégorie</span>
        const categorySpan = document.createElement("span");
        categorySpan.classList.add("label-category");
        categorySpan.setAttribute("style", "border: medium solid " + category.categoryColor);
        
        //Create a element <a href="/category/id">
        const categoryLink = document.createElement("a");
        categoryLink.setAttribute("href", "/categorie/" + category.categoryId);
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

    //If request option === /anecdote/best
    if(requestOption !== "/anecdote/best" && requestOption !== "/anecdote"){
      anecdoteLink.setAttribute("href", "/categorie/" + categoryId1 + "/anecdote/" + id);
    }

    //If request option === /anecdote/best
    if(requestOption === "/anecdote/best"){
      anecdoteLink.setAttribute("href", "/anecdote/best/" + id);
    }

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

  removePrecedingAnecdotesItem: function(){

    //Select anecdotes item
    const anecdotes = document.querySelectorAll(".anecdote-browse-item");
    //Remove all next anecdotes
    for(const anecdote of anecdotes){
      //Remove anecdote
      anecdote.remove();
    }
  },

  displayArrowNavigation: function() {

    //Select span element current page
    const spanElementCurrentPage = document.querySelector("#current-page");
    //Get page number in span element - current page = 0 (first page)
    let currentPage = spanElementCurrentPage.textContent;
    //Parse integer
    let currentPageNumber = parseInt(currentPage);

    //Select span element total page 
    const spanElementTotalPage = document.querySelector("#total-page");
    //Get total page number in span element
    let totalPages = spanElementTotalPage.textContent;
    //Parse integer
    let totalPagesNumber = parseInt(totalPages);

    //Select arrow previous element in <div id="arrow-navigation">
    const arrowPrevious = document.querySelector("#anecdote-browse-previous");

    //Select arrow next page element in <div id="arrow-navigation">
    const arrowNext = document.querySelector("#anecdote-browse-next");

    //--->Check if the curent page is the first page
    if(currentPageNumber == 0){

      //Display arrow previous in the view
      arrowPrevious.setAttribute("style", "display: none;");

    } else {

      //Display arrow previous in the view
      arrowPrevious.setAttribute("style", "display: inline-block;");

      //Add event on arrow previous
      anecdotesList.bindAnecdotesPrevious();
    }

    //--->Check if current is the last page
    if(currentPageNumber == totalPagesNumber){

      //Display none arrow next in the view
      arrowNext.setAttribute("style", "display: none;");

    } else {

      //Display none arrow next in the view
      arrowNext.setAttribute("style", "display: inline-block;");

      //Add event on arrow next
      anecdotesList.bindAnecdotesNext();
    }
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

  loadAnecdotesPageNumberFromAPI: function(requestOption) {

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

        //Select span element <span id="total-page"></span>
        const spanElement = document.querySelector("#total-page");
        //Set span element wtih number of page
        spanElement.textContent = object.totalPages;

        if(object.totalPages == 0){
          //Select arrow next page element in <div id="arrow-navigation">
          const arrowNext = document.querySelector("#anecdote-browse-next");
          //Display none arrow next in the view
          arrowNext.setAttribute("style", "display: none;");
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