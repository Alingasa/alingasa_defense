<?php
include "student.php";

$new = new Table();
$new->insertbl($_GET['first_name'],$_GET['middle_name'], $_GET['last_name']);