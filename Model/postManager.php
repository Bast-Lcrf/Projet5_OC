<?php

require_once('Model/manager.php');

class PostManager extends Manager
{
    public function getListArticle() // afiche la liste des articles
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id_article, title, header_post, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_article_fr
        FROM Articles ORDER BY date_article DESC LIMIT 0, 10');

        return $req;
    }

    public function getArticle($idArticle) // Affiche le detail d'un article
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id_article, id_user, title, author, header_post, article, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin%ss\') AS date_article_fr
        FROM Articles WHERE id_article = ?');
        $req->execute(array($idArticle));
        $article = $req->fetch(); 

        return $article;
    }

    public function newArticle($idUser, $title, $author, $header_post, $article) // ajoute un nouvel article
    {
        $db = $this->dbConnect();
        $affectedLines = $db->prepare('INSERT INTO Articles(id_user, title, author, header_post, article, date_article)
            VALUES(?, ?, ?, ?, ?, NOW())');
        $newArticle = $affectedLines->execute(array($idUser, $title, $author, $header_post, $article));

        return $newArticle;
    }

    public function updateArticle($updateHeader, $updateArticle, $idArticle)
    {
        $db = $this->dbConnect();
        $update = $db->prepare('UPDATE Articles SET header_post = ?, article = ? WHERE id_article = ?');
        $updatePost = $update->execute(array($updateHeader, $updateArticle, $idArticle));

        return $updatePost;
    }

    public function deleteArticle($idArticle)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM Articles WHERE id_article = ?');
        $deleteArticle = $req->execute(array($idArticle));
    }
}