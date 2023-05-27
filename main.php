
<?php
include "classes.php";

class Db extends Database
{
    public $conn;
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbName = "Defense";

    public function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password);
        
        $createdb = "CREATE DATABASE IF NOT EXISTS $this->dbName";
        $this->conn->query($createdb);

        $use = "USE $this->dbName";
        $this->conn->query($use);

        var_dump($this->conn->error);
    }

}