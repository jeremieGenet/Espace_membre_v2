<?php

namespace jam;

class Autoloader{

    static function registerClass(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class){
        // Si 'jam' est en 1ere position de la chaine de caractères recherché alors... (vérif pour que l'autoloader ne cherche que dans un namespace qui commence par 'jam')
        if(strpos($class, 'jam' . '\\') === 0){ // strpos() permet de chercher la position de la première occurrence dans une chaîne (retourne la position dans la chaîne qui commence à 0, et non pas à 1.)
            // On nullifie le nom du namespace de la class pour que l'autoloader puis trouver les classe de ce namespace 
            $class = str_replace('jam' . '\\', '', $class); // On remplace 'jam\' ('jam' . '\\') par du vide ('') dans "$class" (dans le nom de la classe)
            $class = str_replace('\\', '/', $class); // On remplace les anti-slashes pour des slashes dans "$class" (pour faciliter le code)
            require 'class/' . $class . '.php';
        }
    }




}