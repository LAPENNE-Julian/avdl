<section id="api-documentation" class="container-fluid">
    <h1>Documentation - API</h1>

    <h2>1 - Les informations relative aux anecdotes</h2>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ anecdote </span>
            Affiche la liste de toutes les anecdotes. (information partiel)
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ anecdote/ page/ {pageId} </span>
            Liste intégrale des anecdotes. Pagination par 9 items. La première page valant 0.
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ anecdote/  page </span>
            Nombre totale de page de la liste intégrale des anecdotes.
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ anecdote/ {anecdoteId} </span>
            Affiche l'intégralité de l'anecdote via son id.
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ anecdote/ {anecdoteId}/ prev </span>
            Affiche l'intégralité de l'anecdote précédente dans la liste intégrale via son id.
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ anecdote/ {anecdoteId}/ next </span>
            Affiche l'intégralité de l'anecdote suivante dans la liste intégrale via son id.
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ anecdote/ random </span>
            Affiche une anecdote au hasard.
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ anecdote/ best </span>
            Affiche les cinq anecdotes les meiux notées. (information partiel)
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ anecdote/ best/ {anecdoteId} </span>
            Affiche l'intégralité de l'anecdote dans la liste best anecdotes via son id.
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ anecdote/ best/ {anecdoteId}/ prev </span>
            Affiche l'intégralité de l'anecdote précédente dans la liste best anecdotes via son id.
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ anecdote/ best/ {anecdoteId}/ next </span>
            Affiche l'intégralité de l'anecdote suivante dans la liste best anecdotes via son id.
        </p>
    </div>

    <h2>2 - Les informations relative aux catégories</h2>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ category </span>
            Affiche la liste de toutes les catégories. (information partiel)
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ category/ {categoryId}/ anecdote </span>
            Affiche la liste des anecdotes via l'id de la catégorie. (information partiel)
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ category/ {categoryId}/ anecdote/ page/ {pageId} </span>
            Liste intégrale des anecdotes via l'id de la catégorie. Pagination par 9 items. La première page valant 0.
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">api/ category/ {categoryId}/ anecdote/ page </span>
            Nombre totale de page de la liste des anecdotes de la catégorie via son Id.
        </p>
    </div>
</section>