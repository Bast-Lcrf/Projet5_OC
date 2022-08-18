<?php

require_once('Model/userManager.php');
require_once('Model/postManager.php');
require_once('Model/commentManager.php');

function home() // Affiche la page d'accueil
{
    require('View/Frontend/home.php');
}

function registerPage()
{
    require('View/Frontend/inscription.php');
}

// Affiche les commentaires en attente de validation dans la zone admin 
function validView()
{
    $validationManager = new ValidationManager();
    $validView = $validationManager->validationView();

    require('View/Frontend/zoneAdmin.php');
}