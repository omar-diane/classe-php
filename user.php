<!DOCTYPE html>
 <html lang="fr">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>User</title>
 </head>
 <body>
     <main>
     <?php

class user {
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    //Maintenant je crée les méthodes
    public function __construct(){
    //Connexion à la BDD
        $this -> bdd = mysqli_connect("localhost", "root", "", "classes");
        session_start();
        $sql = mysqli_query($this -> bdd, "SELECT * FROM utilisateurs");
        $this -> users = mysqli_fetch_all($sql);
    }
    //REGISTER
    public function register($login,$password,$email,$firstname,$lastname){ //add tests no same login
         
        foreach($this -> users as $user){
          if ($login == $user[1]){
            $stop = 1;
          }
        }
        if($login == NULL || $password == NULL || $email == NULL || $firstname == NULL || $lastname == NULL){
          $stop == 1;
        } 
         $stop = 0;
        if($stop == 0){
          $sql = mysqli_query($this->bdd,"INSERT INTO utilisateurs(login, password, email, firstname,lastname) VALUES ('$login', '$password', '$email', '$firstname','$lastname')");
          
          return "
            <table>
              <theader>
                <th>Login</th>
                <th>Password</th>
                <th>Email</th>
                <th>Firstname</th>
                <th>Lastname</th>
              </theader>
              <tbody>
                <td> $login </td>
                <td> $password </td>
                <td> $email </td>
                <td> $firstname </td>
                <td> $lastname </td>
              </tbody>
            </table>
          ";
        }
        else{
          return "error";
        }
      }
    //CONNECT
      public function connect($login,$password){
          
          foreach($this -> users as $user){
              if ($login == $user[1] && $password == $user[2]){
                  $_SESSION["connected"] = $login ;
                  // fill attributes 
                  $this -> login = $login;
                  $this -> email = $user[3];
                  $this -> firstname = $user[4];
                  $this -> lastname = $user[5];
                  // feedback
                  return $this -> login . " Vous êtes connecté. </br>";
              }
          }
      }
    //DISCONNECT
      public function disconnect(){
        session_destroy();
        $this -> login = "";
      }
    //DELETE
      public function delete(){
        $login = $this->login;
        $sql = mysqli_query($this->bdd,"DELETE FROM `utilisateurs` WHERE `login` = '$login'");
        session_destroy();
        $this -> login = NULL;
        $this -> email = NULL;
        $this -> firstname = NULL;
        $this -> lastname = NULL;
        return $login . " Utilisateur supprimé";
      }
    //UPDATE
      public function update($login,$password,$email,$firstname,$lastname){
        foreach($this -> users as $user){
          if ($login == $user[1]){
            $stop = 1;
          }
        }
        if($login == NULL || $password == NULL || $email == NULL || $firstname == NULL || $lastname == NULL){
          $stop == 1;
        } 
        $stop = 0; 
        if ($stop == 0 && isset($_SESSION["connected"])){
          $login = $this->login;
          $sql = mysqli_query($this->bdd,"UPDATE `utilisateurs` SET login = '$login', password = '$password', email = '$email', firstname = '$firstname',lastname = '$firstname' WHERE login = '$log'");
          $this -> login = $login;
          $this -> email = $email;
          $this -> firstname = $firstname;
          $this -> lastname = $lastname;
          return $log . " Utilisateur ajouté";
        }
        else{
          return "error";
        }
      }
    
    //ISCONNECTED
      public function isConnected(){
        return isset($_SESSION["connected"]);
      }
    //GETALLINFOS
      public function getAllInfos(){
        return "
        <table>
          <theader>
            <th>Login</th>
            <th>Email</th>
            <th>Firstname</th>
            <th>Lastname</th>
          </theader>
          <tbody>
            <td> $this->login </td>
            <td> $this->email </td>
            <td> $this->firstname </td>
            <td> $this->lastname </td>
          </tbody>
        </table>
      ";
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
      
    
      $user = new User();
    
      //_________Register _________
         echo $user->register("Omar","123","omar123@gmail.com","Omar","DIANE");
    
      //_________Connect _________
        echo $user->connect("Omar","D");
    
      //_________Delete _________
         echo $user->delete();
    
      //_________Update _________
         echo $user->update("Jun","O","O","O","O");
    
      //_________isConnected _________
         echo $user->isConnected();
    
      //_________getAllInfos _________
         echo $user->getAllInfos();
    
      //_________GetLogin _________
         echo $user->getLogin();
    
      //_________GetFirstname _________
         echo $user->getFirstname();
    
      //_________GetLastname _________
         echo $user->getLastname();
    
      ?>
     </main>
     
 </body>
 </html>