<?php $title = "Admin Dashboard"; ?>

<?php ob_start() ?>
<div class="dashboard">
<?php if(!isset($_SESSION['pseudo'])): ?>
    <div class="alert alert-warning" role="alert">
        <p>Vous n'etes pas autorisé a entrer sur cette page.</p>
    </div>
<?php elseif($_SESSION['statut'] == 'ROLE_ADMIN'): ?>
    <div class="dashboard_box">
        <div class="box_moderationCom">
            <?php while($data = $moderationCom->fetch()): ?>
                <?php $data['comment']; ?>
            <?php endwhile; ?>
        </div>
        <div class="box_formNewArticle">

        </div>
    </div>
<?php else: ?>
    <div class="alert alert-warning" role="alert">
        <p>Vous n'etes pas autorisé <strong><?php echo $_SESSION['pseudo']; ?></strong> a entrer sur cette page.</p>
    </div>
<?php endif; ?>
</div>

<?php $content = ob_get_clean() ?>

<?php require('public/templates/base.php'); ?>