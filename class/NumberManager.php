<?php

namespace jeremie;

class NumberManager{

    // Permet de génèrer un token (une chaine de caractères est sa longueur vaudra $length)
    static function createToken($length){
        $alphaNum = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        // str_repeat() permet de répéter parm1= ce que l'on répète, param2 le nombre de fois que l'on répète
        // str_shuffle() permet de mélanger (donc on mélange ($alphaNum x 60) si $length vaut 60) a ce stade on a une trés longue chaine de caractères
        // substr() permet de retourner un segment de chaîne, param1 = la chaine, param2= le début de la chaine, param3 = la longueur de la chaine
        return substr(str_shuffle(str_repeat($alphaNum, $length)),0,$length); 
    }

    /**
     * Permet de hasher un password (bcrypt)
     *
     * @param [type] $password
     * @return boolean
     */
    static function hashPassword($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }


    /**
     * Permet de formater une date de type DateTime au format fr
     *
     * @param DateTime $date
     * @return string la date formater au format fr
     */
    static function formatDateFr($date){

        // setlocale() permet de modifier les informations de localisation
        setlocale(LC_TIME, 'fr'); // LC_TIME est une super constante php qui spécifie la catégorie de fonctions affectées par la configuration de localisation et "fr" pour la localisation ("en" pour english, "de" pour allemand)

        // ucfirst() met un premier caractère en majuscule
        // strftime() permet de formater un date/heure avec la configuration locale définit par la la fonction setlocale()
        // strtotime() transforme un text anglais en timestamp de type DateTime (donc fonctionne sur un champ de typde DateTime de notre bdd)
        $formatDate = ucfirst(strftime('%A %d ', strtotime($date))); // %A pour le nom complet du jour, %d jour du mois en numérique, de la date passée en param
        $formatDate .= ucfirst(strftime('%B %Y', strtotime($date))); // concaténé à : %B nom complet du mois, %Y l'année sur 4 chiffres, de la date passée en param

        return $formatDate;
    
        //var_dump($formatDate);
    }
}