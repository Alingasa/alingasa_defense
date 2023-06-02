<?php

interface Dbconn 
{
    public function createtbl();
    public function insertbl(array $params);
    public function getall();
    public function selectall($id);
}