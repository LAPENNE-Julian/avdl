const app = {

  rootUrl: window.location.origin,
  apiRootUrl: window.location.origin + "/api",
  pathName: window.location.pathname,

  init: function() {

    console.log("app.init() appelé");
    let splitPathName = app.pathName.split("/");

    categoriesList.init(app.pathName, splitPathName[1], splitPathName[2], splitPathName[3]);
    anecdotesList.init(app.pathName);
    anecdote.init(app.pathName, splitPathName[1], splitPathName[2], splitPathName[3]);

    app.bindScriptLoad();
  },

  // ---------------------------------------------------------
  // Binders
  // ---------------------------------------------------------

  bindScriptLoad: function() {

    //Remove script error message
    app.handleRemoveScriptLoad();
  },

  // ---------------------------------------------------------
  // Handlers
  // ---------------------------------------------------------

  handleRemoveScriptLoad: function(){
    
    //Select pragraph error
    const scriptErrorMessage = document.querySelector("#script-error-message");
    
    if(scriptErrorMessage !== null || scriptErrorMessage !== undefined){

      //Remove script error message from the page
      scriptErrorMessage.remove();
    }
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

  createTooltips: function(title, parentElement, pointerElement){
    
    //Select preceding bubble 
    const precedingBubble = document.querySelector(".bubble");

    if(precedingBubble !== null){
      //if exist remove
      precedingBubble.remove();
    }

    //Create element <div class="bubble">
    const divBubble = document.createElement("div");
    //Set attribute 
    divBubble.classList.add("bubble");

    //Create element <div class="bubble-text">
    const divBubbleText = document.createElement("div");
    //Set attribute 
    divBubbleText.classList.add("bubble-text");

    //Insert divBubbleText in divBubble
    divBubble.append(divBubbleText);

    //Create h1 element
    const headerBubble = document.createElement("h1");
    //Set attribute
    headerBubble.setAttribute("style", "font-size: 120%; text-align: center;");
    //Set header
    headerBubble.textContent = title;
    //Insert header in divBubbleText
    divBubbleText.append(headerBubble);

    //Create hr element
    const hr = document.createElement("hr");
    //Insert hr in divBubbleText
    divBubbleText.append(hr);

    //Create hr element
    const paragraph = document.createElement("p");
    //Set attribute
    paragraph.setAttribute("style", "font-size: 120%; text-align: center;");
    //Set content of paragh
    paragraph.textContent = "Bientôt disponible";
    //Insert paragraph in divBubbleText
    divBubbleText.append(paragraph);

    //Insert div bubble in parentElement
    parentElement.prepend(divBubble);

    //Remove tooltips after 1 secondes
    setTimeout(app.removeTooltips, 1500, pointerElement);
  },

  removeTooltips: function(pointerElement) {

    //Select element bubble
    const bubble = document.querySelector(".bubble");
    //Remove
    bubble.remove();

    //Remove class "pointer"
    pointerElement.classList.remove("pointer");
  },

};

//Call app.init when DOM loaded
document.addEventListener("DOMContentLoaded", app.init);