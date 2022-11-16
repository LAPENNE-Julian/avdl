const categoriesList = {

    init: function() {
      console.log("categoriesList.init() appelé");

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

    //Select element <div id="category-browse-item"> in DOM
    const parentElement = document.querySelector('#category-browse-inner');

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