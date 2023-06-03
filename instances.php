<?php
include "students.php";

$new = new Students();
$new->createtbl();
echo $new->insertbl($_GET);

if(isset($_GET['id']))
{
    $select = $new->selectall($_GET['id']);

    if(!empty($select))
    {
        echo json_encode($select);
    }else{
        echo json_encode([
            "code" => 404,
            "message" => "Student not found"
        ]);
    }
}else{
    $all = $new->getall();
    $getall = $all->fetch_all(MYSQLI_ASSOC);
    echo json_encode($getall);
}
// if($output)
// {
//     echo json_encode(
//         [
//             "code" => 201,
//             "message" => "Added Successfully!"
//         ]
//         );
// }
