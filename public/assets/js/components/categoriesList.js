const categoriesList = {

  init: function(pathName, pathNameFirst, pathNameSecond, pathNameThird) {

    console.log("categoriesList.init() appelé");

    // let pathName = window.location.pathname;

    // let splitPathName = pathName.split("/");
    // let pathNameFirst = splitPathName[1]; 
    // let pathNameSecond= splitPathName[2];
    // let pathNameThird = splitPathName[3];

    if(pathName === "/category"){

      categoriesList.bindAllCategories();
    }

    if(pathNameFirst == "category" && pathNameThird == "anecdote"){

      categoriesList.bindAllAnecdotes(pathName);
    }
  },

  // ---------------------------------------------------------
  // Binders
  // ---------------------------------------------------------

  bindAllCategories: function() {

    //If pathName of the url is '/category' => loaded All categories in the view
    categoriesList.handleLoadCategories();
  },

  bindAllAnecdotes: function(pathName) {

    //If pathName of the url is '/category/[i:id]/anecdote' => loaded All anecdotes of category id in the view
    anecdotesList.handleLoadAnecdotes(pathName);
  },

  // ---------------------------------------------------------
  // Handlers
  // ---------------------------------------------------------

  handleLoadCategories: function(){
    
    categoriesList.loadCategoriesFromAPI();
  },

  // ---------------------------------------------------------
  // DOM
  // ---------------------------------------------------------

  createDivCategory: function(id, name) {

    //Create div element <div class="category-browse-item">
    const divElement = document.createElement("div");
    divElement.classList.add("category-browse-item");

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

    if(parentElement !== null){
      
      //Add divCategory in parentElement
      parentElement.append(divCategory);
    }
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
          const categoryItem = categoriesList.createDivCategory(category.id, category.name);
          //Insert into DOM
          categoriesList.insertDivCategoryIntoParent(categoryItem);
        }
      }
    );
  },
}