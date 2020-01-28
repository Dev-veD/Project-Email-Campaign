<?php

class Subscriber {
    private $table_name = 'subscribers';
    private $dbKeys = ['firstname','lastname','email_id'];
    protected $pdo ;

    function __construct(){
        $this -> pdo = new Connection();
        $this -> pdo = $this -> pdo ->connect();
    } 

    public function getAllSubscribers(){
        $query = "SELECT firstname, lastname, email_id FROM subscribers";
        $statement = $this -> pdo -> prepare($query) ;
        $statement -> execute();
        return ($statement -> fetchAll(PDO::FETCH_ASSOC));
    }

    public function addSubscriber($data = []){
        $keys = array_values($this->dbKeys);
        $values = array_values($data);
        $queryKey = implode(',',$keys);
        $queryValues = implode("','",array_slice($values,0,3));
        $query =  "INSERT INTO {$this -> table_name} ({$queryKey}) values ('{$queryValues}')";
        echo $query;
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return true;
    }
    public function getSubscriberByEmail($email){
        $stmt = $this -> pdo -> prepare("SELECT * FROM {$this->table_name} WHERE email_id=?");
        $stmt->execute([$email]); 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function emailAlredyExists($email){
        return (bool)$this -> getSubscriberByEmail($email) ;
    }

}

?>