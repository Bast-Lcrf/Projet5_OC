<?php

namespace src\Entity;

class Articles
{
/* ------------------------------ Initialisation des paramètres ------------------------------ */

    /**
     * @var int $idArticle     Identifiant de l'article(généré automatiquement par le SGBDR)
     */
    private $idArticle;
    
    /**
     * @var int $idUser        Identifiant de l'utilisateur pour le relier l'article a l'auteur
     */
    private $idUser;

    /**
     * @var string $title       Titre de l'article
     */
    private $title;

    /**
     * @var string $author      Auteur de l'article
     */
    private $author;

    /**
     * @var string $headerPost Chapô de l'article
     */
    private $headerPost;

    /**
     * @var string $article     Contenu de l'article
     */
    private $article;

    /**
     * @var string $dateArticle    Date de création de l'article ou de sa modification
     */
    private $dateArticle;


/* ------------------------------ les Fonctions (getters and setters) ------------------------------ */

    /**
     * @param int $idArticle
     * Setter utile uniquement pour récupérer l'identifiant d'un article déjà posté.
     * Ce setter n'est en aucun cas utilisable pour ajouter un articles, la BDD se charge de l'incrémentation.
     * @return Articles
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
     * @param int $idUser
     * 
     * @return Articles
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
     * @param string $title
     * 
     * @return Articles
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $author
     * 
     * @return Articles
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
     * @param string $headerPost
     * 
     * @return Articles
     */
    public function setHeaderPost($headerPost)
    {
        $this->headerPost = $headerPost;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeaderPost()
    {
        return $this->headerPost;
    }

        /**
     * @param string $article
     * 
     * @return Articles
     */
    public function setArticle($article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * @return string
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @return string
     */
    public function getDateArticle()
    {
        return $this->dateArticleFr;
    }
}