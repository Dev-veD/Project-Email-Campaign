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

    public function closeConnection(){
        $this -> pdo =NULL;
        echo "<pre>No More DB Connection<br><>";
    }
}
?>