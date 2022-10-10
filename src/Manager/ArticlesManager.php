<?php

namespace src\Manager;

require('src/Manager/Manager.php');

use PDOStatement;
use src\Entity\Articles;
use src\Manager\Manager;

class ArticlesManager extends Manager
{
    private PDOStatement $pdoStatement;

    /**
     * Insert un objet Articles dans la bdd en lui spécifiant l'id_user (l'utilisateur) qui a rédigé l'article
     * 
     * @param Articles $articles    objet de type articles
     * 
     * @return bool     true si l'objet a été inserer avec succés, false si une erreur survient
     */
    public function createArticle(Articles $articles)
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->prepare('INSERT INTO Articles(idUser, title, author, headerPost, article, dateArticle) VALUES(?, ?, ?, ?, ?, NOW())');
        
        $executeIsOk = $this->pdoStatement->execute(array($articles->getIdUser(),
                                                            $articles->getTitle(),
                                                            $articles->getAuthor(),
                                                            $articles->getHeaderPost(),
                                                            $articles->getArticle()
                                                            ));
        
        return $executeIsOk;
    }

    /**
     * Récupère un objet Articles à partir de son identifiant
     * 
     * @param int $idArticle      Identifiant d'un article
     * 
     * @return bool|Articles|NULL   false si une erreur survient, un objet Articles si l'identifiant existe, NULL si aucune correspondance n'est trouvé
     */
    public function readArticle($idArticle)
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->prepare('SELECT idArticle, idUser, title, author, headerPost, article, 
                                                    DATE_FORMAT(dateArticle, \'%d/%m/%Y à %Hh%imin%ss\') AS dateArticleFr 
                                                    FROM Articles WHERE idArticle = ?');

        $execuetIsOk = $this->pdoStatement->execute(array($idArticle));
        
        if($execuetIsOk) {
            // Récupère notre resultat 
            $article = $this->pdoStatement->fetch();

            if($article === false) {
                // NULL si pas de correspondance
                return null;
            }
            else {
                // Notre objet 
                return $article;
            }
        }
        else {
            // false si erreur
            return false;
        }
    }

    /**
     * Récupère tout les objet Articles de la bdd pour les afficher sous forme de liste
     * 
     * @return array|bool   retourne un tableau d'objet Articles ou un tableau vide si la bdd est vide, false en cas d'erreur
     */
    public function readAllArticle() 
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->query('SELECT idArticle, idUser, title, author, headerPost, article, DATE_FORMAT(dateArticle, \'%d/%m/%Y à %Hh%imin%ss\') AS dateArticleFr  
                                                    FROM Articles ORDER BY dateArticle DESC');

        $allArticle = $this->pdoStatement;

        return $allArticle;
    }

    /**
     * Compte le nombre d'articles en BDD
     * 
     * @return int  Nombre d'article dans la BDD
     */
    public function nbArticles()
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->query('SELECT * FROM Articles');

        $nbArticles = $this->pdoStatement->rowCount();
        return $nbArticles;
    }

    /**
     * Met à jour un objet Articles stocké en bdd
     * 
     * @param Articles $articles    Objet de type Articles
     * 
     * @return bool     True en cas de succés, false en cas d'erreur
     */
    public function updateArticle()
    {
        $this->pdo = $this->dbConnect();

    }

    /**
     * Supprime un objet Articles stocké en bdd
     * 
     * @param Articles $articles    Objet de type Articles
     * 
     * @return bool     True en cas de succés, false en cas d'erreur
     */
    public function deleteArticle(Articles $articles)
    {
        $this->pdo = $this->dbConnect();
        $this->pdoStatement = $this->pdo->prepare('DELETE FROM Articles WHERE idArticle = ?');

        // Liaison du paramètre et Execution de la requête
        return $this->pdoStatement->execute(array($articles->getIdArticle()));

    }
}