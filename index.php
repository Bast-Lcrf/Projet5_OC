<?php

session_start();


require('Controller/control_frontend.php');
require('Controller/control_backend.php');

try {
    if(isset($_GET['action'])) {
        // authentification des utilisateurs
            if($_GET['action'] == 'loginVerify') 
            {
                if(!empty($_POST['pseudo']) && !empty($_POST['pwd'])) {
                    logUser(htmlspecialchars($_POST['pseudo']),htmlspecialchars($_POST['pwd']));
                }
                else {
                    throw new Exception("Tous les champs ne sont pas remplis");
                }
            }
        
        // deconnexion 
            elseif($_GET['action'] == 'destroy') 
            {
                session_unset();
                session_destroy();
                header('location: index.php');
            }

        // Affiche la page d'inscription
            elseif($_GET['action'] == 'registerPage') { 
                registerPage();
            }

        // inscription des utilisateurs
            elseif($_GET['action'] == 'register') 
            {
                if(!empty($_POST['pseudo']) && !empty($_POST['pwd']) && !empty($_POST['lastName']) && !empty($_POST['firstName']) && !empty($_POST['email']) && !empty($_POST['statut'])) {
                    addUser(htmlspecialchars($_POST['pseudo']), htmlspecialchars(cryptedPass($_POST['pwd'])), htmlspecialchars($_POST['lastName']), htmlspecialchars($_POST['firstName']), htmlspecialchars($_POST['email']), htmlspecialchars($_POST['statut']));
                    logUser(htmlspecialchars($_POST['pseudo']),htmlspecialchars($_POST['pwd']));
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis.');
                }
            }

        // Affiche la page qui me presente
            elseif($_GET['action'] == "me")
            {
                WhoIAm();
            }

        // Affiche la liste des derniers articles
            elseif($_GET['action'] == 'listArticles')  
            {
                listArticles();
            }

        // Affiche le detail d'un article avec ses commentaires
            elseif($_GET['action'] == 'detailArticle') 
            {
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    detailArticle(htmlspecialchars($_GET['id']));
                }
            }

        // Ajoute un commentaire   
            elseif($_GET['action'] == 'addComment') 
            {
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    if(!empty($_POST['comment'])) {
                        addComment($_SESSION['id'], htmlspecialchars($_GET['id']), htmlspecialchars($_SESSION['pseudo']), htmlspecialchars($_POST['comment']), $validation=2);
                    }
                    else {
                        throw new Exception('Tous les champs ne sont pas remplis.');
                    }
                }
                else {
                    throw new Exception('Aucun identifiant d\'article envoyé.');
                }
            }

        // Affiche la zone admin 
            elseif($_GET['action'] == 'adminZone')  
            {
                validView();
            }

        // Nouvel Article posté
            elseif($_GET['action'] == 'newArticle') 
            {
                if(!empty($_POST['title']) && !empty($_POST['header_post']) && !empty($_POST['article'])) {
                    addArticle($_SESSION['id'], htmlspecialchars($_POST['title']), $_SESSION['prenom'], htmlspecialchars($_POST['header_post']), htmlspecialchars($_POST['article']));
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis.');
                }
            }

        // modifier article
            elseif($_GET['action'] == 'updateArticle') 
            {
                if(!empty($_POST['newTitle'] && !empty($_POST['newHeader']) && !empty($_POST['newArticle']))) {
                    articleUpdate(htmlspecialchars($_POST['newTitle']), htmlspecialchars($_POST['newHeader']), htmlspecialchars($_POST['newArticle']), htmlspecialchars($_GET['id']));
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis.');
                }
                detailArticle(htmlspecialchars($_GET['id']));
            } 

        // Supprime un article
            elseif($_GET['action'] == 'deleteArticle') 
            {
                deleteArticle(htmlspecialchars($_GET['id']));
                listArticles();
            }

        // Modération des commentaires
            elseif($_GET['action'] == 'validCom') 
            {
                if(isset($_POST['valider'])) {
                    validCom(htmlspecialchars($_GET['idCom'])); // Validation
                }
                else {
                    deleteCom(htmlspecialchars($_GET['idCom'])); // Suppression
                }
                validView();
            }

        // Modifier commentaire -> retour validation
            elseif($_GET['action'] == 'updateCom')  
            {
                if(!empty($_POST['textUpdate'])) {
                    updateCom(htmlspecialchars($_POST['textUpdate']), htmlspecialchars($_GET['idCom']), htmlspecialchars($_GET['id']));
                }
            }
    }
    else {
        home();
    }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require_once('View/Frontend/home.php');
    require_once('View/Frontend/listArticles.php');
    require_once('View/Frontend/detailArticle.php');
    require_once('View/Frontend/zoneAdmin.php');
    require_once('View/Frontend/inscription.php');
}