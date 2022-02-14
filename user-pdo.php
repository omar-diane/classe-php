<?php


class user{
    private $id ;
    public $login ;
    public $password;
    public $email ;
    public $firstname ;
    public $lastname ;

    //REGISTER
public function register($login, $password, $email, $firstname, $lastname){
    
    $bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
    $requetelogin= $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $requetelogin->execute(array($login));
    $loginexist= $requetelogin->rowCount();

    if($loginexist == 0) {
        $insert= $bdd->prepare("INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES(?, ?, ?, ?, ?)");
        $insert->execute(array($login, $password, $email, $firstname, $lastname));
        return [$login, $password, $email, $firstname, $lastname];
    }

} 

//CONNECT
public function connect($login, $password){
   
    $bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
    $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
    $requser->execute(array($login, $password));
    $userexist = $requser->rowCount();

    if($userexist == 1){
            
        $user= $requser->fetch();

              $this->id = $user['id'];
              $this->login = $user['login'];
              $this->password = $user['password'];
              $this->email = $user['email'];
              $this->firstname = $user['firstname'];
              $this->lastname = $user['lastname'];
              return true;
            }
            
            else
            {   
                  return false;
            }
    }

//DISCONNECT
public function disconnect(){
  
    if (isset($this->id)) { 
    
        $this->id = NULL;
        $this->login = NULL;
        $this->password = NULL;
        $this->email = NULL;
        $this->firstname = NULL;
        $this->lastname = NULL; 
    
    }
    
    return true;
    
    }
    
//DELETE    
public function delete(){

    $bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
    $requser = $bdd->prepare ("DELETE FROM utilisateurs WHERE id = $this->id");
    $requser->execute();
    
return $requser;
    }
    
//UPDATE    
public function update($login, $password, $email, $firstname, $lastname){

    $bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');   
    $insert = $bdd->prepare("UPDATE utilisateurs SET login = ?, password = ?, email = ?, firstname = ?, lastname = ?  WHERE id = $this->id");
    $insert->execute(array($login, $password, $email, $firstname, $lastname));
    
return true;
    
    }

//ISCONNECTED
public function isConnected(){
    if (isset($this->id)){
        return 1;
    }
        
    else{
        return 0;
    }
        
}
        
//GETALLINFOS        
public function getAllInfos(){
    return $this;
    }
        
//GETLOGIN        
public function getLogin(){
    return $this->login;
    }
        
//GETEMAIL        
public function getEmail(){
    return $this->email;
    }
        
//GETFIRSTNAME        
public function getFirstname(){
    return $this->firstname;
    }
        
//GETLASTNAME    
public function getLastname(){
    return $this->lastname;
    }              
    
}



$diane = new user('diane', 'diane', 'diane@gmail.com', 'diane', 'diane');
$diane->register('diane', 'diane', 'diane@gmail.com', 'diane', 'diane');
echo '<pre>';


var_dump($diane->connect('diane', 'diane'));
echo '<pre>';


echo '<pre>';
echo '<pre>';

var_dump($diane->update('diane', 'diane', 'diane@gmail.com', 'diane', 'diane'));
echo '<pre>';

var_dump($diane->isConnected());
echo '<pre>';

var_dump($diane->getAllInfos());
echo '<pre>';

var_dump($diane->getLogin());
echo '<pre>';

var_dump($diane->getEmail());
echo '<pre>';

var_dump($diane->getFirstname());
echo '<pre>';

var_dump($diane->getLastname());
echo '<pre>';

var_dump($diane);
echo '<pre>';
?>