<?php

require_once('Model/userManager.php');
require_once('Model/postManager.php');
require_once('Model/commentManager.php');

function home() // Affiche la page d'accueil
{
    require('View/Frontend/home.php');
}

function restrictedArea() // Affiche la zone admin
{
    function validView()
    {
        $commentManager = new CommentManager();
        $validView = $commentManager->validationView();
        $data = $validView->fetch();
        
        return $data;
    }

    require('View/Frontend/zoneAdmin.php');
}

// Affiche les commentaires en attente de validation dans la zone admin 
/* function validView()
{
    $commentManager = new CommentManager();
    $validView = $commentManager->validationView();

    require('View/Frontend/zoneAdmin.php');
} */