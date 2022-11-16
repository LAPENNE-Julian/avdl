const app = {

  apiRootUrl: "http://localhost:8080/api",

  init: function() {
    console.log("app.init() appelé");
    categoriesList.init();
  }

};

//Call app.init when DOM loaded
document.addEventListener("DOMContentLoaded", app.init);