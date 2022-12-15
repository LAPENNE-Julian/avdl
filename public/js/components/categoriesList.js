const categoriesList = {

  init: function(pathName, pathNameFirst, pathNameSecond, pathNameThird) {

    console.log("categoriesList.init() appelé");

    if(pathName === "/category"){

      //If pathName of the url is "/category"
      categoriesList.bindAllCategories();
    }

    if(pathNameFirst === "category" && pathNameThird === "anecdote"){

      //If pathName of the url is "/category/[i:id]/anecdote"
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

  bindAllCategories: function() {

    //Loaded All categories in the view
    categoriesList.handleLoadCategories();
  },

  bindAllAnecdotes: function(categoryId) {

    //Set request option to get anecdote by categoryId
    let requestOption = "/category/" + categoryId + "/anecdote";

    //Loaded All anecdotes of category id in the view
    categoriesList.handleLoadCategoryAnecdotes(requestOption);
  },

  bindAnecdotesCategoryFirstPage: function(categoryId) {
    //Set request option to get first page anecdotes
    let requestOption = "/category/" + categoryId + "/anecdote/page/0";

    //Loaded anecdotes first page in the view
    anecdotesList.handleLoadAnecdotes(requestOption);
  },

  bindTotalPages: function(categoryId) {

    //Loaded total pages number
    categoriesList.handleLoadTotalPagesNumber(categoryId);
  },

  // ---------------------------------------------------------
  // Handlers
  // ---------------------------------------------------------

  handleLoadCategories: function(){
    
    //Get all categories from API
    categoriesList.loadCategoriesFromAPI();
  },

  handleLoadCategoryAnecdotes: function(requestOption){
    
    //Get all anecdotes from API
    anecdotesList.loadAnecdotesFromAPI(requestOption);
  },

  handleLoadTotalPagesNumber: function(categoryId){
    //Set request option ti get first page anecdotes
    let requestOption = "/category/" + categoryId + "/anecdote/page";

    //Get page number
    anecdotesList.loadAnecdotesPageNumberFromAPI(requestOption);
  },

  // ---------------------------------------------------------
  // DOM
  // ---------------------------------------------------------

  createDivCategory: function(id, name, color) {

    //Create div element <div class="category-browse-item">
    const divElement = document.createElement("div");
    divElement.classList.add("category-browse-item");

    divElement.setAttribute("style", "border: thick solid " + color + ";");


    //Create a element <a title="category" alt="category" class="category-browse-item-a">
    const linkElement = document.createElement("a");
    linkElement.setAttribute("title", "category");
    linkElement.setAttribute("alt", "category");
    linkElement.setAttribute("href", "/category/" + id + "/anecdote");
    linkElement.classList.add("category-browse-item-a");

    //Set text content with category name
    linkElement.textContent = name;
    //Add element <a> in element <div>
    divElement.append(linkElement);

    //Return html elements <div> <a> </div>
    return divElement;
  },

  insertDivCategoryIntoParent: function(divCategory) {

    //Select element <div id="category-browse-inner"> in DOM
    const parentElement = document.querySelector("#category-browse-inner");

    //Add divCategory in parentElement
    parentElement.append(divCategory);
  },

  // ---------------------------------------------------------
  // AJAX
  // ---------------------------------------------------------

  loadCategoriesFromAPI: function() {

    const config = {
      method: "GET",
      mode: "cors",
      cache: "no-cache"
    };

    fetch(app.apiRootUrl + "/category", config)
    .then(
      function(response) {
        //convert json response to object
        return response.json(); 
      }
    )
    .then(
      function(object) {

        for(const category of object.categories){

          //Create category element browse
          const categoryItem = categoriesList.createDivCategory(category.id, category.name, category.color);
          //Insert into DOM
          categoriesList.insertDivCategoryIntoParent(categoryItem);
        }
      }
    )
    .catch(
      function(error) {

        console.log(error);

        //Select section element <section>
        const sectionElement = document.querySelector("#category-browse");

        //Select h1 in section element
        const header1 = document.querySelector("#category-browse h1");
        //delete h1 element
        header1.remove();

        //Post error 404 view in section element
        app.createPageError404(sectionElement);
      }
    );
  },
}