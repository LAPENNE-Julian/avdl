<div id="backoffice-form-user" class="container-fluid backoffice form">
    
    <h1><?= htmlentities($user->getId()) === null ? 'Add':'Edit' ?> user</h1>
    
    <div class="text-end">
        <a class="btn btn-dark btn-lg" href="/backoffice/user">Back to list</a>
    </div>

    <form action="" method="POST">
    <?php require_once __DIR__ . '/../partials/errorMessage.tpl.php'; ?>

        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="" value="<?= htmlentities($user->getPseudo()) ?>" minlength="4" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="exemple@mail.fr" aria-describedby="subtitleHelpBlock" value="<?= htmlentities($user->getEmail()) ?>" required>
        </div>

        <div class="form-group">
            <label for="password">password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="minimale 6 characters" aria-describedby="pictureHelpBlock" value="" minlength="6" mawxlength="15">
        </div>

        <!-- <div class="form-group">
            <label for="img">Image</label>
            <input type="file" name="img" accept="image/png, image/jpeg" class="form-control" id="img" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock" value="<?= htmlentities($user->getImg()) ?>">
        </div> -->

        <div class="form-group">
            <div class="col-4">
                <label for="roles">Roles :</label>
                <select name="roles" id="roles" class="form-control">
                    <option value="1">user</option>
                    <option value="2">admin</option>
                </select>
            </div>
        </div>
        
        <input type="hidden" name="token" id="token" value="">
        <button type="submit" class="btn btn-warning btn-block mt-5"><?= htmlentities($user->getId()) === null ? 'Add':'Edit' ?></button>
    
    </form>
</div>
