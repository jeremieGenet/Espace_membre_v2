<?php

// Classe qui va être mère des classes CommentManager et PostManager (permettra d'inclure la bdd)

namespace jeremie;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=member_area;charset=utf8', 'root', '');
        return $db;
    }
}

/*
    Attention : en plaçant la classe Manager dans notre namespace, nous allons avoir un problème pour appeler PDO. En effet, PDO est une classe qui se trouve à la racine de PHP (dans le namespace global). Pour régler le problème, il faudra écrire \PDO (ligne 11) :
*/
