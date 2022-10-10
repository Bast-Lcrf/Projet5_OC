<?php

namespace src\Manager;

use src\Entity\Comments;
use src\Manager\Manager;

class CommentsManager extends Manager
{
    /**
     * Insere un objet Comments dans la bdd en lui spécifiant l'id de l'article sur lequel il est posté
     * et l'id de l'utilisateur qui l'a poster. De plus, le numéro de validation sera TOUJOURS 2 car le commentaire doit
     * passer par la modération.
     * 
     * @param Comments $comments    Objet de type Comments
     * 
     * @return bool     True si l'objet a été inseré avec succés, false en cas d'erreur
     */
    public function createComment(Comments $comments)
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->prepare('INSERT INTO Comments(idUser, idArticle, author, comment, validationCom, dateComment)
                                                        VALUES (?, ?, ?, ?, ?, NOW())');
        
        // Liaison des paramètres et éxécution de la requête
        return $this->pdoStatement->execute(array($comments->getIdUser(),
                                            $comments->getIdArticle(),
                                            $comments->getAuthor(),
                                            $comments->getComment(),
                                            $comments->getValidationCom(),
                                                ));
    }

    /**
     * Récupère un objet Comments à partir de l'identifiant d'un Article
     * 
     * @param Comments $comments    Objet de type Comments
     * 
     * @return bool|Comments|NULL   False en cas d'erreur, un ou plusieurs objet Comments si un id article existe, NULL si aucune correspondance n'est trouvé
     */
    public function readComments($idArticle)
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->prepare('SELECT idComment, idUser, idArticle, author, comment, validationCom, 
                                                    DATE_FORMAT(dateComment, \'%d/%m/%Y à %Hh%imin%ss\') AS dateCommentFr
                                                    FROM Comments WHERE idArticle = ? ORDER BY dateComment DESC');
        
        $executeIsOk = $this->pdoStatement->execute(array($idArticle));

        if($executeIsOk) {
            // Récupère notre résultat
            $comment = $this->pdoStatement;

            if($comment === false) {
                // NULL si aucune correspondance
                return NULL;
            }
            else {
                // Notre objet
                return $comment;
            }
        }
        else {
            // False en cas d'erreur
            return false;
        }
    }

    /**
     * 
     */
    public function readCommentsModeration()
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->prepare('SELECT * FROM Comments WHERE validationCom = notValid ');
        return $this->pdoStatement;
    }

    /**
     * Met à jours un objet Comments à partir de son identifiant
     * 
     * @param Comments $comments    Objet de type Comments
     * 
     * @return bool     True en cas de succés, false en cas d'erreur
     */
    public function updateComment(Comments $comments)
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->prepare('UPDATE Comments SET comment = ?, validationCom = notValid, dateComment = NOW() 
                                                        WHERE idComment = ?');
        return $this->pdoStatement->execute(array($comments->getComment(), $comments->getIdComment()));
    }

    /**
     * Supprime un objet Comments à partir de son identifiant
     * 
     * @param Comments $comments    Objet de type Comments
     * 
     * @return bool     True en cas de succés, false en cas d'erreur
     */
    public function deleteComment(Comments $comments)
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->prepare('DELETE FROM Comments WHERE idComment = ?');
        return $this->pdoStatement->execute(array($comments->getIdComment()));

    }
}