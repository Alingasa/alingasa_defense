<?php
include "../classes/interface.php";
include "../database/database.php";

class Students extends Db implements Student
{
    public $TableName = "activities";

    public function createTable()
    {
        $this->connection();

        $createtable = "CREATE TABLE IF NOT EXISTS $this->TableName
        (
        id int auto_increment primary key,
        name varchar(255) not null,
        activity varchar(255) not null,
        date float,
        student_id varchar(255)not null
        )";

        $created = $this->conn->query($createtable);
        if($created)
        {
            return json_encode(
                [
                    'code' => 201,
                    'message' => 'Table Successfully Created!'
                ]
                );
        }
        var_dump($this->conn->error);
    }
    public function search($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET')
        {
            return json_encode(
                [
                    "code" => 404,
                    "message" => "GET method is only allowed!"
                ]
                );
        }
        $name = $params['name'] ?? '';


        $search = "SELECT * FROM $this->TableName where name like '%$name%'";
        $issearch = $this->conn->query($search); 

        if(empty($this->db_error()))
        {
            return json_encode($issearch->fetch_all(MYSQLI_ASSOC));
        }else{
            return json_encode(
                [
                    "code" => 201,
                    "message" => $this->db_error(),
                ]
                ); 
        }

    }
    public function getAll()
    {
        $students = $this->conn->query("SELECT * FROM $this->TableName");
        
        return json_encode($students->fetch_all(MYSQLI_ASSOC));
    }
    public function insertTable($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            return json_encode(
                [
                    "code" => 404,
                    "message" => "POST method is only allowed!"
                ]
                );
        }
        if(!isset($params['name']) || empty($params['name']))
        {
            return json_encode(
                [
                    'code' => 404,
                    'message' => "Name is Required!"
                ]
                );
        }
        if(!isset($params['activity']) || empty($params['activity']))
        {
            return json_encode(
                [
                    'code' => 404,
                    'message' => "Activity is Required!"
                ]
                );
        }
        if(!isset($params['date']) || empty($params['date']))
        {
            return json_encode(
                [
                    'code' => 404,
                    'message' => "Date is Required!"
                ]
                );
        }
        if(!isset($params['student_id']) || empty($params['student_id']))
        {
            return json_encode(
                [
                    'code' => 404,
                    'message' => "Student ID is Required!"
                ]
                );
        }
        $name = $params['name'];
        $activity = $params['activity'];
        $date = $params['date'];
        $studentid = $params['student_id'];
  

        $insert = "INSERT INTO $this->TableName(name, activity, date, student_id)
        VALUES('$name','$activity','$date','$studentid')";

        $isadded = $this->conn->query($insert);

        if($isadded)
        {
            return json_encode(
                [
                    "code" => 201,
                    "message" => "Added Successfully!"
                ]
                );
        }else{
            return json_encode(
                [
                    "code" => 201,
                    "message" => $this->db_error(),
                ]
                ); 
        }

      
    }
    public function getid($getid)
    {
        if(!isset($getid['id']) || empty($getid['id']))
        {
            $response = [
                'code' => 404,
                'message' => 'Id is required'
            ];

            return json_encode($response);
        }
        $id = $getid['id'];

        $data = $this->conn->query("SELECT * FROM $this->TableName WHERE id='$id'");

        if($data->num_rows == 0)
        {
            $response = [
                "code" => 404,
                "message" => "Activity Not Found!"
            ];
            return json_encode($response);
        }
        return json_encode($data->fetch_assoc());
    }
    public function update($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET')
        {
            return json_encode(
                [
                    "code" => 404,
                    "message" => "GET method is only allowed!"
                ]
                );
        }
        if(!isset($params['id']) || empty($params['id']))
        {
            return json_encode(
                [
                    'code' => 404,
                    'message' => "Id  is Required!"
                ]
                );
        }
        if(!isset($params['name']) || empty($params['name']))
        {
            return json_encode(
                [
                    'code' => 404,
                    'message' => "name is Required!"
                ]
                );
        }
        if(!isset($params['activity']) || empty($params['activity']))
        {
            return json_encode(
                [
                    'code' => 404,
                    'message' => "activity is Required!"
                ]
                );
        }
        if(!isset($params['date']) || empty($params['date']))
        {
            return json_encode(
                [
                    'code' => 404,
                    'message' => "date is Required!"
                ]
                );
        }
        if(!isset($params['student_id']) || empty($params['student_id']))
        {
            return json_encode(
                [
                    'code' => 404,
                    'message' => "Student ID is Required!"
                ]
                );
        }
       
        $id = $params['id'];
        $name = $params['name'];
        $activity = $params['activity'];
        $date = $params['date'];
        $studentid = $params['student_id'];

        $update = "UPDATE $this->TableName 
        SET name = '$name', activity = '$activity', date = '$date', student_id = '$studentid'
        where id='$id'";

         $isupdated = $this->conn->query($update);

        if($isupdated)
        {
            return json_encode(
                [
                    "code" => 201,
                    "message" => "Successfully Updated!"
                ]
                );
        }else{
            return json_encode(
                [
                    "code" => 404,
                    "message" => $this->db_error(),
                ]
                ); 
        }
    }
    public function delete($params)
    {
        if($_SERVER['REQUEST_METHOD'] != 'GET')
        {
            return json_encode(
                [
                    "code" => 404,
                    "message" => "GET method is only allowed!"
                ]
                );
        }
     
        if(!isset($params['id']) || empty($params['id']))
        {
            return json_encode(
                [
                    'code' => 404,
                    'message' => "Id  is Required!"
                ]
                );
        }
        $id = $params['id'];

        $delete = "DELETE FROM $this->TableName 
        where id='$id'";

         $isdeleted = $this->conn->query($delete);

        if($isdeleted)
        {
            return json_encode(
                [
                    "code" => 201,
                    "message" => "Successfully Deleted!"
                ]
                );
        }else{
            return json_encode(
                [
                    "code" => 201,
                    "message" => $this->db_error(),
                ]
                ); 
        }
    }
    }
   


?>