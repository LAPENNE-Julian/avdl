<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="5; URL=https://www.avdl.app"> -->
    <title>Avez-vous déjà lu ..? 2.0</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!--avdl logo font--> 
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Rock+Salt&display=swap" rel="stylesheet">
    <!--avdl header font-->
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php $_SERVER['HTTP_HOST'] ?>/css/reset.css">
    <link rel="stylesheet" href="<?php $_SERVER['HTTP_HOST'] ?>/css/style.css">
    <!--favicon-->
    <link rel="icon" type="image/png" sizes="48x48" href="<?php $_SERVER['HTTP_HOST'] ?>/images/avdl-icon.png">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a id="avdl" class="navbar-brand text-info" href="/">
                    <strong>Avez-vous déjà lu ..?</strong>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/anecdote">Anecdotes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/categories">Catégories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/anecdote/random">Hasard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/anecdote/best">Top 5</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav me-4 mb-md-0">

                    <?php if(empty($_SESSION['userPseudo'])) :?>

                        <li class="nav-item nav-link">
                            <a class="btn btn-outline-warning" aria-current="page" href="/register">Inscription</a>
                        </li>

                    <?php endif ?>

                    <?php if(isset($_SESSION['userPseudo'])) :?>

                        <li class="nav-item nav-link user-pseudo">
                            <span class="text-white"><?= $_SESSION['userPseudo'] ?></span>
                        </li>
                        
                        <li class="nav-item nav-link">
                            <a class="btn btn-outline-warning" aria-current="page" href="/logout">Déconnexion</a>
                        </li>

                    <?php else : ?>

                        <li class="nav-item nav-link">
                            <a class="btn btn-outline-warning" aria-current="page" href="/login">Connexion</a>
                        </li>
                        
                    <?php endif ?>

                    <?php if(isset($_SESSION['userRoles']) && $_SESSION['userRoles'] == 2) :?>
                        <li class="nav-item nav-link">
                            <a class="btn btn-outline-info" aria-current="page" href="/backoffice/anecdote">BackOffice</a>
                        </li>
                    <?php endif ?>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>