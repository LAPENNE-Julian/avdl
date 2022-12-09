<section id="anecdote-browse" class="container-fluid">
        <h1>Les anecdotes</h1>
        <span id="categoryId-browse-anecdotes">0</span>
        
        <p id="script-error-message">Désolé, nous rencontrons des problèmes de serveur temporaire.</p>
        
        <div id="anecdote-browse-inner" class="section-inner">
            <!-- <article class="anecdote-browse-item">
                <div id="label-categories" class="container-fluid">
                    <span class="label-category" style ="border: medium solid yellow">Catégorie</span>
                    <span class="label-category" style ="border: medium solid yellow">Catégorie</span>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                </svg>

                <h2>Titre de l'anecdote 1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime voluptatibus similique odit ex, inventore molestias repudiandae. Expedita similique quod placeat iure voluptatibus consequuntur sequi ducimus esse quos aliquid, ratione ipsum!<a href="#" class="anecdote__link">afficher plus</a></p>
                <a id="anecdote-browse-link-read" href="anecdote/anecdoteId">Lire la suite</a>
                <p id="author">Publié par Auteur le 01.01.1999</p>
            </article>-->
        </div>

        <span id="current-page">0</span>
        <span id="total-page"></span>
        
        <div id="arrow-navigation">
            <ul>
                <li>
                    <button id="anecdote-browse-previous" title="previous" alt="previous">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg> Précédent
                    </button>
                </li> 

                <li>
                    <button id="anecdote-browse-next" title="next" alt="next">
                        Suivant
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                    </svg> 
                    </button>
                </li>
            </ul>
        </div>
    </div>
</section>