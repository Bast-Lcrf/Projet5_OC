<?php

session_start();

require('Controller/control_frontend.php');
require('Controller/control_backend.php');

try {
    if(isset($_GET['action'])) {
        if($_GET['action'] == 'loginVerify') // authentification des utilisateurs
        {
            if(!empty($_POST['pseudo']) && !empty($_POST['pwd'])) {
                logUser($_POST['pseudo'], $_POST['pwd']);
            }
            else {
                throw new Exception("les champs ne sont pas remplis");
                
            }
        }
        elseif($_GET['action'] == 'destroy') // deconnexion 
        {
            session_unset();
            session_destroy();
            header('location: index.php');
        }
        elseif($_GET['action'] == 'register') // inscription des utilisateurs
        {
            if(!empty($_POST['pseudo']) && !empty($_POST['pwd']) && !empty($_POST['lastName']) && !empty($_POST['firstName']) && !empty($_POST['email']) && !empty($_POST['statut'])) {
                addUser($_POST['pseudo'], cryptedPass($_POST['pwd']), $_POST['lastName'], $_POST['firstName'], $_POST['email'], $_POST['statut']);
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis.');
            }
        }
        elseif($_GET['action'] == 'listArticles') // Affiche la liste des derniers articles 
        {
            listArticles();
        }
        elseif($_GET['action'] == 'detailArticle') // Affiche le detail d'un article avec ses commentaires
        {
            if(isset($_GET['id']) && $_GET['id'] > 0) {
                detailArticle($_GET['id']);
            }
        }
        elseif($_GET['action'] == 'addComment') // Ajoute un commentaire
        {
            if(isset($_GET['id']) && $_GET['id'] > 0) {
                if(!empty($_POST['comment'])) {
                    addComment($_SESSION['id'], $_GET['id'], $_SESSION['pseudo'], $_POST['comment'], $validation=2);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis.');
                }
            }
            else {
                throw new Exception('Aucun identifiant d\'article envoyé.');
            }
        }
        elseif($_GET['action'] == 'adminZone') // Affiche la zone admin  
        {
            validView();
        }
        elseif($_GET['action'] == 'newArticle') // Nouvel Article posté
        {
            if(!empty($_POST['title']) && !empty($_POST['header_post']) && !empty($_POST['article'])) {
                addArticle($_SESSION['id'], $_POST['title'], $_SESSION['prenom'], $_POST['header_post'], $_POST['article']);
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis.');
            }
        }
        elseif($_GET['action'] == 'updateArticle') // modifier article
        {
            if(!empty($_POST['newHeader'] && $_POST['newArticle'])) {
                articleUpdate($_POST['newHeader'], $_POST['newArticle'], $_GET['id']);
            }
            else {
                throw new Exception('Tous les champs ne sont pas remplis.');
            }
            detailArticle($_GET['id']);
        } 

        elseif($_GET['action'] == 'validCom') // Modération des commentaires
        {
            if(isset($_POST['valider'])) {
                validCom($_GET['id']);
            }
            else {
                deleteCom($_GET['id']);
            }
            validView();
        }
    }
    else {
        home();
    }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('View/Frontend/home.php');
    require('View/Frontend/listArticles.php');
    require('View/Frontend/detailArticle.php');
    require('View/Frontend/zoneAdmin.php');
}