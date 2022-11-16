const categoriesList = {

  init: function() {

    console.log("categoriesList.init() appelé");
    this.bindAllCategoriesEvents();
  },

  // ---------------------------------------------------------
  // Binders
  // ---------------------------------------------------------

  bindAllCategoriesEvents: function() {
    //Select element <a id="nav-link-category-browse">
    const categoryBrowseLink = document.querySelector("#nav-link-category-browse");
    //Add event listener on click navigation
    categoryBrowseLink.addEventListener("click", categoriesList.handleLoadCategories());
  },

  // ---------------------------------------------------------
  // Handlers
  // ---------------------------------------------------------

  handleLoadCategories: function(){
    
    this.loadCategoriesFromAPI();
  },

  // ---------------------------------------------------------
  // DOM
  // ---------------------------------------------------------

  createDivCategory: function(name) {

    //Create div element <div class="category-browse-item">
    const divElement = document.createElement('div');
    divElement.classList.add('category-browse-item');

    //Create a element <a title="category" alt="category" class="category-browse-item-a">
    const linkElement = document.createElement('a');
    linkElement.setAttribute('title', 'category');
    linkElement.setAttribute('alt', 'category');
    linkElement.classList.add('category-browse-item-a');

    //Set text content with category name
    linkElement.textContent = name;
    //Add element <a> in element <div>
    divElement.append(linkElement);

    //Return html elements <div> <a> </div>
    return divElement;
  },

  insertDivCategoryIntoParent: function(divCategory) {

    //Select element <div id="category-browse-inner"> in DOM
    const parentElement = document.querySelector('#category-browse-inner');

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
          const categoryItem = categoriesList.createDivCategory(category.name);
          //Insert into DOM
          categoriesList.insertDivCategoryIntoParent(categoryItem);
        }
      }
    );
  
  },
  
}