<?php

namespace src\Entity;

class Articles
{
/* ------------------------------ Initialisation des paramètres ------------------------------ */

    /**
     * @var int $id_article     Identifiant de l'article(généré automatiquement par le SGBDR)
     */
    private $id_article;
    
    /**
     * @var int $id_user        Identifiant de l'utilisateur pour le relier l'article a l'auteur
     */
    private $id_user;

    /**
     * @var string $title       Titre de l'article
     */
    private $title;

    /**
     * @var string $author      Auteur de l'article
     */
    private $author;

    /**
     * @var string $header_post Chapô de l'article
     */
    private $header_post;

    /**
     * @var string $article     Contenu de l'article
     */
    private $article;

    /**
     * @var string $date_article    Date de création de l'article ou de sa modification
     */
    private $date_article;


/* ------------------------------ les Fonctions (getters and setters) ------------------------------ */

    /**
     * @return int 
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * @param int $id_user
     * 
     * @return Articles
     */
    public function setIdUser($idUser)
    {
        $this->id_user = $idUser;

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
     * @param string $header_post
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