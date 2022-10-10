<?php

namespace src\Entity;

class Comments
{
/* ------------------------------ Initialisation des paramètres ------------------------------ */

    /**
     * @var int $idComment     Identifiant du commentaire
     */
    private $idComment;

    /**
     * @var int $idUser        Identifiant de l'utilisateur qui a poster le commentaire
     */
    private $idUser;

    /**
     * @var int $idArticle     Identifiant de l'article relier au commentaire
     */
    private $idArticle;

    /**
     * @var string $author      Auteur du commentaire
     */
    private $author;

    /**
     * @var string $comment      Le contenu du commentaire 
     */
    private $comment;

    /**
     * @var string $validationCom   Valeur qui défini la place du commentaire, geré par la modération.
     *                              Soit valid, le commentaire est sur le site.
     *                              Soit notValid, le commentaire est en attente de modération par un admin.
     */
    private $validationCom;

    /**
     * @var string $dateComment    Date d'ajout / de derniere modification du commentaire.
     */
    private $dateCommentFr;

/* ------------------------------ les Fonctions (getters and setters) ------------------------------ */

    /**
     * @param int $idComment
     * Setter utile uniquement pour récupérer l'identifiant d'un commentaire déjà posté.
     * Ce setter n'est en aucun cas utilisable pour ajouter un commentaire, la BDD se charge de l'incrémentation.
     * @return Comments
     */
    public function setIdComment($idComment)
    {
        $this->idComment = $idComment;

        return $this;
    }

    /**
     * @return int
     */
    public function getIdComment()
    {
        return $this->idComment;
    }

    /**
     * @param int $idUser
     * 
     * @return Comments
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * @return int 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param int $idArticle
     * 
     * @return Comments
     */
    public function setIdArticle($idArticle)
    {
        $this->idArticle = $idArticle;

        return $this;
    }

    /**
     * @return int
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * @param string $author
     * 
     * @return Comments
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $comment
     * 
     * @return Comments
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $validationCom
     * 
     * @return Comments
     */
    public function setValidationCom($validationCom)
    {
        $this->validationCom = $validationCom;

        return $this;
    }

    /**
     * @return string
     */
    public function getValidationCom()
    {
        return $this->validationCom;
    }

    /**
     * @return string 
     */
    public function getDateComment()
    {
        return $this->dateCommentFr;
    }

}