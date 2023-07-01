<?php
include "../classes/abstract.php";

class Db extends Database
{
    public $conn;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $DbName = "defense_oop";

    public function connection()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password);
        $created = $this->conn->query("CREATE DATABASE IF NOT EXISTS $this->DbName");
        $this->conn->query("USE $this->DbName");
        if($created)
        {
            return json_encode(
                [
                    'code' => 201,
                    'message' => 'Database is successfully Created!'
                ]
                );
        }
        
      
    }
    
    public function db_error()
    {
        return $this->conn->error;
    }
}



?>