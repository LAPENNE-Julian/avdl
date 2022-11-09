<div id="backoffice-form-anecdote" class="container-fluid backoffice form">
    
    <h1><?= htmlentities($anecdote->getId()) == null ? 'Add':'Edit' ?> an anecdote</h1>


    <div class="text-end">
        <a class="btn btn-dark" href="/backoffice/anecdote">Back to list</a>
    </div>
    

    <form action="" method="POST">
    <?php require_once __DIR__ . '/../partials/errorMessage.tpl.php'; ?>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="" value="<?= htmlentities($anecdote->getTitle()) ?>" minlength="2" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" class="form-control" id="description" placeholder="" aria-describedby="subtitleHelpBlock" value="<?= htmlentities($anecdote->getDescription()) ?>">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea type="text" name="content" class="form-control" id="content" placeholder="" aria-describedby="pictureHelpBlock" minlength="10" required><?= htmlentities($anecdote->getContent()) ?></textarea>
        </div>

        <!-- <div class="form-group">
            <label for="img">Image</label>
            <input type="file" accept="image/png, image/jpeg" name="img" class="form-control" id="img" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" value="<?php //htmlentities($anecdote->getImg()) ?>">
        </div> -->

        <div class="form-group">
            <label for="source">Source</label>
            <input type="text" name="source" class="form-control" id="source" placeholder="http://www.source.fr" aria-describedby="pictureHelpBlock" value="<?= htmlentities($anecdote->getSource()) ?>">
        </div>

      
        <div class="form-group">
            <div class="row form-anecdote-select-category">
                <div class="col-3 form-anecdote-select-category-item">
                    <label for="category-1">Categorie 1 :</label>
                    <select name="category-1" id="category-1" class="form-control">
                        <option value="0">null</option>
                        <?php foreach($categories as $category): ?>
                        <option value="<?= $category->getId() ?>" <?= $category->getId() == $anecdote->getCategory1() ? ' selected':'' ?>><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-3 form-anecdote-select-category-item">
                    <label for="category-2">Categorie 2 :</label>
                    <select name="category-2" id="category-2" class="form-control">
                        <option value="0">null</option>
                        <?php foreach($categories as $category): ?>
                        <option value="<?= $category->getId() ?>" <?= $category->getId() == $anecdote->getCategory2() ? ' selected':'' ?>><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-3 form-anecdote-select-category-item">
                    <label for="category-3">Categorie 3 :</label>
                    <select name="category-3" id="category-3" class="form-control">
                        <option value="null">null</option>
                        <?php foreach($categories as $category): ?>
                        <option value="<?= $category->getId() ?>" <?= $category->getId() == $anecdote->getCategory3() ? ' selected':'' ?>><?= $category->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <input type="hidden" name="token" id="token" value="">
        <button type="submit" class="btn btn-primary btn-block mt-5"><?= htmlentities($anecdote->getId()) === null ? 'Add':'Edit' ?></button>
        
    </form>
</div>