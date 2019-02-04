<?php

namespace jeremie;

class Autoloader{

    // Fonction qui appelle la méthode "autoload()" dans la classe Autoloader (__CLASS__ est une super constante de php qui récup le nom de la classe courante soit ici 'Autoloader')
    static function loadClass(){
        /*
            EXPLICATION des paramètres de spl_autoloader_register() :

            spl_autoloader_register() attend en premier param une fonction, mais nous on veut appeller une méthode (une fonction dans une classe)
            donc on déclare en parm1 non pas une chaîne de caractères (nom de la fonction) mais un tableau qui contiendra 2 param
            parm1 le nom de la classe qui contient cette méthode, et en parm2 le nom de la méthode à appeler
            RAPPEL :  "__CLASS__" est une Super contante de php qui contient le nom de la classe courante (donc ici 'Autoloader')
        */
        
        spl_autoload_register([__CLASS__, 'autoload']); // spl_autoload_register(['Autoloader', 'autoload']); (Les 2 expressions sont les mêmes)

    }
    
    // Fonction qui charge les classes
    static function autoload($class){

        // Condition pour ne charger que les classes dont le namespace est "jeremie" (pour limité la recherche de classe OPTIMISATION DE RESSOURCES)
        if(strpos($class, __NAMESPACE__ . '\\') === 0){ // strpos() permet de chercher la position de la première occurrence dans une chaîne (retourne la position dans la chaîne qui commence à 0, et non pas à 1.)

            // RAPPEL : la super constante "__NAMESPACE__" permet de récup le nom du namespace courant (ici 'jeremie')
            $class = str_replace(__NAMESPACE__ . '\\', '', $class); // permet de récup le nom de la classe sans le nom du namespace

            /*
            var_dump($class); // Affiche le nom de la première classe à charger
            die();
            */

        require 'class/' . $class . '.php';

        }
    }
  

}