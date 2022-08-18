<?php $title = "Accueil "; ?>

<?php ob_start(); ?>

<!-- Content here -->
<div>
    <p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pellentesque, lectus ultricies rutrum accumsan, ligula diam facilisis ex, sed gravida risus est id tortor. Nullam eget tempor ipsum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis euismod sem at iaculis. Curabitur aliquet in purus eget egestas. Integer fermentum orci sapien, a accumsan lectus fringilla sit amet. Ut in eros et enim placerat dictum. Aenean volutpat suscipit finibus. Donec nec lacus eu lacus fringilla lacinia. Proin laoreet mi eu diam suscipit, sit amet varius lectus porttitor. Duis lobortis tortor in diam facilisis interdum. Etiam bibendum euismod justo, sit amet bibendum dui rhoncus viverra. Proin placerat purus nunc, eu semper sapien fringilla sagittis. Pellentesque tincidunt id mauris in eleifend. Quisque accumsan eget elit eget fermentum.
    </p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('View/Frontend/template/template.php'); ?>

