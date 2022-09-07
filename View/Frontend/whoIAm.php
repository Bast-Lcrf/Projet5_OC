<?php $title = "Qui suis-je"; ?>

<?php ob_start(); ?>

<!-- Content here -->
<div class="container whoIAm">
    <div class="row">
        <div class="col-4">
            <img src="Public/images/svg/avatars.svg" alt="avatar" width="200px" height="200px" />
            <p>- Bastien - développeur acharné - </p>
        </div>
        <div class="col-8">
            <p> 
            Bonjour, je m'appelle Bastien et j'ai 32 ans. Mes années lycées ont été compliquées parce qu'une personne de ma famille 
            était malade et je devais prendre soin d'elle. Cela a duré jusqu'en 2014, mes 24 ans. Après quatre ans à tenter de 
            retourner à la vie active, j'ai enfin trouvé un travail, loin de chez moi certes, mais au moins, j'avais un vrai premier job. 
            Le Parc Astérix !
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p><br />
            Après deux ans de travail saisonnier sur le Parc, j'ai décidé de changer de voie pour me diriger vers un métier qui me 
            plaisait plus. En effet, je n'ai pas l'âme d'un commercial et la crise sanitaire liée au Covid m'a poussé à me remettre 
            en question. Je suis donc actuellement en formation Symfony/PHP avec OpenClassRooms et j'ai beaucoup d'intérêt à découvrir 
            toutes les subtilités des langages que j'apprends. Tous les jours j'apprends quelque chose de nouveaux et j'ai besoin 
            de ces stimulis dans ma vie pour ne pas m'ennuyer. C'est cette quête contre l'ennui que je mène chaque jour. J'ai beaucoup 
            d'idées de développement de site, certes pas toujours bonne, mais c'est ce qui me permet de rester créatif dans ma façon de voir les choses. Avant, quand 
            j'avais un trop-plein d'énergie créative, je prenais mes crayons et dessinais des portraits. Maintenant, le CSS a remplacé 
            mes crayons et mes pages web me servent de feuille blanche pour y dessiner mes idées farfelues sur le net. Cependant, 
            c'est dans le PHP et la logique des fonctions que je m'épanouis le plus, c'est dans ce domaine que j'espère 
            un jour gagner ma vie et comme l'a dit Confucius :<br /> 
            "Choisissez un travail que vous aimez et vous n'aurez pas à travailler un seul jour de votre vie".
            </p>
        </div>
    </div>
    <div class="row CV">
        <div class="col-12">
            <embed src="Public/images/oldCV2020.pdf" alt="CV" width="800px" height="1190px" type="application/pdf"/>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?>