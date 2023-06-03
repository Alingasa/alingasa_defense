<?php
header("Content-type: application/json; charset=UTF-8");

include "classes/interface.php";
include "databaseconnection.php";
class Students extends Database implements Dbconn
{
    public $tblName = "Students";

    public function createtbl()
    {
        $this->connect();
        
        $createtbl = "CREATE TABLE IF NOT EXISTS $this->tblName
        (id int auto_increment primary key,
        first_name varchar(255),
        last_name varchar(255),
        email varchar(255),
        major varchar(255),
        year int)";
        $this->conn->query($createtbl);

      // var_dump($this->conn->error);
    }

    public function insertbl(array $params)
    {
        if(empty($params) || !array_key_exists("last_name", $params))
        {
            return false;
        }
        if(!array_key_exists("major", $params))
        {
            $major = "";
        }else{
            $major = $params["major"];
        }
        
        
        $first_name = $params["first_name"];
        $last_name = $params["last_name"];
        $email = $params["email"];
        $major = $params["major"];
        $year = $params["year"];

        $insertbl = "INSERT INTO $this->tblName(first_name, last_name, email, major, year)
        VALUES('$first_name','$last_name','$email','$major','$year')";
        $this->conn->query($insertbl);
        if($insertbl)
  {
    return json_encode(
        [
            "code" => 201,
            "message" => "Added Successfully!"
        ]
        );
}
    }
    public function getall()
    {
        $all = "SELECT * FROM $this->tblName";
        return $this->conn->query($all);

    } 
    public function selectall($id)
    {
        $q = $this->conn->query("SELECT * FROM $this->tblName WHERE id='$id'");
        return $q->fetch_assoc();
    }
}


