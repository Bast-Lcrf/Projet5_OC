<?php

namespace src\Entity;

class Users 
{
/* ------------------------------ Initialisation des paramètres ------------------------------ */

    /** 
     * @var int $id                 identifiant de l'utilisateur(généré automatiquement par le SGBDR)
     * */
    private $id;


    /** 
     * @var string $pseudo          pseudo de l'utilisateur 
     * */
    private $pseudo;


    /** 
     * @var string $pwd             mot de passe crypté de l'utilisateur 
     * */
    private $pwd;


    /** 
     * @var string $lastName        Nom de l'utilisateur 
     * */
    private $lastName;

    
    /** 
     * @var string $firstName       Prénom de l'utilisateur 
     * */
    private $firstName;


    /** 
     * @var string $email           Email de l'utilisateur 
     * */
    private $email;


    /** 
     * @var string $statut             Statut de l'utilisateur(Admin ou utilisateur classique) 
     * */
    private $statut;


    /** 
     * @var string $date_signin     Date de création du compte de l'utilisateur 
     * */
    private $date_signin;
/*
    /**
     * @var array $session      Session de l'utilisateur
    
    private $session;*/

    
/* ------------------------------ les Fonctions (getters and setters) ------------------------------ */

    /**
     * Uniquement utiliser pour setup un objet Users session avec l'id de la base de données
     * L'ID est toujours geré par le SGBDR
     * 
     * @param int $id_user
     * 
     * @return Users
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param string $pseudo
     * 
     * @return Users
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param string $pwd
     * 
     * @return Users
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * @return string
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param string $lastName
     * 
     * @return Users
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $firstName
     * 
     * @return Users
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $email
     * 
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param int $statut
     * 
     * @return Users
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param string $date_signin
     * 
     * @return Users
     */
    public function setDateSignin($dateSignin)
    {
        $this->dateSignin = $dateSignin;

        return $this;
    }

    /**
     * @return string
     */
    public function getDateSignin()
    {
        return $this->dateSignin;
    }
}