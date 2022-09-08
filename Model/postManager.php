<?php

require_once('Model/manager.php');

class PostManager extends Manager
{
    // Compte le nombre d'article existant
        public function nbArticle()
        {
            $db = $this->dbConnect();
            $count = $db->query('SELECT * FROM Articles');

            $nbArtilces = $count->rowCount();
            return $nbArtilces;
        }


    // afiche la liste des articles
        public function getListArticle() 
        {
            $db = $this->dbConnect();
            $req = $db->query('SELECT id_article, title, header_post, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_article_fr
            FROM Articles ORDER BY date_article DESC LIMIT 0, 10');

            return $req;
        }

    // Affiche le detail d'un article
        public function getArticle($idArticle) 
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT id_article, id_user, title, author, header_post, article, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_article_fr
            FROM Articles WHERE id_article = ?');
            $req->execute(array($idArticle));
            $article = $req->fetch(); 

            return $article;
        }

    // ajoute un nouvel article
        public function newArticle($idUser, $title, $author, $header_post, $article) 
        {
            $db = $this->dbConnect();
            $affectedLines = $db->prepare('INSERT INTO Articles(id_user, title, author, header_post, article, date_article)
                VALUES(?, ?, ?, ?, ?, NOW())');
            $newArticle = $affectedLines->execute(array($idUser, $title, $author, $header_post, $article));

            return $newArticle;
        }

    // Modification d'un article
        public function updateArticle($updateTitle, $updateHeader, $updateArticle, $idArticle)
        {
            $db = $this->dbConnect();
            $update = $db->prepare('UPDATE Articles SET title = ?, header_post = ?, article = ?, date_article = NOW() WHERE id_article = ?');
            $updatePost = $update->execute(array($updateTitle, $updateHeader, $updateArticle, $idArticle));

            return $updatePost;
        }
    // Suppression d'un article
        public function deleteArticle($idArticle)
        {
            $db = $this->dbConnect();
            $req = $db->prepare('DELETE FROM Articles WHERE id_article = ?');
            $req->execute(array($idArticle));
        }
}