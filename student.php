<?php
 include "main.php";
 
class Student extends Db implements Manage
{
    public $tblName = "Students";

    public function createtbl()
    {
        $this->connect();
        $createtbl = "CREATE TABLE IF NOT EXISTS $this->tblName(
            id int auto_increment primary key,
            first_name text,
            middle_name text,
            last_name text)";

            $this->conn->query($createtbl);
            var_dump($this->conn->error);

    }
    public function insertbl($f, $m, $l)
    {
        $insertbl = "INSERT INTO $this->tblName(first_name, middle_name, last_name)
        VALUES('$f','$m','$l')";

        $this->conn->query($insertbl);
    }
}
