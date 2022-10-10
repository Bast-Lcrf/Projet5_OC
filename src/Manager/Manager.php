<?php

namespace src\Manager;

use PDO;
use PDOException;

class Manager
{
    private PDO $pdo;

    /**
     * Connexion à la base de données
     */
    protected function dbConnect()
    {
        try {
            $user = "root";
            $pass = "root";
            $this->pdo = new PDO('mysql:host=localhost;dbname=Projet_5_V3;charset=utf8', $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br />";
        }
    }
}