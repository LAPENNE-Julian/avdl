<section id="form-register" class="container-fluid backoffice form">

    <h1>Please sign up</h1>
    
    <form method="post" id="form-register-inner">

    <?php 
    require_once __DIR__ . '/../backoffice/partials/errorMessage.tpl.php'; 
    require_once __DIR__ . '/../backoffice/partials/flashMessage.tpl.php';
    ?>

        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="minimale 4 characters" value="" minlength="4" maxlenght="15" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="exemple@mail.fr" aria-describedby="subtitleHelpBlock" value="" required>
        </div>

        <div class="form-group">
            <label for="password">password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="minimale 6 characters" aria-describedby="pictureHelpBlock" value="" minlength="6" required>
        </div>

        <div class="form-group">
            <label for="repeatPassword">repeat password</label>
            <input type="password" name="repeatPassword" class="form-control" id="repeatPassword" placeholder="minimale 6 characters" aria-describedby="pictureHelpBlock" value="" minlength="6" maxlenght="15" required>
        </div>
        
        <div class="form-group text-end">
            <input type="hidden" name="token" id="token" value="<?= $_SESSION['token'] ?>">
            <button  class="btn btn-warning" >Sign</button>
        </div>
    </form>
</section>