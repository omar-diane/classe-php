<?php

class user {
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    //Maintenant je crée les méthodes
    function __construct(){
    //Connexion à la BDD
        
    }

    //Register
    function register($login, $email, $firstname, $lastname){
        //Je place les instructions ici
        $this -> bdd = mysqli_connect("localhost", "root", "", "classes");
        session_start();

    }
}