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
    

    $bdd = mysqli_connect("localhost", "root", "", "classes");
    $insertquery="SELECT * FROM utilisateurs WHERE login = '".$login."';";
    $query = mysqli_query($bdd, $insertquery); 
    $row =  mysqli_num_rows($query);

    if($row == 0) {
        $insertquery= "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES('" .$login. "', '" .$password. "', '" .$email. "', '" .$firstname. "', '" .$lastname. "');";
        $query =  mysqli_query($bdd, $insertquery); 
        return [$login, $password, $email, $firstname, $lastname];
    }

} 




//CONNECT
public function connect($login, $password){
   
    $bdd = mysqli_connect("localhost", "root", "", "classes");
    $requete="SELECT * FROM utilisateurs WHERE login = '".$login."' AND password= '".$password."'";
    $query = mysqli_query($bdd, $requete);
    $row =  mysqli_num_rows($query);

        if($row){
            
              $user = mysqli_fetch_assoc($query);

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

    $bdd = mysqli_connect("localhost", "root", "", "classes");
    $requete="DELETE FROM `utilisateurs` WHERE `id` = '".$this->id."';";
    $query = mysqli_query($bdd, $requete);

    return $query;
}


//UPDATE
public function update($login, $password, $email, $firstname, $lastname){

    $bdd = mysqli_connect("localhost", "root", "", "classes");    
    $requete = "UPDATE utilisateurs SET login = '".$login."', password = '".$password."', email = '".$email."', firstname = '".$firstname."', lastname = '".$lastname."' WHERE id ='".$this->id."' ";
    $query = mysqli_query($bdd, $requete);

    return $query;

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




$omar = new user('omar', 'omar', 'omar@gmail.com', 'omar', 'omar');
$omar->register('omar', 'rico', 'omar@gmail.com', 'omar', 'omar');
echo '<pre>';

var_dump($omar->connect('omar', 'omar'));
echo '<pre>';

var_dump($omar->isConnected());
echo '<pre>';

var_dump($omar->getAllInfos());
echo '<pre>';

var_dump($omar->getLogin());
echo '<pre>';

var_dump($omar->getEmail());
echo '<pre>';

var_dump($omar->getFirstname());
echo '<pre>';

var_dump($omar->getLastname());
echo '<pre>';

var_dump($omar->update('omar', 'omar', 'omar@gmail.com', 'omar', 'omar'));
echo '<pre>';

var_dump($omar);
echo '<pre>';


?>