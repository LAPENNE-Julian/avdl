const anecdote = {

  init: function() {

    console.log("anecdote.init() appelé");

    let pathName = window.location.pathname;

    let splitPathName = pathName.split("/");
    let pathNameFirst = splitPathName[1]; 
    let pathNameSecond = splitPathName[2];
    let pathNameThird = splitPathName[3];

    if(pathNameFirst === 'anecdote' && pathNameSecond !== undefined){

      anecdote.bindAnecdoteRead(pathNameSecond);
    }

  },

  // ---------------------------------------------------------
  // Binders
  // ---------------------------------------------------------

  bindAnecdoteRead: function(anecdoteId) {
    

    anecdote.handleLoadAnecdote(anecdoteId);
  },

  // ---------------------------------------------------------
  // Handlers
  // ---------------------------------------------------------

  handleLoadAnecdote: function(anecdoteId){

    anecdote.loadAnecdoteFromAPI(anecdoteId);
  },

  // ---------------------------------------------------------
  // DOM
  // ---------------------------------------------------------

  readAnecdote: function(id, title, content, source, createdAt, categoryId1, categoryName1, categoryColor1, categoryId2, categoryName2, categoryColor2, categoryId3, categoryName3, categoryColor3, userId, pseudo, upvote, downvote){

    //Select template element <template id="anecdote-read-template">
    const templateElement = document.querySelector("#anecdote-read-template");
    //clone element
    const templateCloneElement = templateElement.content.cloneNode(true);

    //Select template Clone to create anecdote element :
    const anecdoteReadElement = templateCloneElement.querySelector("#anecdote-read-inner");

    if(categoryId1 !== null){
      //Select span element <span class="label-category-1" style ="border: medium solid yellow">Catégorie</span>
      const categorySpan = anecdoteReadElement.querySelector('#label-category-1');
      categorySpan.setAttribute('style', 'border: medium solid ' + categoryColor1);

      //Select a element <a href="/category/id">
      const categoryLink = anecdoteReadElement.querySelector('#label-category-1 a');
      categoryLink.setAttribute('href', '/category/' + categoryId1 + '/anecdote');
      categoryLink.textContent = categoryName1;
    }

    if(categoryId2 !== null){
      //Select span element <span class="label-category-2" style ="border: medium solid yellow">Catégorie</span>
      const categorySpan2 = anecdoteReadElement.querySelector('#label-category-2');
      categorySpan2.setAttribute('style', 'border: medium solid ' + categoryColor2);

      //Select a element <a href="/category/id">
      const categoryLink2 = anecdoteReadElement.querySelector('#label-category-2 a');
      categoryLink2.setAttribute('href', '/category/' + categoryId2 + '/anecdote');
      categoryLink2.textContent = categoryName2;
    }

    if(categoryId3 !== null){
      //Select span element <span class="label-category-3" style ="border: medium solid yellow">Catégorie</span>
      const categorySpan3 = anecdoteReadElement.querySelector('#label-category-3');
      categorySpan3.setAttribute('style', 'border: medium solid ' + categoryColor3);

      //Select a element <a href="/category/id">
      const categoryLink3 = anecdoteReadElement.querySelector('#label-category-3 a');
      categoryLink3.setAttribute('href', '/category/' + categoryId3 + '/anecdote');
      categoryLink3.textContent = categoryName3;
    }
    
    //Select h1 element <h1>Titre de l'anecdote 1</h1>
    const anecdoteTitle = anecdoteReadElement.querySelector('h1');
    anecdoteTitle.textContent = title;

    //Select p element <p id="anecdote-author">
    const anecdotePublishing = anecdoteReadElement.querySelector('#anecdote-author');
    anecdotePublishing.textContent = 'Publié par ' + pseudo + ' le ' + createdAt;

    //Select <li> element with vote of anecdote
    const anecdoteVote = anecdoteReadElement.querySelector('#anecdote-read-vote');
    let vote = upvote - downvote;
    anecdoteVote.textContent = vote;

    //Select <p> element with content of anecdote
    const anecdoteContent = anecdoteReadElement.querySelector('#anecdote-read-content');
    anecdoteContent.textContent = content;

    //Select <a> element with link source anecdote
    const anecdoteLink = anecdoteReadElement.querySelector('#anecdote-source a');
    anecdoteLink.setAttribute('href', source);

    return anecdoteReadElement;
  },

  insertAnecdoteToRead: function(anecdoteItem) {

    //Select section element <section id="anecdote-read">
    const sectionElement = document.querySelector("#anecdote-read");
    
    sectionElement.prepend(anecdoteItem);
  },

  // ---------------------------------------------------------
  // AJAX
  // ---------------------------------------------------------

  loadAnecdoteFromAPI: function(anecdoteId) {

    const config = {
      method: "GET",
      mode: "cors",
      cache: "no-cache"
    };

    fetch(app.apiRootUrl + '/anecdote/' + anecdoteId, config)
    .then(
      function(response) {
        
        if(response.ok){

          //convert json response to object
          return response.json(); 

        } else {

          throw new Error('Network request failed with response ' + response.status + ': ' + response.statusText);

        }
      }
    )
    .then(
     function(object) {
       

        const anecdoteData = object.anecdote[0];

        //Create anecdote element browse
        let anecdoteItem = anecdote.readAnecdote(
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

          console.log(sectionElement);
          
          sectionElement.prepend(anecdoteItem);
    }
    )
    .catch(
      function(error) {
          console.log('Error');

      }
    );
  },
  
}