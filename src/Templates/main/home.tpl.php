<main>
    <section id="home" class="container-fluid">
        <h1>Bienvenue</h1>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non hic ex maxime itaque placeat nisi, repellat labore voluptatibus id dolorum, vero quo, asperiores reprehenderit ut. Provident enim saepe incidunt tenetur?</p>
    </section>

    <section id="latest" class="container-fluid">
        <h2>Nos dernières anecdotes</h2>
        
        <div id="carousel-latest-anecdote" class="carousel slide" data-bs-ride="carousel">
            <div id="carousel-latest-inner" class="carousel-inner">
                <template id="carousel-latest-item">

                    <!--<div id="carousel-item" class="carousel-item active">-->
                    <div id="carousel-item" class="carousel-item">
                        <div id="label-categories" class="container-fluid">
                                <span id="label-category-1" class="label-category"><a><!--Catégorie-1--></a></span>
                                <span id="label-category-2" class="label-category"><a><!--Catégorie-2--></a></span>
                                <span id="label-category-3" class="label-category"><a><!--Catégorie-3--></a></span>
                        </div>
                        <h3>Titre de l'anecdote 1</h3>
                        <p id="carousel-latest-item-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime voluptatibus similique odit ex, inventore molestias repudiandae. Expedita similique quod placeat iure voluptatibus consequuntur sequi ducimus esse quos aliquid, ratione ipsum!<a href="#" class="anecdote__link">afficher plus</a></p>
                        <p id="author">Publié par Auteur le 01.01.1999</p>
                    </div>

                </template>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-latest-anecdote" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel-latest-anecdote" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

        </div>
    </section>

    <section id="best" class="container-fluid">
        <h2>Top 5 anecdotes</h2>
        
        <div id="carousel-best-anecdote" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div id="label-categories" class="container-fluid">
                        <span class="label-category" style ="border: medium solid yellow">Catégorie</span>
                        <span class="label-category" style ="border: medium solid yellow">Catégorie</span>
                    </div>
                    <h3>Titre de l'anecdote 1</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime voluptatibus similique odit ex, inventore molestias repudiandae. Expedita similique quod placeat iure voluptatibus consequuntur sequi ducimus esse quos aliquid, ratione ipsum!<a href="#" class="anecdote__link">afficher plus</a></p>
                    <p id="author">Publié par Auteur le 01.01.1999</p>
                </div>

                <div class="carousel-item">
                    <div id="label-categories" class="container-fluid">
                        <span class="label-category" style ="border: medium solid yellow">Catégorie</span>
                        <span class="label-category" style ="border: medium solid yellow">Catégorie</span>
                    </div>
                    <h3>Titre de l'anecdote 2</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime voluptatibus similique odit ex, inventore molestias repudiandae. Expedita similique quod placeat iure voluptatibus consequuntur sequi ducimus esse quos aliquid, ratione ipsum!<a href="#" class="anecdote__link">afficher plus</a></p>
                    <p id="author">Publié par Auteur le 01.01.1999</p>
                </div>

                <div class="carousel-item">
                    <div id="label-categories" class="container-fluid">
                        <span class="label-category" style ="border: medium solid yellow">Catégorie</span>
                        <span class="label-category" style ="border: medium solid yellow">Catégorie</span>
                    </div>
                    <h3>Titre de l'anecdote 3</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime voluptatibus similique odit ex, inventore molestias repudiandae. Expedita similique quod placeat iure voluptatibus consequuntur sequi ducimus esse quos aliquid, ratione ipsum!<a href="#" class="anecdote__link">afficher plus</a></p>
                    <p id="author">Publié par Auteur le 01.01.1999</p>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-best-anecdote" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel-best-anecdote" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>

            </div>

            

        </div>
    </section>
</main>