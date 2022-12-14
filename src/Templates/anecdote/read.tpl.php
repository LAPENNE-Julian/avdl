<section id="anecdote-read" class="container-fluid">
    <p id="script-error-message">Désolé, nous rencontrons des problèmes de serveur temporaire.</p>

    <template id="anecdote-read-template">
        <div id="anecdote-read-inner" class="section-inner">

            <div id="label-categories" class="container-fluid">
                <span id="label-category-1" class="label-category">
                    <a><!--Catégorie-1--></a>
                </span>
                <span id="label-category-2" class="label-category">
                    <a><!--Catégorie-2--></a>
                </span>
                <span id="label-category-3" class="label-category">
                    <a><!--Catégorie-3--></a>
                </span>
            </div>

            <h1>Titre de l'anecdote 1</h1>

            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
            </svg> -->

            <span id="current-anecdoteId"></span>
            <span id="current-theme"></span>

            <p id="anecdote-author">Publié par Auteur le 01.01.1999</p>
            
            <div id="anecdote-content">
                <div id="anecdote-content-vote">
                    <ul>
                        <li id="anecdote-read-li-upvote">
                            <button id="anecdote-read-upvote" class="btn btn-outline-dark" title="upVote" alt="upVote">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                            </svg>
                            </button>
                        </li>

                        <li id="anecdote-read-vote">
                            Vote
                        </li>

                        <li id="anecdote-read-li-downvote">
                            <button id="anecdote-read-downvote" class="btn btn-outline-dark" title="downVote" alt="downVote">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                            </svg>
                            </button>
                        </li>
                    </ul>
                </div>
                <p id="anecdote-read-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime voluptatibus similique odit ex, inventore molestias repudiandae. Expedita similique quod placeat iure voluptatibus consequuntur sequi ducimus esse quos aliquid, ratione ipsum!</p>
            </div>
            
            <div id="anecdote-source">
                <a href="#">Source</a></li>
            </div>

            <div id="anecdote-notice">
                <div id="anecdote-notice-vote">
                    <ul>
                        <li id="anecdote-read-li-known">
                            <button id="anecdote-read-known" class="btn btn-outline-success" title="known" alt="known">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                            </svg> Je connaissais
                            </button>
                        </li> 

                        <li id="anecdote-read-li-unknown">
                            <button id="anecdote-read-unknown" class="btn btn-outline-danger" title="known" alt="known">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                            </svg> Je ne connaissais pas
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </template>

    <div id="arrow-navigation">
        <ul>
            <li>
                <button id="anecdote-read-previous" title="previous" alt="previous">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg> Précédent
                </button>
            </li> 

            <li>
                <button id="anecdote-read-next" title="next" alt="next">
                    Suivant
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                </svg> 
                </button>
            </li>
        </ul>
    </div>
    
</section>
