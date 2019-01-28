<?php

use function Monolog\Handler\mail;
require("connection.php");
/*$insertQuery = "INSERT INTO student VALUES(NULL,?,?,?,?,?,?)";
$stmt = $conn->prepare($insertQuery);
echo $conn->error;
$rollno = 556;
$name = "Anuraj";
$city = "Bikaner";
$contact = "3456789977";
$branch = "Computer Science";
$image = "test.jpg";
$stmt->bind_param("isssss",$rollno,$name,$city,$contact,$branch,$image);
$stmt->execute();*/


$selectQuery = "SELECT * FROM student WHERE `name` LIKE ?";
$stmt = $conn->prepare($selectQuery);
echo $conn->error;
$name = "Anuraj";
$stmt->bind_param("s",$name);
$stmt->execute();
$result = $stmt->get_result();
echo $conn->error;
print_r($result->fetch_object());


$emailBody = <<<BODY

<b>Hi $name</b>,

<table>
    <tr>
        <th> </th>
        <th> </th>
        <th> </th>
        <th> </th>
        <th> </th>
    </tr>
</table>

BODY;

mail("opbissa@gmail.com","Test Mail",$emailBody,);

?>