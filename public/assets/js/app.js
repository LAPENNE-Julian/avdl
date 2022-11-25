const app = {

  rootUrl: window.location.origin,
  apiRootUrl: window.location.origin + "/api",
  pathName: window.location.pathname,

  init: function() {
    console.log("app.init() appelé");

    let splitPathName = app.pathName.split("/");

    let pathNameFirst = splitPathName[1]; 
    let pathNameSecond = splitPathName[2];
    let pathNameThird = splitPathName[3];

    categoriesList.init(app.pathName, pathNameFirst, pathNameSecond, pathNameThird);
    anecdotesList.init(app.pathName);
    anecdote.init(app.pathName, pathNameFirst, pathNameSecond, pathNameThird);
  },

  // ---------------------------------------------------------
  // DOM
  // ---------------------------------------------------------

  createPageError404 : function(sectionElement){

    if(sectionElement !== null) {
      //Set section attribut => <section id="error404" class="container-fluid errorPage">
      sectionElement.setAttribute("id", "error404");
      sectionElement.setAttribute("class", "container-fluid errorPage");

      //Create div element <div id="error404-inner">
      const divErrorInner = document.createElement("div");
      divErrorInner.setAttribute("id", "error404-inner");
      //Insert div error404-Inner in section element
      sectionElement.prepend(divErrorInner);

      //Create h1 element <h1>Oups !</h1>
      const header = document.createElement("h1");
      header.textContent = "Oups !";
      //Insert h1 element in div element
      divErrorInner.prepend(header);

      //Create div element <div id="error404-item-content">
      const divErrorItemContent = document.createElement("div");
      divErrorItemContent.setAttribute("id", "error404-item-content");
      //Insert div error404-item-content in div error404-inner
      divErrorInner.append(divErrorItemContent);

      //Create img element
      const img = document.createElement("img");
      img.setAttribute("src", app.rootUrl + "/assets/css/images/404.jpg");
      img.setAttribute("alt", "404.jpg");
      //Insert img element in div element <div id="error404-item-content">
      divErrorItemContent.prepend(img);

      //Create div element <div id="error404-item-data">
      const divErrorItemData = document.createElement("div");
      divErrorItemData.setAttribute("id", "error404-item-data");
      //Insert div error404-item-data in div error404-item-content
      divErrorItemContent.append(divErrorItemData);

      //Create first p element
      const paragrahFirst = document.createElement("p");
      paragrahFirst.textContent = "La page que vous recherchez semble introuvable.";
      //insert p element in div error404-item-data
      divErrorItemData.prepend(paragrahFirst);

      //Create second p element
      const paragrahSecond = document.createElement("p");
      paragrahSecond.textContent = "Code erreur : "
      //Insert second p element in div error404-item-data
      divErrorItemData.append(paragrahSecond);

      //Create span element <span class="label-bold">404</span>"
      const spanElement = document.createElement("span");
      spanElement.setAttribute("class", "label-bold");
      spanElement.textContent = "404";
      //Insert span element in paragraphSecond
      paragrahSecond.append(spanElement);

      //Create third p element
      const paragrahThird = document.createElement("p");
      //Insert third p element in div error404-item-data
      divErrorItemData.append(paragrahThird);

      //Create a element
      const paragrahThirdLink = document.createElement("a");
      paragrahThirdLink.setAttribute("href", "/");
      paragrahThirdLink.textContent = "Retourner a la page d'Acceuil";
      //Insert a element in paragrahThird
      paragrahThird.prepend(paragrahThirdLink);

      return sectionElement;
    }
  },

};

//Call app.init when DOM loaded
document.addEventListener("DOMContentLoaded", app.init);