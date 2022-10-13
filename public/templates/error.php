<?php $title = "Erreur !"; ?>

<?php ob_start() ?>

<div class="errorBackground">
    <h1>! ERREUR !</h1>
    <div class="alert alert-danger" role="alert">
        <?php echo $errorMessage; ?>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php require('public/templates/base.php'); ?>