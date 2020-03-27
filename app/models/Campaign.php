<?php

class Campaign
{
    private $table_name = 'campaign';
    private $dbKeys = ['title','detail'];
    protected $pdo ;

    public function __construct()
    {
        $this -> pdo = new Connection();
        $this -> pdo = $this -> pdo ->connect();
    }

    public function getAllCampaigns()
    {
        $query = "SELECT title, detail,reg_date,camp_id,launch_by FROM $this->table_name";
        $statement = $this -> pdo -> prepare($query) ;
        $statement -> execute();
        return ($statement -> fetchAll(PDO::FETCH_ASSOC));
    }

    public function addCampaign($data = [],$user="")
    {
        
        $keys = array_values($this->dbKeys);
        $values = array_values($data);
        $queryKey = implode(',', $keys);
        $queryValues = implode("','", array_slice($values, 0, 2));
        $query =  "INSERT INTO {$this -> table_name} ({$queryKey}, launch_by) values ('{$queryValues}','$user')";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        
        return true;
    }
    public function getCampaignByID($id)
    {
        $stmt = $this -> pdo -> prepare("SELECT * FROM {$this->table_name} WHERE camp_id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getTotalCampaigns()
    {
        $stmt = $this -> pdo -> prepare("SELECT COUNT(*) FROM {$this->table_name}");
        $stmt->execute();
        return $stmt->fetch();
    }

    public function searchDatabaseFor($element){
        $query = "SELECT title, detail,reg_date,camp_id FROM $this->table_name  WHERE title LIKE ? OR reg_date LIKE ?  ";
        $statement = $this -> pdo -> prepare($query) ;
        $statement -> execute(["%$element%","%$element%"]);
        return ($statement -> fetchAll(PDO::FETCH_ASSOC));
    }

    public function removeCampaignByID($id){
        $query = "DELETE FROM {$this->table_name} WHERE camp_id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$id]);
        }
    
}

?>