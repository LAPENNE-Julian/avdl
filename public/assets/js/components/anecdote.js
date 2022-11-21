const anecdote = {

  init: function() {

    console.log("anecdote.init() appelé");
    anecdote.bindAnecdoteRead();

  },

  // ---------------------------------------------------------
  // Binders
  // ---------------------------------------------------------

  bindAnecdoteRead: function() {

    const pathName = window.location.pathname;

    let splitPathName = pathName.split("/");
    let pathNameAnecdote = splitPathName[1]; 
    let anecdoteId = splitPathName[2];

    if(pathNameAnecdote == 'anecdote' && anecdoteId !== undefined){

      anecdote.handleLoadAnecdote(anecdoteId);

    }
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

    //Select div element <div id="label-categories" class="container-fluid">
    const divCategories = document.querySelector('#label-categories');

    const categoriesArray = [
      {'categoryId': categoryId1, 'categoryName' : categoryName1, 'categoryColor' : categoryColor1 },
      {'categoryId': categoryId2, 'categoryName' : categoryName2, 'categoryColor' : categoryColor2 },
      {'categoryId': categoryId3, 'categoryName' : categoryName3, 'categoryColor' : categoryColor3 },
    ]

    for (category of categoriesArray) {
      
      if(category.categoryName !== null){

        //Create span element <span class="label-category" style ="border: medium solid yellow">Catégorie</span>
        const categorySpan = document.createElement('span');
        categorySpan.classList.add('label-category');
        categorySpan.setAttribute('style', 'border: medium solid ' + category.categoryColor);

        //Create a element <a href="/category/id">
        const categoryLink = document.createElement('a');
        categoryLink.setAttribute('href', '/category/' + category.categoryId + '/anecdote');
        categoryLink.textContent = category.categoryName;

        //Add element <a> in element <span>
        categorySpan.append(categoryLink);
      
        //Add element <span> in element <div id="label-categories" class="container-fluid">
        divCategories.append(categorySpan);
      }
    }

    //Select h1 element <h1>Titre de l'anecdote 1</h1>
    const anecdoteTitle = document.querySelector('h1');
    anecdoteTitle.textContent = title;

    //Select p element <p id="anecdote-author">
    const anecdotePublishing = document.querySelector('#anecdote-author');
    anecdotePublishing.textContent = 'Publié par ' + pseudo + ' le ' + createdAt;

    //Select <li> element with vote of anecdote
    const anecdoteVote = document.querySelector('#anecdote-read-vote');
    let vote = upvote - downvote;
    anecdoteVote.textContent = vote;

    //Select <p> element with content of anecdote
    const anecdoteContent = document.querySelector('#anecdote-read-content');
    anecdoteContent.textContent = content;

    //Select <a> element with link source anecdote
    const anecdoteLink = document.querySelector('#anecdote-source a');
    anecdoteLink.setAttribute('href', source);
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
          const pathName = window.location.pathname;

          throw new Error('Network request for products.json failed with response ' + response.status + ': ' + response.statusText);

        }
      }
    )
    .then(
     function(object) {

        const anecdoteData = object.anecdote[0];

        //Create anecdote element browse
        const anecdoteItem = anecdote.readAnecdote(
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
    }
    );
  },
  
}