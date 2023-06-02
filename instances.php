<?php
include "students.php";

$new = new Students();
$new->createtbl();
$output = $new->insertbl($_GET);

if(isset($_GET['id']))
{
    $q = $new->selectall($_GET['id']);

    if(!empty($q))
    {
        echo json_encode($q);
    }else{
        echo json_encode([
            "code" => 404,
            "message" => "Person not found"
        ]);
    }
}else{
    $all = $new->getall();
    $ll = $all->fetch_all(MYSQLI_ASSOC);
    echo json_encode($ll);
}
if($output)
{
    echo json_encode(
        [
            "code" => 201,
            "message" => "Added Successfully!"
        ]
        );
}