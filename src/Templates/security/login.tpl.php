<section id="form-login" class="container-fluid backoffice form">
    <h1 class="">Please sign in</h1>

    <form method="POST" id="form-login-inner">

    <?php 
    require_once __DIR__ . '/../backoffice/partials/errorMessage.tpl.php';
    require_once __DIR__ . '/../backoffice/partials/flashMessage.tpl.php';
    ?>
        
        <div class="form-group">
            <label for="email">Email address</label>
            <input id="login-form-email" type="email" value="" name="login-email" id="email" class="form-control" autocomplete="email" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="login-form-password" type="password" name="login-password" id="password" class="form-control" autocomplete="current-password" required>
        </div>

        <input type="hidden" name="token" id="token" value="<?= $_SESSION['token'] ?>">
        <button  class="btn btn-info btn-block" >Sign</button>
       
    </form>
</section>

