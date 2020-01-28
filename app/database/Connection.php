
<?php

require 'dbConfig.php';
class Connection{
   
    public function connect(){
            try{
            return new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);
        }
        catch (PDOException $e){
            die($e->getMessage());
        }
    }
    
}

?>