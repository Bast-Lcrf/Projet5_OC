<?php

require_once('Model/manager.php');

class CommentManager extends Manager
{
    public function getComments($idArticle)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id_article, author, comment, validation_com, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\')
            AS date_comment_fr FROM Comments WHERE id_article = ? AND validation_com = 1 ORDER BY date_comment DESC');
        $comments->execute(array($idArticle));

        return $comments;
    }

    public function postComment($idUser, $idArticle, $author, $comment, $validation)
    {
        $db = $this->dbConnect();
        $newCom = $db->prepare('INSERT INTO Comments(id_user, id_article, author, comment, validation_com, date_comment)
            VALUES(?, ?, ?, ?, ?, NOW())');
        $affectedLine = $newCom->execute(array($idUser, $idArticle, $author, $comment, $validation));

        return $affectedLine;
    }
}