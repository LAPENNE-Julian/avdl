<section id="api-documentation" class="container-fluid">
    <h1>Documentation - API</h1>

    <h2>1 - Les informations relative aux anecdotes</h2>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">/anecdote </span>
            Affiche la liste de toutes les anecdotes. (information partiel)
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">/anecdote/{anecdoteId} </span>
            Affiche l'intégralité de l'anecdote via son id.
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">/anecdote/random </span>
            Affiche une anecdote au hasard.
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">/anecdote/best </span>
            Affiche les cinq anecdotes les meiux notées.
        </p>
    </div>

    <h2>2 - Les informations relative aux catégories</h2>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">/category </span>
            Affiche la liste de toutes les catégories. (information partiel)
        </p>
    </div>

    <div class="api-documentation-item">
        <p>
            <span class="label-GET">GET</span>
            <span class="label-bold request">/category/{categoryId}/anecdote </span>
            Affiche les anecdotes de la catégorie via son id.
        </p>
    </div>
</section>