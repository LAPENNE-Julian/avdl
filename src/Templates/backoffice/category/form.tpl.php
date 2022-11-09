<div id="backoffice-form-category" class="container-fluid backoffice form">

    <h1><?= htmlentities($category->getId()) == null ? 'Add':'Edit' ?> a category</h1>
    
    <div class="text-end">
        <a class="btn btn-dark" href="/backoffice/category">Back to list</a>
    </div>

    <form action="" method="POST">
    <?php require_once __DIR__ . '/../partials/errorMessage.tpl.php'; ?>
        
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="<?= htmlentities($category->getName()) ?>" minlength="2" required>
        </div>

        <div class="form-group">
            <label for="color">Color</label>
            <input id="input-category-color"  type="color" name="color" class="form-control" id="color" aria-describedby="subtitleHelpBlock" value="<?= htmlentities($category->getColor()) ?>">
        </div>

        <!-- <div class="form-group">
            <label for="img">Image</label>
            <input type="file" accept="image/png, image/jpeg" name="img" class="form-control" id="img" placeholder="image jpg, gif, svg, png" value="<?= htmlentities($category->getImg()) ?>">
        </div> -->
        
        <input type="hidden" name="token" id="token" value="">
        <button type="submit" class="btn btn-warning btn-block"><?= htmlentities($category->getId()) == null ? 'Add':'Edit' ?></button>
        
    </form>
</div>