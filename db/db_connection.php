<?php
$host     = 'database:3306';
$username = 'root';
$password = '1234';
$dbname   ='work_schedule_db';

$conn = new mysqli($host, $username, $password, $dbname);
if(!$conn){
    die("Cannot connect to the database.". $conn->error);
}