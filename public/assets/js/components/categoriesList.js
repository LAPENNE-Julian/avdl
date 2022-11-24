const categoriesList = {

  init: function(pathName, pathNameFirst, pathNameSecond, pathNameThird) {

    console.log("categoriesList.init() appelé");

    if(pathName === "/category"){

      //If pathName of the url is '/category'
      categoriesList.bindAllCategories();
    }

    if(pathNameFirst == "category" && pathNameThird == "anecdote"){

      //If pathName of the url is '/category/[i:id]/anecdote'
      let categoryId = pathNameSecond;

      categoriesList.bindAllAnecdotes(categoryId);
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

    //Loaded All anecdotes of category id in the view
    anecdotesList.handleLoadAnecdotes(categoryId);
  },

  // ---------------------------------------------------------
  // Handlers
  // ---------------------------------------------------------

  handleLoadCategories: function(){
    
    //Get all categories from API
    categoriesList.loadCategoriesFromAPI();
  },

  // ---------------------------------------------------------
  // DOM
  // ---------------------------------------------------------

  createDivCategory: function(id, name, color) {

    //Create div element <div class="category-browse-item">
    const divElement = document.createElement("div");
    divElement.classList.add("category-browse-item");

    divElement.setAttribute("style", "border: thick solid" + color + ";");


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
    );
  },
}