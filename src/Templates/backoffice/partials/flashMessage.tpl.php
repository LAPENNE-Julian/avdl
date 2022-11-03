<?php if(isset($_SESSION['successMessage'])): ?>

<div class="alert alert-success">
        <?= $_SESSION['successMessage']?>
</div>

<?php unset($_SESSION['successMessage']); ?>
<?php endif ?>