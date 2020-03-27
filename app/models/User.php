<?php
class User {
    
    private $table_name = 'users';
    private $dbKeys = ['first_name','last_name','email_id','pass_hash'];
    protected $pdo;
    function __construct(){
        $this -> pdo = new Connection();
        $this -> pdo = $this -> pdo ->connect();
    } 


    public function addUser($data=[]){
        
        $keys = array_values($this->dbKeys);
        $values = array_values($data);
        $queryKey = implode(',',$keys);
        $queryValues = implode("','",array_slice($values,0,4));
        $query =  "INSERT INTO {$this -> table_name} ({$queryKey}) values ('{$queryValues}')";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
    }

    public function removeUserByEmail($email){

    }
    public function removeUserById($id){

    }
    public function getUserByEmail($email){
        $stmt = $this -> pdo -> prepare("SELECT * FROM users WHERE email_id=?");
        $stmt->execute([$email]); 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserById($id){
    }
    public function getUserId(){

    }
    public function emailAlredyExists($email){
        return (bool)$this -> getUserByEmail($email) ;
    }

    public function closeConnection(){
        $this -> pdo =NULL;
        echo "<pre>No More DB Connection<br><>";
    }

    public function insertToken($email , $token){
        $query =  "UPDATE {$this -> table_name} SET status=(?) where email_id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$token, $email]);
    }
    public function updateStatus($email){
        $query =  "UPDATE {$this -> table_name} SET status='verified' where email_id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$email]);
    }

    public function getStatus($email){
        $stmt = $this -> pdo -> prepare("SELECT status FROM users WHERE email_id=?");
        $stmt->execute([$email]); 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUsername($email){
        $stmt = $this -> pdo -> prepare("SELECT first_name FROM users WHERE email_id=?");
        $stmt->execute([$email]); 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updatePassword($pass_hash, $email){
        $query =  "UPDATE {$this -> table_name} SET pass_hash =? where email_id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$pass_hash, $email]);
    }
    public function getHash($email){
        $stmt = $this -> pdo -> prepare("SELECT pass_hash FROM users WHERE email_id=?");
        $stmt->execute([$email]); 
        return $stmt->fetch(PDO::FETCH_ASSOC)['pass_hash'];
    }

    public function storeIP($ip){
       
        $query =  "INSERT INTO IP (ip) values (?)";
        echo "hyre";
        $statement = $this->pdo->prepare($query);
        echo $query;
        $statement->execute([$ip]);
    }

}
?>