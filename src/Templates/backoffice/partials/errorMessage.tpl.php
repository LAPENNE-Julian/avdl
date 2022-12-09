<?php if(isset($_SESSION['errorMessage'])): ?>

<div class="alert alert-danger">
        <?= $_SESSION['errorMessage']?>
</div>

<?php unset($_SESSION['errorMessage']); ?>
<?php endif ?>