<?php
include "./students.php";
header("Content-type: application/json; charset=UTF-8");
$new = new Students();
echo $new->createTable();

?>