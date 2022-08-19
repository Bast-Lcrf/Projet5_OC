<?php

require_once('Model/manager.php');

class CommentManager extends Manager
{
    public function getComments($idArticle) // Récupère les commentaires associés à son article
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id_comment, id_user, id_article, author, comment, validation_com, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\')
            AS date_comment_fr FROM Comments WHERE id_article = ? AND validation_com = 1 ORDER BY date_comment DESC');
        $comments->execute(array($idArticle));

        return $comments;
    }

    public function postComment($idUser, $idArticle, $author, $comment, $validation) // ajout d'un commentaire avec restriction de validation
    {
        $db = $this->dbConnect();
        $newCom = $db->prepare('INSERT INTO Comments(id_user, id_article, author, comment, validation_com, date_comment)
            VALUES(?, ?, ?, ?, ?, NOW())');
        $affectedLine = $newCom->execute(array($idUser, $idArticle, $author, $comment, $validation));

        return $affectedLine;
    }

    public function deleteCommentFromArticle($idArticle) // Supprime les commentaires d'un article lors de sa suppression
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM Comments WHERE id_article = ?');
        $deleteComFromArticle = $req->execute(array($idArticle));
    }
}

class ValidationManager extends Manager 
{
    public function validationView() // Récupère les commentaires en attente de validation
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id_comment, id_user, id_article, author, comment, validation_com, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') 
            AS date_com_fr FROM Comments WHERE validation_com = 2 ORDER BY date_comment ASC LIMIT 5');

        return $req;
    }

    public function updateCom($idComment) // Mets à jour les commentaires validé après modération
    {
        $db = $this->dbConnect();
        $update = $db->prepare('UPDATE Comments SET validation_com = 1 WHERE id_comment = ?');
        $comUpdate = $update->execute(array($idComment));

        return $comUpdate;
    }

    public function deleteCom($idComDelete) // supression du commentaire par la modération
    {
        $db = $this->dbConnect();
        $delete = $db->prepare('DELETE FROM Comments WHERE id_comment = ?');
        $comDelete = $delete->execute(array($idComDelete));
    }

    public function modifyCom($com, $idCom) // Commentaire modifier par l'utilisateur --> retour validation
    {
        $db = $this->dbConnect();
        $modifyCom = $db->prepare('UPDATE Comments SET comment = ?, validation_com = 2, date_comment = NOW() WHERE id_comment = ?');
        $newCom = $modifyCom->execute(array($com, $idCom));
    }
}