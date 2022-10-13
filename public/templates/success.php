<?php $title = "Yeah !"; ?>

<?php ob_start() ?>

<div class="successBackground">
    <h1>Félicitation !</h1>
    <div class="alert alert-success" role="alert">
        <?php echo $messageSuccess; ?>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php require('public/templates/base.php'); ?>