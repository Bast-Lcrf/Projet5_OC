<?php $title = "Accueil"; ?>

<?php ob_start() ?>

<div class="welcome"></div>
<div class="backgroundChefWord">
    <div class="chefWord">
        <h2>Mot du chef</h2>
        <h3>Bonjour et bienvenue sur mon blog !</h3>
        <p>Ici s'entremèlent mes idées, mes humeurs et mes réactions sur les différents sujets de la vie au quotidien.<br />
            J'aime discuter de sports, d'e-sports, de pop culture et de plein d'autres choses.<br/>
            N'hésitez pas à vous inscrire pour commenter mes articles et discuter avec moi !<br/>
            Au plaisir de vous lire et à bientôt.
        </p>
        <h6>Bast.L</h6>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<?php require('public/templates/base.php'); ?>