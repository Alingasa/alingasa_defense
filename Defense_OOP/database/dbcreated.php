<?php
include './database.php';
header("Content-type: application/json; charset=UTF-8");
$new = new Db();
echo $new->connection();


?>