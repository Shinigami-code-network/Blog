<?php
$con=new mysqli("localhost","root","","blogdb");

$result=$con->query("SELECT * FROM students");

foreach($result as $value){
    echo $value['student_id'];
    echo $value['name'];
}
?>