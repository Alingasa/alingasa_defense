<?php

abstract class Database
{
   abstract public function connect();
}

interface Manage
{
   public function createtbl();
   public function insertbl($f, $m, $l);
}