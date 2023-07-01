<?php

interface Student
{
    public function createTable();
    public function getAll();
    public function insertTable($params);
    public function getid($id);
    public function update($params);
    public function delete($params);
    public function search($params);
}

?>