<?php

class Manager
{
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=Projet_5_V2;charset=utf8', 'root', 'root');
        return $db;
    }
}