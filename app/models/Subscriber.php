<?php

class Subscriber
{
    private $table_name = 'subscribers';
    private $dbKeys = ['fullname','email_id','category'];
    protected $pdo ;

    public function __construct()
    {
        $this -> pdo = new Connection();
        $this -> pdo = $this -> pdo ->connect();
    }

    public function getAllSubscribers()
    {
        $query = "SELECT fullname, email_id, category,reg_date,sub_id FROM subscribers";
        $statement = $this -> pdo -> prepare($query) ;
        $statement -> execute();
        return ($statement -> fetchAll(PDO::FETCH_ASSOC));
    }

    public function addSubscriber($data = [])
    {
        
      
        $keys = array_values($this->dbKeys);
        $values = array_values($data);
        $queryKey = implode(',', $keys);
        $queryValues = implode("','", array_slice($values, 0, 3));
        $query =  "INSERT INTO {$this -> table_name} ({$queryKey}) values ('{$queryValues}')";
      
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        
        return true;
    }
    public function getSubscriberByEmail($email)
    {
        $stmt = $this -> pdo -> prepare("SELECT * FROM {$this->table_name} WHERE email_id=?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllEmails()
    {
        $stmt = $this -> pdo -> prepare("SELECT email_id FROM {$this->table_name} ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function emailAlredyExists($email)
    {
        return (bool)$this -> getSubscriberByEmail($email) ;
    }


    public function getTotalSubscribers()
    {
        $stmt = $this -> pdo -> prepare("SELECT COUNT(*) FROM {$this->table_name}");
        $stmt->execute();
        return $stmt->fetch();
    }

    public function searchDatabaseFor($element){
        $query = "SELECT  fullname, email_id, category,reg_date,sub_id  FROM $this->table_name  WHERE fullname LIKE ? OR email_id LIKE ? 
        OR category LIKE ? OR reg_date LIKE ? ";
        $statement = $this -> pdo -> prepare($query) ;
        $statement -> execute(["%$element%","%$element%","%$element%","%$element%"]);
        return ($statement -> fetchAll(PDO::FETCH_ASSOC));
    }

    public function removeSubscriberByID($id){
    $query = "DELETE FROM {$this->table_name} WHERE sub_id = ?";
    $statement = $this->pdo->prepare($query);
    $statement->execute([$id]);
    }
}

?>