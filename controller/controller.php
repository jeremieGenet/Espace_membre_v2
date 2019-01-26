<?php
/*
    FICHIER CONTROLLER qui contient les fonctions utiles au fichier index.php
    Fichier appelé par le routeur (index.php)
*/

// Chargement des classes
//require_once('class/User.php');

require 'class/Autoloader.php';
\jam\Autoloader::registerClass();


// Renvoie la page d'accueil
function home(){
    require('view/front_end/home.php');
}

// Gère l'enregistrement d'un utilisateur
function registerUser($username, $email, $password, $password_confirm){
    
    $user = new jam\espace_membres\User();
    $user->register($username, $email, $password, $password_confirm);
    require('view/front_end/register.php');
    
}

// Gère la connexion et renvoie la page de connexion
function loginUser($username, $password){
    $user = new jam\espace_membres\User();
    $user->login($username, $password);
    require('view/front_end/login.php');
    //header('location: view/front_end/home.php'); // On redirige vers l'accueil
}

// Gère la confirmation de compte de l'utilisateur
function confirmUser($id, $token_confirmation){
    $user = new jam\espace_membres\User();
    $user->confirm($id, $token_confirmation);
    //require('view/front_end/login.php');
}

// Affiche la page de compte de l'utilisateur connecté et lui permet d'y modifier son mot de passe
function accountUser(){
    $user = new jam\espace_membres\User();
    $user->account();
    require('view/front_end/account.php');
}

// Déconnecte un utilisateur connecté
function logoutUser(){
    $user = new jam\espace_membres\User();
    $user->logout();
    //require('view/front_end/home.php');
}

// Permet de faire une demande de mot de passe oublié (envoie d'email avec token)
function forgetPasswordUser(){
    $user = new jam\espace_membres\User();
    $user->forgetPassword();
    require('view/front_end/forget.php');
}

// Permet de réinitialiser le mot de passe d'un utilisateur connecté
function resetPasswordUser(){
    $user = new jam\espace_membres\User();
    $user->resetPassword();
    require('view/front_end/reset.php');
}



