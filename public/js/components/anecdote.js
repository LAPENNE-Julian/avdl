const anecdote = {

  init: function(pathName, pathNameFirst, pathNameSecond, pathNameThird) {

    console.log("anecdote.init() appelé");

    if(pathNameFirst === "anecdote" && pathNameSecond !== undefined && pathNameSecond !== "random"
    && pathNameSecond !== "best"){

      //If pathName of the url is "/anecdote/[i:id]""
      let anecdoteId = pathNameSecond;

      //Get anecdote
      anecdote.bindAnecdoteRead(anecdoteId);

      //Add event in navigation
      anecdote.bindAnecdoteNavigation();

    }

    if(pathNameFirst === "anecdote" && pathNameSecond === "best" && pathNameThird !== undefined){

      //If pathName of the url is "/anecdote/best/[i:id]""
      let anecdoteId = pathNameThird;

      //Get anecdote
      anecdote.bindAnecdoteRead(anecdoteId);

      //Add event in navigation
      anecdote.bindAnecdoteNavigation();
    }

    if(pathName === "/anecdote/random"){

      //If pathName of the url is "/anecdote/random"
      anecdote.bindAnecdoteReadRandom();

      //Select element in <div id="arrow-navigation">
      const arrowNavigation = document.querySelector("#arrow-navigation");
      //Remove navigation in the view
      arrowNavigation.remove();
    }
  },

  // ---------------------------------------------------------
  // Binders
  // ---------------------------------------------------------

  bindAnecdoteRead: function(anecdoteId) {

    //Loaded anecdote in the view
    anecdote.handleLoadAnecdote(anecdoteId);
  },

  bindAnecdoteReadTooltips: function(anecdoteReadElement){
    
    //Select <li> element with upvote of anecdote
    const upvote = anecdoteReadElement.querySelector("#anecdote-read-upvote");
    //Add event
    upvote.addEventListener("click", anecdote.handleAnecdoteReadTooltipsVote);

    //Select <li> element with downvote of anecdote
    const downvote = anecdoteReadElement.querySelector("#anecdote-read-downvote");
    //Add event
    downvote.addEventListener("click", anecdote.handleAnecdoteReadTooltipsVote);

    //Select <li> element with knownvote of anecdote
    const knownvote = anecdoteReadElement.querySelector("#anecdote-read-known");
    //Add event
    knownvote.addEventListener("click", anecdote.handleAnecdoteReadTooltipsKnown);

    //Select <li> element with downknownvote of anecdote
    const unknownvote = anecdoteReadElement.querySelector("#anecdote-read-unknown");
    //Add event
    unknownvote.addEventListener("click", anecdote.handleAnecdoteReadTooltipsUnknown);
  },

  bindAnecdoteNavigation(){

    //Select arrow previous page in <div id="arrow-navigation">
    const arrowPrevious = document.querySelector("#anecdote-read-previous");

    //Add event on click 
    arrowPrevious.addEventListener("click", anecdote.handleLoadAnecdotePrevious);
    
    //Select arrow next page in <div id="arrow-navigation">
    const arrowNext = document.querySelector("#anecdote-read-next");

    //Add event on click
    arrowNext.addEventListener("click", anecdote.handleLoadAnecdoteNext);
  },

  bindAnecdoteReadRandom: function() {

    //Loaded anecdote in the view
    anecdote.handleLoadAnecdoteRandom();
  },

  // ---------------------------------------------------------
  // Handlers
  // ---------------------------------------------------------

  handleLoadAnecdote: function(anecdoteId){

    //Get anecdote by Id from API
    anecdote.loadAnecdoteFromAPI(anecdoteId);
  },

  handleAnecdoteReadTooltipsVote: function (){

    //Set position relative for ancestor element
    let pointerElement = document.querySelector("#anecdote-read-li-upvote");
    pointerElement.classList.add("pointer");

    //Select tooltips parent element
    const parentElement = document.querySelector("#anecdote-read-li-upvote");

    //Set title
    let bubbleTitle = "Vote";

    //Create tooltips and set position
    app.createTooltips(bubbleTitle, parentElement, pointerElement);
  },

  handleAnecdoteReadTooltipsKnown: function (){

    /*let pointerElement = document.querySelector("#anecdote-notice");*/
    let pointerElement = document.querySelector("#anecdote-read-li-known");
    pointerElement.classList.add("pointer");

    //Select section element
    const parentElement = document.querySelector("#anecdote-read-known");

    //Set title
    let bubbleTitle = "Avis";

    //Get tooltips, set message
    app.createTooltips(bubbleTitle, parentElement, pointerElement);
  },

  handleAnecdoteReadTooltipsUnknown: function (){

    let pointerElement = document.querySelector("#anecdote-read-li-unknown");
    pointerElement.classList.add("pointer");

    //Select section element
    const parentElement = document.querySelector("#anecdote-read-unknown");

    //Set title
    let bubbleTitle = "Avis";

    //Get tooltips, set message
    app.createTooltips(bubbleTitle, parentElement, pointerElement);
  },

  handleLoadAnecdotePrevious: function() {

    //Select span element <span id="current-anecdoteId"></span>
    const spanAnecdoteId = document.querySelector("#current-anecdoteId");
    //Select anecdoteId in template
    let anecdoteId = spanAnecdoteId.textContent;

    //Select span element <span id="current-theme"></span>
    const spanCurrentTheme = document.querySelector("#current-theme");
    //Select anecdote theme in template
    let theme = spanCurrentTheme.textContent;

    if(theme === "best"){
      //Set request option to get previous best anecdote
      let requestOption = theme + "/" + anecdoteId + "/prev";

      //Get next best anecdote by requestOption from API
      anecdote.loadAnecdoteNavigationFromAPI(requestOption);

    } else {

      //Set request option to get previous anecdote
      let requestOption = anecdoteId + "/prev";

      //Get previous anecdote by requestOption from API
      anecdote.loadAnecdoteNavigationFromAPI(requestOption);
    }
  },

  handleLoadAnecdoteNext: function(request) {

    //Select span element <span id="current-anecdoteId"></span>
    const spanAnecdoteId = document.querySelector("#current-anecdoteId");
    //Select anecdoteId in template
    let anecdoteId = spanAnecdoteId.textContent;

    //Select span element <span id="current-theme"></span>
    const spanCurrentTheme = document.querySelector("#current-theme");
    //Select anecdote theme in template
    let theme = spanCurrentTheme.textContent;

    if(theme === "best"){
      //Set request option to get next best anecdote
      let requestOption = theme + "/" + anecdoteId + "/next";

      //Get next best anecdote by requestOption from API
      anecdote.loadAnecdoteNavigationFromAPI(requestOption);

    } else {

      //Set request option to get  next anecdote
      let requestOption = anecdoteId + "/next";

      //Get next anecdote by requestOption from API
      anecdote.loadAnecdoteNavigationFromAPI(requestOption);
    }
  },

  handleLoadAnecdoteRandom: function(){

    //Set request option to get random anecdote
    let requestOption = "random";

    //Get anecdote by requestOption from API
    anecdote.loadAnecdoteFromAPI(requestOption);
  },

  // ---------------------------------------------------------
  // DOM
  // ---------------------------------------------------------

  readAnecdote: function(theme, id, title, content, source, createdAt, categoryId1, categoryName1, categoryColor1, categoryId2, categoryName2, categoryColor2, categoryId3, categoryName3, categoryColor3, userId, pseudo, upvote, downvote){

    //Select template element <template id="anecdote-read-template">
    const templateElement = document.querySelector("#anecdote-read-template");
    //clone element
    const templateCloneElement = templateElement.content.cloneNode(true);

    //Select template Clone to create anecdote element :
    const anecdoteReadElement = templateCloneElement.querySelector("#anecdote-read-inner");

    if(categoryId1 !== null){
      //Select span element <span class="label-category-1" style ="border: medium solid yellow">Catégorie</span>
      const categorySpan = anecdoteReadElement.querySelector("#label-category-1");
      categorySpan.setAttribute("style", "border: medium solid " + categoryColor1);

      //Select a element <a href="/category/id">
      const categoryLink = anecdoteReadElement.querySelector("#label-category-1 a");
      categoryLink.setAttribute("href", "/categorie/" + categoryId1);
      categoryLink.textContent = categoryName1;
    }

    if(categoryId2 !== null){
      //Select span element <span class="label-category-2" style ="border: medium solid yellow">Catégorie</span>
      const categorySpan2 = anecdoteReadElement.querySelector("#label-category-2");
      categorySpan2.setAttribute("style", "border: medium solid " + categoryColor2);

      //Select a element <a href="/category/id">
      const categoryLink2 = anecdoteReadElement.querySelector("#label-category-2 a");
      categoryLink2.setAttribute("href", "/categorie/" + categoryId2);
      categoryLink2.textContent = categoryName2;
    }

    if(categoryId3 !== null){
      //Select span element <span class="label-category-3" style ="border: medium solid yellow">Catégorie</span>
      const categorySpan3 = anecdoteReadElement.querySelector("#label-category-3");
      categorySpan3.setAttribute("style", "border: medium solid " + categoryColor3);

      //Select a element <a href="/category/id">
      const categoryLink3 = anecdoteReadElement.querySelector("#label-category-3 a");
      categoryLink3.setAttribute("href", "/categorie/" + categoryId3);
      categoryLink3.textContent = categoryName3;
    }
    
    //Select h1 element <h1>Titre de l'anecdote 1</h1>
    const anecdoteTitle = anecdoteReadElement.querySelector("h1");
    anecdoteTitle.textContent = title;

    //Select span element <span id="current-anecdoteId"></span>
    const spanAnecdoteId = anecdoteReadElement.querySelector("#current-anecdoteId");
    spanAnecdoteId.textContent = id;

    //Select span element <span id="current-theme"></span>
    const spanCurrentTheme = anecdoteReadElement.querySelector("#current-theme");

    if(theme === "best"){
      spanCurrentTheme.textContent = theme;

    } else {
      spanCurrentTheme.textContent = "anecdote";
    }
    
    //Select p element <p id="anecdote-author">
    const anecdotePublishing = anecdoteReadElement.querySelector("#anecdote-author");
    //Represent Date
    const date = new Date(createdAt);
    //Set author and date format
    anecdotePublishing.textContent = "Publié par " + pseudo + " le " + date.toLocaleDateString("fr");

    //Add tooltips event
    anecdote.bindAnecdoteReadTooltips(anecdoteReadElement);

    //Select <li> element with vote of anecdote
    const anecdoteVote = anecdoteReadElement.querySelector("#anecdote-read-vote");
    let vote = upvote - downvote;
    anecdoteVote.textContent = vote;

    //Select <p> element with content of anecdote
    const anecdoteContent = anecdoteReadElement.querySelector("#anecdote-read-content");
    anecdoteContent.textContent = content;

    //Select <a> element with link source anecdote
    const anecdoteLink = anecdoteReadElement.querySelector("#anecdote-source a");
    anecdoteLink.setAttribute("href", source);

    return anecdoteReadElement;
  },

  removePrecedingAnecdoteItem: function(){

    //Select anecdote item
    const anecdote = document.querySelector("#anecdote-read-inner");

    if(anecdote !== null) {
      //Remove anecdote
      anecdote.remove();
    }
  },

  // ---------------------------------------------------------
  // AJAX
  // ---------------------------------------------------------

  loadAnecdoteFromAPI: function(requestOption) {

    const config = {
      method: "GET",
      mode: "cors",
      cache: "no-cache"
    };

    fetch(app.apiRootUrl + "/anecdote/" + requestOption, config)
    .then(
      function(response) {
        
        if(response.ok){

          //convert json response to object
          return response.json(); 

        } else {

          throw new Error("Network request failed with response " + response.status + ": " + response.statusText);

        }
      }
    )
    .then(
      function(object) {

        let pathName = window.location.pathname;
        let request = pathName.split("/");
      
        let theme = request[2];

        const anecdoteData = object.anecdote[0];

        //Create anecdote element browse
        let anecdoteItem = anecdote.readAnecdote(
          theme,
          anecdoteData.id,
          anecdoteData.title, 
          anecdoteData.content,
          anecdoteData.source,
          anecdoteData.created_at,
          anecdoteData.category_1, anecdoteData.categoryName1, anecdoteData.categoryColor1, 
          anecdoteData.category_2, anecdoteData.categoryName2, anecdoteData.categoryColor2,
          anecdoteData.category_3, anecdoteData.categoryName3, anecdoteData.categoryColor3,
          anecdoteData.userId,
          anecdoteData.pseudo, 
          anecdoteData.upvote,
          anecdoteData.downvote);

          //Select section element <section id="anecdote-read">
          const sectionElement = document.querySelector("#anecdote-read");
          //Insert anecdote item in section element
          sectionElement.prepend(anecdoteItem);
      }
    )
    .catch(
      function(error) {

        console.log(error);

        //Remove preceding anecdote in view
        anecdote.removePrecedingAnecdoteItem();

        //Select element in <div id="arrow-navigation">
        const arrowNavigation = document.querySelector("#arrow-navigation");
        //Remove navigation in the view
        arrowNavigation.remove();

        //Select section element <section id="anecdote-read">
        const sectionElement = document.querySelector("#anecdote-read");

        //Post error 404 view in section element
        app.createPageError404(sectionElement);
      }
    );
  },

  loadAnecdoteNavigationFromAPI: function(requestOption) {

    const config = {
      method: "GET",
      mode: "cors",
      cache: "no-cache"
    };

    fetch(app.apiRootUrl + "/anecdote/" + requestOption, config)
    .then(
      function(response) {
        
        if(response.ok){

          //convert json response to object
          return response.json(); 

        } else {

          throw new Error("Network request failed with response " + response.status + ": " + response.statusText);

        }
      }
    )
    .then(
      function(object) {

        const anecdoteData = object.anecdote[0];

        //GET Url
        let splitPathName = app.pathName.split("/");
        let pathNameFirst = splitPathName[1]; 
        let pathNameSecond = splitPathName[2];
  
        if(pathNameFirst === "anecdote" && pathNameSecond === "best"){

            //Set new anecdoteId in url
            urlOption = "/anecdote/best/" + anecdoteData.id;
            //Redirection
            location.assign(app.rootUrl + urlOption);

        } else {

          //Set new anecdoteId in url
          urlOption = "/anecdote/" + anecdoteData.id;
          //Redirection
          location.assign(app.rootUrl + urlOption);
        }
      }
    )
    .catch(
      function(error) {

        console.log(error);

        //Remove preceding anecdote in view
        anecdote.removePrecedingAnecdoteItem();

        //Select element in <div id="arrow-navigation">
        const arrowNavigation = document.querySelector("#arrow-navigation");
        //Remove navigation in the view
        arrowNavigation.remove();

        //Select section element <section id="anecdote-read">
        const sectionElement = document.querySelector("#anecdote-read");

        //Post error 404 view in section element
        app.createPageError404(sectionElement);
      }
    );
  },
}